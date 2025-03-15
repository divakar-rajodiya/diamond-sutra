<?php

namespace App\Http\Controllers;

use App\Lib\General;
use App\lib\Validation;
use App\Models\Admin\Coupon;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;
use App\Models\User\Orders;
use App\Models\User\User;
use App\Models\User\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;
use PHPUnit\Framework\Attributes\IgnoreFunctionForCodeCoverage;
use PHPUnit\Metadata\Uses;
use App\Http\Controllers\SMSController;
use App\Models\Admin\SolitaireData;
use App\Models\User\DSOrderDetails;
use App\Models\User\DSOrders;
use App\Models\User\Review;
use App\Models\User\UserAddress;
use Cashfree\Cashfree\Cashfree;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;

class WelcomeController extends Controller
{

    static $platform = '';
    static $x_api_version = '';
    public function __construct()
    {
        \Cashfree\Cashfree::$XClientId = config('Cashfree')['cashfree_ClientId'];
        \Cashfree\Cashfree::$XClientSecret = config('Cashfree')['cashfree_Secret'];
        \Cashfree\Cashfree::$XEnvironment = \Cashfree\Cashfree::$SANDBOX; // $PRODUCTION // $SANDBOX
        self::$x_api_version = "2023-08-01";
        self::$platform = config('constant.PLATFORM_NAME');
    }
    public function getMaintenance()
    {
        $settings = app('settings');
        if ($settings['maintenance_mode'] != 1) {
            return redirect('/');
            // return view('undermaintenance');
        } else {
            return view('site.undermaintenance');
        }
    }

    public function getHome()
    {
        $Testimonial = \App\Models\Admin\Testimonial::get_all();
        $fields = 'id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username';
        $token = 'IGQWRPeFZAzWnp4T251d0UyZA3J5RFRpd2JBV1NxdEJMU2ZAZASWRKSlNaTFZAIWFJPNzZAzbkczMEJBci10NE1GeDRoQk5oVGlCWmpCaDA1RndWaFU3NFQtUnFISEtNbEFmY1RJd1dMRnhZASHUzeWFUd1doekxWWHlvUlUZD';
        $limit = 12;
        $json_feed_url = "https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
        $json_feed = @file_get_contents($json_feed_url);
        $contents = json_decode($json_feed, true, 512, JSON_BIGINT_AS_STRING);
        $view_data = [
            'header' => [
                "title" => 'Home | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Home',
                'data' => $Testimonial,
                'contents' => $contents
            ],
            'footer' => [
                'js' => []
            ]
        ];
        // dd($view_data);
        return view('home', $view_data);
    }

    public function getLogin()
    {
        if (\Auth::guard('user')->id()) return redirect('/');
        $param = \Input::all();
        $redirect = null;
        if (isset($param['redirect'])) $redirect = $param['redirect'];
        $view_data = [
            'header' => [
                "title" => 'Login | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Login',
                'redirect' => $redirect
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('login', $view_data);
    }

    public function getSignUp()
    {
        $view_data = [
            'header' => [
                "title" => 'Sign Up | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Sign Up',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('signup', $view_data);
    }
    public function getForgetPassword()
    {
        $view_data = [
            'header' => [
                "title" => 'Forget Password | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Forget Password',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('forget_password', $view_data);
    }
    public function getResetPassword()
    {
        $view_data = [
            'header' => [
                "title" => 'Reset Password | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Reset Password',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('reset_password', $view_data);
    }
    public function getVerifyOtp($userId)
    {
        $view_data = [
            'header' => [
                "title" => 'Verify Otp | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Otp Verify',
                'user_id' => $userId
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('verify-otp', $view_data);
    }
    public function getUpdateWishlist($product_id)
    {
        $res = \App\Models\User\Wishlist::update_wishlist($product_id);
        return $res;
    }

    public function postLogin()
    {
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("site", "login"));
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }
        $param['type'] = '';
        $param['user_email'] = $param['email'];
        return \App\Models\User\User::doLogin($param);
    }
    public function postMobileLogin()
    {

        $param = \Input::all();

        $msg = [
            'phone_number.exists' => 'Your mobile number doesn’t exists.'
        ];
        $validator = \Validator::make($param, \Validation::get_rules("site", "mobile_login"), $msg);

        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }
        return \App\Models\User\User::doMobileLogin($param);
    }
    public function postSignup()
    {
        $param = \Input::all();
        // dd($param);
        $msg = [
            'is_accept.required' => 'Please Accept Terms & Condition.',
            'phone_number.unique' => 'Your mobile number already exists.',
            'email.unique' => 'Your email address already exists.',
        ];
        $validator = \Validator::make($param, \Validation::get_rules("site", "signup"), $msg);
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }

        return \App\Models\User\User::signup($param);
    }

    public function postVerifyOtp()
    {
        $param = \Input::all();
        // dd($param);
        $validator = \Validator::make($param, \Validation::get_rules("site", "verify_otp"));
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }
        return UserOtp::verifyOtp($param);
    }
    public function postResendOtp()
    {
        $param = \Input::all();
        // dd($param);
        $validator = \Validator::make($param, \Validation::get_rules("site", "resend_otp"));
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }
        $otp = UserOtp::resendOtp($param);
        $new_otp = $otp['data']['otp'];
        // dd($new_otp);
        // send otp on sms api
        $user_number = \App\Models\User\User::where('id', $param['user_id'])->first();
        $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
        $numbers = array($user_number->number);
        $sender = 'DMNDST';
        $message = 'Welcome to Diamond Sutra! Your OTP for Login is: ' . $new_otp . '. Please use this code to complete your purchase securely.';
        $SendSMS->sendSms($numbers, $message, $sender);
        //
        return \General::success_res();
    }

    public function getWishlist()
    {
        $view_data = [
            'header' => [
                "title" => 'Wishlist | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Wishlist',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('signup', $view_data);
    }

    public function getAbout()
    {
        $view_data = [
            'header' => [
                "title" => 'About Us | ' . self::$platform,
            ],
            'body' => [
                'title' => 'About Us',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('about', $view_data);
    }

    public function getFaqs()
    {
        $view_data = [
            'header' => [
                "title" => 'FAQS | ' . self::$platform,
            ],
            'body' => [
                'title' => 'FAQS',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('faqs', $view_data);
    }

    public function getPrivacyPolicy()
    {
        $view_data = [
            'header' => [
                "title" => 'Privacy Policy | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Privacy Policy',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('privacy-policy', $view_data);
    }

    public function getReturnsPolicy()
    {
        $view_data = [
            'header' => [
                "title" => 'Returns Policy | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Returns Policy',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('returns-policy', $view_data);
    }

    public function getTermsConditions()
    {
        $view_data = [
            'header' => [
                "title" => 'Terms & Conditions | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Terms & Conditions',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('terms-conditions', $view_data);
    }

    public function getLifetimeExchangeBuyBackPolicy()
    {
        $view_data = [
            'header' => [
                "title" => 'Lifetime Exchange & Buy-Back Policy | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Lifetime Exchange & Buy-Back Policy',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('lifetime-exchange-buy-back-policy', $view_data);
    }

    public function getWhyBuyFromUs()
    {
        $view_data = [
            'header' => [
                "title" => 'Why Buy From Us? | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Why Buy From Us?',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('why-buy-from-us', $view_data);
    }

    public function getOurCertifications()
    {
        $view_data = [
            'header' => [
                "title" => 'Our Certifications | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Our Certifications',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('our-certifications', $view_data);
    }

    public function getTestimonials()
    {
        $view_data = [
            'header' => [
                "title" => 'Testimonials | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Testimonials',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('testimonials', $view_data);
    }

    public function getCorporateGifting()
    {
        $view_data = [
            'header' => [
                "title" => 'Corporate Gifting | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Corporate Gifting',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('corporate-gifting', $view_data);
    }

    public function getCertificationGuide()
    {
        $view_data = [
            'header' => [
                "title" => 'Certification Guide | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Certification Guide',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('certification-guide', $view_data);
    }

    public function getRingSizeGuide()
    {
        $view_data = [
            'header' => [
                "title" => 'Ring Size Guide | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Ring Size Guide',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('ring-size-guide', $view_data);
    }

    public function getSolitaireBuyingGuide()
    {
        $view_data = [
            'header' => [
                "title" => 'Solitaire Buying Guide | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Solitaire Buying Guide',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('solitaire-buying-guide', $view_data);
    }

    public function getContact()
    {
        $view_data = [
            'header' => [
                "title" => 'Contact Us | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Contact Us',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('contact_us', $view_data);
    }
    public function getFAQ()
    {
        $view_data = [
            'header' => [
                "title" => 'FAQ | ' . self::$platform,
            ],
            'body' => [
                'title' => 'FAQ',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('faqs', $view_data);
    }
    public function getCheckoutMethod()
    {
        if (\Auth::guard("user")->check()) {
            // return \Redirect::to("checkout");
            return \Redirect::to("confirm-checkout");
        }
        $view_data = [
            'header' => [
                "title" => 'Checkout Method| ' . self::$platform,
            ],
            'body' => [
                'title' => 'Checkout Method'
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('checkout_method', $view_data);
    }

    public function getOrderSuccess($order_id)
    {
        if (!isset($order_id)) abort('404');
        $checkOrder = Orders::checkOrderId($order_id);
        if ($checkOrder['flag'] != 1) abort('404');
        $view_data = [
            'header' => [
                "title" => 'Order Success | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Order Sucecss',
                'order_id' => $order_id
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('order_success', $view_data);
    }

    public function getOrderDetail($order_id)
    {
        if (\Auth::guard('user')->check()) {

            $orderDetail = Orders::getOrderDetail($order_id);
            if ($orderDetail['flag'] != 1) abort('404');

            $view_data = [
                'header' => [
                    "title" => 'Order Details ' . self::$platform,
                ],
                'body' => [
                    'id'    => 'Order Details',
                    'label' => 'Order Details',
                    'header_title' => 'Order Details',
                    'orderDetail' => $orderDetail['data']['orderDetail']
                ],
                "footer" => [
                    'js' => ['']
                ]
            ];
            return view('user.order_detail', $view_data);
        } else {
            return redirect('/login');
        }
    }

    public function getParishiSolitaireData()
    {
        $res = \General::error_res();
        $response = \Http::get('https://parishidiamond.com/aspxpages/StkDwnlJason.aspx?uname=adityashah&pwd=Crazyadi5');
        if ($response->successful()) {
            $data = $response->json();
            $res = \General::success_res();
            $res['data'] = $data;
        } else {
            // Handle the error here
            $status = $response->status();
            $errorMessage = $response->body();
            $res['msg'] = $response->body();
        }
        return $res;
    }
    public function getRanwakaSolitaireData()
    {
        $res = \General::error_res();
        $response = \Http::post('http://RANWAKA:starrays@api.starrays.com/StarRays/DetailInventory');
        if ($response->successful()) {
            $data = $response->json();
            $res = \General::success_res();
            $res['data'] = $data;
        } else {
            // Handle the error here
            $status = $response->status();
            $errorMessage = $response->body();
            $res['msg'] = $response->body();
        }
        return $res;
    }
    public function getAsianStarsSolitaireData()
    {
        $res = \General::error_res();
        $payload = [
            'username' => 'diamondsutra',
            'password' => 'sutra@123'
        ];

        $response = \Http::post('http://apiasianstars.com:8000/api/demandlist', $payload);
        if ($response->successful()) {
            $data = $response->json();
            $res = \General::success_res();
            $res['data'] = $data;
        } else {
            // Handle the error here
            $status = $response->status();
            $errorMessage = $response->body();
            $res['msg'] = $response->body();
        }
        return $res;
    }

    public function getSanghaviSolitaireData()
    {
        $res = \General::error_res();
        $payload = [
            'username' => 'Diamond_sutra',
            'password' => 'Sanghvi@123'
        ];

        // Send the request as form-encoded data
        $response = \Http::asForm()->post('https://sanghvisons.com/SanghaviWebApi/diff_four', $payload);
        if ($response->successful()) {
            $data = $response->json();
            $res = \General::success_res();
            $res['data'] = $data['data'];
        } else {
            // Handle the error here
            $status = $response->status();
            $errorMessage = $response->body();
            $res['msg'] = $response->body();
        }
        return $res;
    }

    public function getSolitaireApiData()
    {
        // $res = \General::error_res();
        // if (\Cache::has('api_data')) {
        //     $res = General::success_res('success');
        //     $solitaires = \Cache::get('api_data');
        //     // dd($solitaires);
        //     $orderSolitaire = \App\Models\User\DSOrderDetails::where('solitaire_cert_no', '!=', '')->get()->pluck('solitaire_cert_no')->toArray();
        //     // $orderSolitaire2 = \App\Models\User\Orders::where('solitaire_cert_no2', '!=', '')->get()->pluck('solitaire_cert_no2')->toArray();
        //     $solitaires = array_values(array_filter($solitaires, function ($item) use ($orderSolitaire) {
        //         return !in_array($item['CertNo'], $orderSolitaire);
        //     }));
        //     $res['data'] = $solitaires;
        // }
        // return $res;

        $res = \General::error_res();
        $solitaireData = SolitaireData::getAllSolitaire();
        if ($solitaireData['flag'] == 1) {
            $res = General::success_res('success');
            $solitaires =$solitaireData['data'];
            // dd($solitaires);
            $orderSolitaire = \App\Models\User\DSOrderDetails::where('solitaire_cert_no', '!=', '')->get()->pluck('solitaire_cert_no')->toArray();
            // $orderSolitaire2 = \App\Models\User\Orders::where('solitaire_cert_no2', '!=', '')->get()->pluck('solitaire_cert_no2')->toArray();
            $solitaires = array_values(array_filter($solitaires, function ($item) use ($orderSolitaire) {
                return !in_array($item['CertNo'], $orderSolitaire);
            }));
            $res['data'] = $solitaires;
        }
        return $res;

        
    }

    public function getDiamondPair()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $res = \General::error_res();
        $solitairData = SolitaireData::getPairdData();
        if($solitairData['flag'] == 1){
            $res = General::success_res('success');
            $solitaires = $solitairData['data'];
            // $orderSolitaire = \App\Models\User\DSOrderDetails::where('solitaire_cert_no', '!=', '')->get()->pluck('solitaire_cert_no')->toArray();
            // $orderSolitaire2 = \App\Models\User\Orders::where('solitaire_cert_no2', '!=', '')->get()->pluck('solitaire_cert_no2')->toArray();
            // $solitaires = array_values(array_filter($solitaires, function ($item) use ($orderSolitaire) {
            //     return !in_array($item[0]['CertNo'], $orderSolitaire) &&
            //         !in_array($item[1]['CertNo'], $orderSolitaire);
            // }));
            $res['data'] = $solitaires;
        }
        return $res;
        
    
    }

    public function getLooseSolitaires()
    {
        $view_data = [
            'header' => [
                "title" => 'Solitaire Diamonds | ' . self::$platform,
                "css" => ['site/product-detail.min.css', 'dataTable.min.css']
            ],
            'body' => [
                'title' => 'Diamonds'
            ],
            'footer' => [
                'js' => ['dataTable.min.js', 'site/diamond_filter.min.js', 'site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
            ]
        ];
        return view('loose_solitaire', $view_data);

        
    }

    // public function getLooseSolitaires(){
    //     $view_data = [
    //         'header' => [
    //             "title" => 'Solitaire Diamonds | ' . self::$platform,
    //             "css" => ['site/product-detail.min.css', 'dataTable.min.css']
    //         ],
    //         'body' => [
    //             'title' => 'Diamonds'
    //         ],
    //         'footer' => [
    //             'js' => ['dataTable.min.js', 'site/diamond_filter.min.js', 'site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
    //         ]
    //     ];
    //     return view('sol.loose_solitaire_new', $view_data);
    // }
    public function postSolitaireFilter(){
        $param = \Input::all();
        // dd($param);
        $data = SolitaireData::filter_solitaire($param);
        $res = General::success_res();
        $res['blade'] = view("sol.solitaire_data_filter", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }

    public function postSolitairePairFilter(){
        $param = \Input::all();
        // dd($param);
        $data = SolitaireData::filter_and_pair_solitaire($param);
        dd($data);
        $res = General::success_res();
        $res['blade'] = view("sol.solitaire_pair_data_filter", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }

    public function getLooseSolitairePairs()
    {
        $view_data = [
            'header' => [
                "title" => 'Solitaire Diamonds | ' . self::$platform,
                "css" => ['site/product-detail.min.css', 'dataTable.min.css']
            ],
            'body' => [
                'title' => 'Diamonds'
            ],
            'footer' => [
                'js' => ['dataTable.min.js', 'site/diamond_filter.min.js', 'site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
            ]
        ];
        return view('loose_solitaire_pair', $view_data);
    }

    public function getLooseSolitairesFilter()
    {
        $res = \General::error_res();
        if (\Cache::has('api_data')) {
            $res = General::success_res('success');
            $solitaires = \Cache::get('api_data');
            $orderSolitaire = \App\Models\User\Orders::where('solitaire_cert_no', '!=', '')->get()->pluck('solitaire_cert_no')->toArray();
            $orderSolitaire2 = \App\Models\User\Orders::where('solitaire_cert_no2', '!=', '')->get()->pluck('solitaire_cert_no2')->toArray();
            $solitaires = array_values(array_filter($solitaires, function ($item) use ($orderSolitaire, $orderSolitaire2) {
                return !in_array($item['CertNo'], $orderSolitaire) &&
                    !in_array($item['CertNo'], $orderSolitaire2);
            }));
            $res['data'] = $solitaires;
            return $res;
        }
    }

    public static function getMergedSolaitaireData()
    {
        $res = \General::error_res();
        $apiData = array();

        // First API request (Starrays)
        $response1 = \Http::post('http://RANWAKA:starrays@api.starrays.com/StarRays/DetailInventory');
        if ($response1->successful()) {
            $data1 = $response1->json();
            $apiData = array_merge($apiData, self::filterAndModifyData($data1, 'starrays'));
        } else {
            $res['msg'] = $response1->body();
        }

        // Second API request (Parishi)
        $response2 = \Http::get('https://parishidiamond.com/aspxpages/StkDwnlJason.aspx?uname=adityashah&pwd=Crazyadi5');
        if ($response2->successful()) {
            $data2 = $response2->json();
            $apiData = array_merge($apiData, self::filterAndModifyData($data2, 'parishi'));
        } else {
            $res['msg'] = $response2->body();
        }

        // third api request (SANGHVI)
        $payload = [
            'username' => 'Diamond_sutra',
            'password' => 'Sanghvi@123'
        ];

        // Send the request as form-encoded data
        $response3 = \Http::asForm()->post('https://sanghvisons.com/SanghaviWebApi/diff_four', $payload);
        if ($response3->successful()) {
            $data3 = $response3->json();
            $apiData = array_merge($apiData, self::filterAndModifyData($data3['data'], 'sanghvi'));
        } else {
            $res['msg'] = $response3->body();
        }

        // fourth api request (asianstars)
        $payload = [
            'username' => 'diamondsutra',
            'password' => 'sutra@123'
        ];

        // Send the request as form-encoded data
        $response4 = \Http::post('http://apiasianstars.com:8000/api/demandlist', $payload);
        if ($response4->successful()) {
            $data4 = $response4->json();
            $apiData = array_merge($apiData, self::filterAndModifyData($data4, 'asianstars'));
        } else {
            $res['msg'] = $response4->body();
        }

        if (!empty($apiData)) {
            $res = \General::success_res();
            $res['data'] = $apiData;
        }

        return $res;
    }

    public static function postPairingDiamonds($diamond = null)
    {
        if($diamond == null)
            $diamond = \Cache::get('api_data');

        $orderSolitaire = \App\Models\User\Orders::where('solitaire_cert_no', '!=', '')->get()->pluck('solitaire_cert_no')->toArray();
        $orderSolitaire2 = \App\Models\User\Orders::where('solitaire_cert_no2', '!=', '')->get()->pluck('solitaire_cert_no2')->toArray();
        $diamond = array_values(array_filter($diamond, function ($item) use ($orderSolitaire, $orderSolitaire2) {
            return !in_array($item['CertNo'], $orderSolitaire) &&
                !in_array($item['CertNo'], $orderSolitaire2);
        }));
        $pair = [];
        $uniqueArr = [];
        foreach ($diamond as $parent) {
            foreach ($diamond as $child) {
                // dd($parent,$child);
                if(!isset($child['DisplayCut'])){
                    dd($child);
                }
                if (($parent['Weight'] - $child['Weight']) <= 0.1) {

                    if (
                        !isset($uniqueArr[$child['RefNo']])
                        && (abs($parent['Weight'] - $child['Weight']) <= 0.1)
                        && $parent['DisplayShape'] == $child['DisplayShape']
                        && $parent['Clarity'] == $child['Clarity']
                        && $parent['DisplayCut'] == $child['DisplayCut']
                        && $parent['Color'] == $child['Color']
                        && $parent['RefNo'] != $child['RefNo']
                    ) {
                        $tempPair = [];
                        $tempPair[] = $parent;
                        $tempPair[] = $child;
                        $tempPair['total_price'] = $parent['Price'] + $child['Price'];
                        array_push($pair, $tempPair);
                    }
                }
            }

            $uniqueArr[$parent['RefNo']] = true;
            \Log::info("Unique Array : " . json_encode($uniqueArr));
        }
        usort($pair, function ($a, $b) {
            return $a['total_price'] <=> $b['total_price'];
        });
        $res = General::success_res();
        $res['data'] = $pair;
        // dd($res);
        return $res;
    }

    public static function filterAndModifyData($data, $apiName)
    {

        \Log::info('---------------------------------------');
        \Log::info('Api called : ' . $apiName);

        $keyMapping = null;

        $keyMappingParishi = [
            'CutName' => 'Shape',
            'ColorCode' => 'Color',
            'ClarityName' => 'Clarity',
            'PropCode' => 'Cut',
            'CertName' => 'Cert',
            'TotDepth' => 'TopDepth',
            'PolishName' => 'Pol',
            'SymName' => 'Sym',
            'FLName' => 'FL',
            'Availability' => 'Status',
            'CertificatePath' => 'CertLink',
            'ImagePath' => 'ImageLink',
            'VideoPath' => 'VideoLink',
            'Rate' => 'CAmount'
        ];

        $keyMappingSanghvi = [
            'Stock No' => 'RefNo',
            'Certificate' => 'Cert',
            'Measurment' => 'Diameter',
            'Cert No' => 'CertNo',
            'Depth %' => 'TopDepth',
            'Table %' => 'Table',
            'Polish' => 'Pol',
            'Symm' => 'Sym',
            'Flour' => 'FL',
            'AVAILABILITY' => 'Status',
            'Certi Img' => 'CertLink',
            'Diam Img' => 'ImageLink',
            'Diam Video' => 'VideoLink',
            'Net Amount' => 'CAmount',
            'Country' => 'Location'
        ];

        $keyMappingAsianStars = [
            'STONE_ID' => 'RefNo',
            'WEIGHT' => 'Weight',
            'MEASUREMENTS' => 'Diameter',
            'SHAPE' => 'Shape',
            'COLOR' => 'Color',
            'CLARITY' => 'Clarity',
            'FINAL_CUT' => 'Cut',
            'LAB' => 'Cert',
            'REPORT_NO' => 'CertNo',
            'DEPTH_PER' => 'TopDepth',
            'TABLE_PER' => 'Table',
            'POLISH' => 'Pol',
            'SYMMETRY' => 'Sym',
            'FLUOR_INT' => 'FL',
            'STATUS' => 'Status',
            'CERTY_PATH' => 'CertLink',
            'IMAGE_PATH' => 'ImageLink',
            'ASK_AMT' => 'CAmount',
            'LOC_CD' => 'Location'
        ];

        // canva for dharam
        // measurement m1 * m2 * m3
        $keyMappingDharam = [
            'Ref' => 'RefNo',
            'Size' => 'Weight',
            'Depth' => 'TopDepth',
            'Polish' => 'Pol',
            'Flour' => 'FL',
            'CertPDFURL' => 'CertLink',
            'ImageURL' => 'ImageLink',
            'Rate' => 'CAmount',
        ];

        if ($apiName == 'parishi') {
            $keyMapping = $keyMappingParishi;
        } elseif ($apiName == 'sanghvi') {
            $keyMapping = $keyMappingSanghvi;
        } elseif ($apiName == 'asianstars') {
            $keyMapping = $keyMappingAsianStars;
        } elseif ($apiName == 'dharam') {
            $keyMapping = $keyMappingDharam;
        }
        try {
            // Rename keys based on the mapping
            $modifiedData = array_map(function ($item) use ($apiName, $keyMapping) {
                $settings = app('settings');
                $item['apiName'] = $apiName;
                // Rename keys based on the mapping
                if($keyMapping != null){
                    foreach ($keyMapping as $oldKey => $starraysKey) {
                        if(!isset($item['FINAL_CUT']) && $apiName == 'asianstars'){
                            $item['FINAL_CUT'] = '-';
                        }
                        if (isset($item[$oldKey])) {
                            if($item[$oldKey] == null) {
                                $item[$starraysKey] = '-';
                                unset($item[$oldKey]);
                            } else {
                                $item[$starraysKey] = $item[$oldKey];
                                unset($item[$oldKey]);
                            }
                        }
                        
                    }
                }
                if (isset($item['Shape'])) {
                    // \Log::info("Shape Item".json_encode($item));
                    // $item[$starraysKey] = $this->changeShapeValue($item[$starraysKey]);
                    $item['DisplayShape'] = self::changeShapeValue($item['Shape']);
                }
                if (isset($item['Cut'])) {
                    $item['DisplayCut'] = self::changeCutValue($item['Cut']);
                }
                if (isset($item['Pol'])) {
                    $item['DisplayPol'] = self::changePolishValue($item['Pol']);
                }
                if (isset($item['FL'])) {
                    $item['DisplayFl'] = self::changeFlourescenceValue($item['FL']);
                }
                if (isset($item['Color'])) {
                    if (!in_array($item['Color'], ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K'])) {
                        // \Log::info('Color : ' . $item['Color']);
                        // continue;
                    }
                }
                if (isset($item['CAmount'])) {
                    if ($item['apiName'] == 'parishi') {
                        $item['Price'] = round(General::addCommission(($item['CAmount'] * $item['Weight']) * $settings['usd_to_inr_rate']));
                    } else {
                        $item['Price'] = round(General::addCommission(($item['CAmount'] * $settings['usd_to_inr_rate'])));
                    }
                }
                return $item;
            }, $data);
            // Additional filters after renaming keys
            $modifiedData = array_filter($modifiedData, function ($item) {
                return
                isset($item['DisplayShape'], $item['Cert'], $item['Status'], $item['Location'], $item['Color'], $item['CertNo'], $item['CertLink'], $item['ImageLink']) &&
                    in_array($item['Cert'], ['GIA', 'IGI']) &&
                    in_array($item['Status'], ['S', 'I', 'AVAILABLE', 'Available','Avail']) &&
                    in_array($item['Location'], ['India', 'INDIA', 'IND', 'Ind','IN']) &&
                    in_array($item['Color'], ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K']) &&
                    in_array($item['DisplayShape'], ['Round', 'Cushion', 'Emerald', 'Heart', 'Marquise', 'Oval', 'Pear', 'Princess', 'Radiant', 'Trilliant']) &&
                    $item['CertNo'] !== "" &&
                    $item['CertLink'] !== "" &&
                    $item['ImageLink'] !== "";
            });

            usort($modifiedData, function ($a, $b) {
                return $a['Price'] <=> $b['Price'];
            });

            $minRate = $modifiedData[0]['Price'];
            $maxRate = $modifiedData[count($modifiedData) - 1]['Price'];


            return $modifiedData;
        } catch (\Exception $e) {
            \Log::info('error in api '.$apiName);
            \Log::info($e);
            return null;
        }
    }

    public static function changeShapeValue($value)
    {

        if (in_array($value, ['RD', 'BR', 'ROUND'])) return 'Round';
        elseif (in_array($value, ['CB', 'CMB', 'CU', 'L.CMB', 'SQ.CMB', 'CUSHION'])) return 'Cushion';
        elseif (in_array($value, ['EM', 'LR', 'EMERALD'])) return 'Emerald';
        elseif (in_array($value, ['HE', 'HEART'])) return 'Heart';
        elseif (in_array($value, ['MQ', 'MARQUISE'])) return 'Marquise';
        elseif (in_array($value, ['OV', 'OVAL'])) return 'Oval';
        elseif (in_array($value, ['PE', 'PEAR'])) return 'Pear';
        elseif (in_array($value, ['PR', 'PRINCESS'])) return 'Princess';
        elseif (in_array($value, ['RA', 'RADIANT'])) return 'Radiant';
        elseif (in_array($value, ['TRI'])) return 'Trilliant';
        else {
            return $value;
        }
    }
    public static function changeCutValue($value)
    {

        if (in_array($value, ['EX'])) return 'Excellent';
        elseif (in_array($value, ['VG'])) return 'Very Good';
        elseif (in_array($value, ['G', 'GD'])) return 'Good';
        elseif (in_array($value, ['ID'])) return 'Ideal';
        elseif (in_array($value, ['-'])) return '-';
        else {
            return $value;
        }
    }
    public static function changePolishValue($value)
    {

        if (in_array($value, ['EX'])) return 'Excellent';
        elseif (in_array($value, ['VG'])) return 'Very Good';
        elseif (in_array($value, ['G', 'GD'])) return 'Good';
        elseif (in_array($value, ['ID'])) return 'Ideal';
        else {
            return $value;
        }
    }
    public static function changeFlourescenceValue($value)
    {

        if (in_array($value, ['N', 'NONE', 'NON'])) return 'None';
        elseif (in_array($value, ['M', 'MED'])) return 'Medium';
        elseif (in_array($value, ['ST', 'STR', 'STG'])) return 'Strong';
        elseif (in_array($value, ['V.STR', 'VST'])) return 'Very Strong';
        elseif (in_array($value, ['F', 'FNT', 'VSL', 'SL'])) return 'Faint';
        else {
            return $value;
        }
    }


    public function postShowSolitaire()
    {
        $param = \Input::all();
        // $param['solitaireData']['solitaire_setting_product'] = $param['product'];
        if (isset($param['product']) && $param['product'] == 'pendants') {
            $param['solitaireData']['solitaire_setting_product'] = 'pendants';
        } else {
            $param['solitaireData']['solitaire_setting_product'] = 'rings';
        }
        if (Session::has('selectSolitaire'))
            Session::forget('selectSolitaire');
        Session::put('selectSolitaire', $param['solitaireData']);
        return General::success_res();
    }
    
    public function getSolitaireDetail()
    {
        $solitaireData = Session::get('selectSolitaire');
        if (!isset($solitaireData['RefNo'])) abort('404');
        // dd($solitaireData);
        $view_data = [
            'header' => [
                "title" => 'Solitaire Detail | ' . self::$platform,
                "css" => ['site/product-detail.min.css']
            ],
            'body' => [
                'title' => 'Checkout',
                'solitaire' => $solitaireData
            ],
            'footer' => [
                'js' => ['site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
            ]
        ];
        return view('solitaire_detail', $view_data);
    }

    public function getSolitaireDetailLoose()
    {
        $solitaireData = Session::get('selectSolitaire');
        if (!isset($solitaireData['RefNo'])) abort('404');
        $view_data = [
            'header' => [
                "title" => 'Solitaire Detail | ' . self::$platform,
                "css" => ['site/product-detail.min.css']
            ],
            'body' => [
                'title' => 'Solitaire Detils',
                'solitaire' => $solitaireData
            ],
            'footer' => [
                'js' => ['site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
            ]
        ];
        return view('loose_solitaire_detail', $view_data);
    }

    // db test
    // public function getSolitaireDetailLoose($ref_no)
    // {
    //     $solitaireData = SolitaireData::where('RefNo',$ref_no)->first();
    //     if (!$solitaireData) abort('404');
    //     $view_data = [
    //         'header' => [
    //             "title" => 'Solitaire Detail | ' . self::$platform,
    //             "css" => ['site/product-detail.min.css']
    //         ],
    //         'body' => [
    //             'title' => 'Solitaire Detils',
    //             'solitaire' => $solitaireData
    //         ],
    //         'footer' => [
    //             'js' => ['site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
    //         ]
    //     ];
    //     return view('sol.loose_solitaire_detail_db', $view_data);
    // }
    
    public function getSolitairePairDetailLoose(){
        $solitaireData = Session::get('selectSolitairePair');
        // dd($solitaireData);
        if (!isset($solitaireData[0]['RefNo']) || !isset($solitaireData[1]['RefNo'])) abort('404');
        $view_data = [
            'header' => [
                "title" => 'Solitaire Pair Detail | ' . self::$platform,
                "css" => ['site/product-detail.min.css']
            ],
            'body' => [
                'title' => 'Checkout',
                'solitaire' => $solitaireData
            ],
            'footer' => [
                'js' => ['site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
            ]
        ];
        return view('loose_solitaire_pair_detail', $view_data);
    }

    /**
     * pairing page
     */
    public function postShowSolitairePair()
    {
        $param = \Input::all();
        // $param['solitaireData']['solitaire_setting_product'] = $param['product'];
        $param['solitaireData']['solitaire_setting_product'] = $param['product'];
        if (Session::has('selectSolitairePair'))
            Session::forget('selectSolitairePair');
        Session::put('selectSolitairePair', $param['solitaireData']);
        return \General::success_res();
    }
    public function getSolitairePairDetail()
    {
        $solitaireData = Session::get('selectSolitairePair');
        // dd($solitaireData);
        if (!isset($solitaireData[0]['RefNo']) || !isset($solitaireData[1]['RefNo'])) abort('404');
        $view_data = [
            'header' => [
                "title" => 'Solitaire Pair Detail | ' . self::$platform,
                "css" => ['site/product-detail.min.css']
            ],
            'body' => [
                'title' => 'Checkout',
                'solitaire' => $solitaireData
            ],
            'footer' => [
                'js' => ['site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
            ]
        ];
        return view('solitaire_pair_detail', $view_data);
    }

    public function getProducts($category = null, $subcategory = null)
    {
        $param = \Input::all();
        if ($subcategory == 'sol') {
            $param['sc'] = 'sol';
        }
        if ($category != null) {
            $param['c'] = $category;
        }
        // dd($param);
        if (isset($param['c'])) {
            $category = \App\Models\Admin\Category::where('name', strtolower($param['c']))->first();
            $param['c'] = $category['id'];
        }
        if (isset($param['sc'])) {
            if ($param['sc'] != 'sol') {
                $subcategory = \App\Models\Admin\SubCategory::where('name', strtolower($param['sc']))->first();
                $param['sc'] = $subcategory['id'];
            }
        }
        $paramSortIsDescending = isset($param['sort']) && $param['sort'] == 'price-desc';
        $productsQuery = \App\Models\Admin\Product::with(['category', 'subcategory'])
            ->where('status', 1);
        if (isset($param['sc'])) {
            if ($param['sc'] == 'sol') {
                $productsQuery->where('is_solitaire', 'yes');
            } else {
                $productsQuery->where('solitaire_setting', '!=', 'yes');
            }
        } else {
            $productsQuery->where('solitaire_setting', '!=', 'yes');
        }
        if (isset($param['c'])) {
            $productsQuery->where('category_id', $param['c']);
        }
        if (isset($param['range'])) {
            $productsQuery->where('product_buy_price', '>=', $param['range']);
        }
        if (isset($param['to'])) {
            $productsQuery->where('product_buy_price', '<=', $param['to']);
        }
        if (isset($param['search'])) {
            $productsQuery = $productsQuery->where(function ($query) use ($param) {
                $query->where('name', 'LIKE', '%' . $param['search'] . '%')
                    ->orWhere('description', 'LIKE', '%' . $param['search'] . '%');
            });
        }

        $products = $productsQuery->get()->toArray();
        // dd($products);
        $filters = array(
            'c' => isset($param['c']) ? $param['c'] : null,
            'sc' => isset($param['sc']) ? $param['sc'] : null,
            'sort' => isset($param['sort']) ? $param['sort'] : null
        );
        $title = 'Jewellery';
        $heading = 'Select Jewellery';
        $subcategoryList = null;
        $settings = app('settings');
        if ($products) {

            $wishlist = [];
            if (\Auth::guard('user')->check()) {
                $wishlist = \App\Models\User\Wishlist::get_user_wishlist();
            }
            if (isset($param['c'])) {
                $subcategoryList = SubCategory::get_subcategory_by_category_id($param['c']);
            } else {
                $subcategoryList = null;
            }
            // dd($products[0]);
            if ($products[0]['category_id'] == 2) $subcategoryList = null;

            foreach ($products as $key => &$product) {
                $product['diamond'] = json_decode($product['diamond'], true);
                $product = General::getProductPrice($product);
                if (in_array($product['id'], $wishlist)) {
                    $product['wishlist'] = 'yes';
                } else {
                    $product['wishlist'] = 'no';
                }
            }

            if (isset($param['sort'])) {
                // Sort the products array by default_base_price
                usort($products, function ($a, $b) use ($paramSortIsDescending) {
                    if ($a['default_base_price'] == $b['default_base_price']) {
                        return 0;
                    }

                    if ($paramSortIsDescending) {
                        return ($a['default_base_price'] > $b['default_base_price']) ? -1 : 1;
                    } else {
                        return ($a['default_base_price'] < $b['default_base_price']) ? -1 : 1;
                    }
                });
            }
            if (isset($param['c'])) {
                $title = $products[0]['category']['name'];
                if ($products[0]['is_solitaire'] == 'yes') {
                    $title = 'Solitaire ' . $products[0]['category']['name'];
                }
            }

            if (isset($param['c'])) {
                $heading = 'Select ' . $products[0]['category']['name'];
                if ($products[0]['is_solitaire'] == 'yes') {
                    $heading = 'Select your solitaire ' . $products[0]['category']['name'];
                }
            }
        }
        $view_data = [
            'header' => [
                "title" => 'Products | ' . self::$platform,
            ],
            'body' => [
                'title' => $title,
                'heading' => $heading,
                'subcategoryList' => $subcategoryList,
                'filters' => $filters,
                'products' => $products,
                'settings' => $settings
            ],
            'footer' => [
                'js' => []
            ]
        ];

        // dd($products);
        return view('product_filter', $view_data);
    }

    public function getChains()
    {
        $chains = \App\Models\Admin\Product::with('category')->where('category_id', 6)->get()->toArray();
        // dd($chains);
        $filters = array(
            'c' => isset($param['c']) ? $param['c'] : null,
            'sc' => isset($param['sc']) ? $param['sc'] : null,
            'sort' => isset($param['sort']) ? $param['sort'] : null
        );
        foreach ($chains as $key => &$chain) {
            $chain['diamond'] = json_decode($chain['diamond'], true);
            $chain = General::getProductPrice($chain);
        }
        $view_data = [
            'header' => [
                "title" => 'Chains | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Chains',
                'heading' => 'Select Chain',
                'filters' => $filters,
                'chains' => $chains
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('chains', $view_data);
    }

    public function postProductFilter()
    {
        $param = \Input::all();
        // dd($param);
        $data = \App\Models\Admin\Product::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("product_filter_list", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }

    public function getSelectSolitaire()
    {
        $param = \Input::all();
        if (!isset($param['cat'])) abort('404');
        if ($param['cat'] == '') abort('404');
        $solitiarProduct = Product::getSolitaireProduct($param);
        foreach ($solitiarProduct as $key => $product) {
            $solitiarProduct[$key] = General::getProductPrice($product, 1);
        }
        $settings = app('settings');
        $diamond_selected = 0;
        $product_selected = 0;
        $product = [];
        $diamond = [];
        if (isset($param['selected'])) {
            $diamond = Session::get('solitaire');
            if ($param['selected'] == 1) {
                $diamond_selected = 1;
            }
            if ($param['selected'] == 2 && Session::has('solitaire') && Session::has('solitaire_product')) {
                $diamond_selected = 1;
                $product_selected = 1;
                $productId = Session::get('solitaire_product');
                $product = Product::where('id', $productId)->first();
                if (is_null($product)) abort('404');

                $product = $product->toArray();
                $product['diamond'] = json_decode($product['diamond'], true);
                $product = General::getProductPrice($product, 1);
                $allColors = explode(',', $product['color']);
                $allColorCodes = array();
                if (isset($product['dimension']) && $product['dimension'] != '') {
                    $product['dimension'] = json_decode($product['dimension'], true);
                }
                foreach ($allColors as $color) {
                    $colorArr = array(
                        'color_code' => config('constant.COLOR_CODE.' . $color),
                        'color' => $color
                    );
                    array_push($allColorCodes, $colorArr);
                }
                $product['all_colors'] = $allColorCodes;
                $product['all_videos'] =  null;
                if (isset($product['video']) && $product['video'] != '') {
                    $product['all_videos'] =  explode(',', $product['video']);
                    $product['default_video'] = config('constant.COLOR_CODE.' . $product['default_color']);
                    $videoList = array();
                    foreach ($allColorCodes as $colors) {
                        $video_code = '';
                        if (in_array($colors['color'], $product['all_videos'])) {
                            $video_code = config('constant.COLOR_CODE.' . $colors['color']);
                        } else {
                            $video_code = $product['default_video'];
                        }
                        if (!isset($videoList[$colors['color_code']])) {
                            $videoList[$colors['color_code']] = $video_code;
                        }
                    }
                    $product['all_videos'] = $videoList;
                }
                // else {
                //     $product['default_video'] =  '0';
                // }
                $settings = app('settings');
                $product['14K_gold_price'] = $settings['gold_rate_14k'];
                $product['18K_gold_price'] = $settings['gold_rate_18k'];


                if (isset($product['diamond'][0]['price_IJ_SI']))
                    $product['price_IJ_SI'] = $product['diamond'][0]['price_IJ_SI'];
                else
                    $product['price_IJ_SI'] = $settings['price_IJ_SI'] * $product['diamond'][0]['carat'];
                if (isset($product['diamond'][0]['price_GH_SI']))
                    $product['price_GH_SI'] = $product['diamond'][0]['price_GH_SI'];
                else
                    $product['price_GH_SI'] = $settings['price_GH_SI'] * $product['diamond'][0]['carat'];
                if (isset($product['diamond'][0]['price_GH_VS']))
                    $product['price_GH_VS'] = $product['diamond'][0]['price_GH_VS'];
                else
                    $product['price_GH_VS'] = $settings['price_GH_VS'] * $product['diamond'][0]['carat'];
                if (isset($product['diamond'][0]['price_EF_VVS']))
                    $product['price_EF_VVS'] = $product['diamond'][0]['price_EF_VVS'];
                else
                    $product['price_EF_VVS'] = $settings['price_EF_VVS'] * $product['diamond'][0]['carat'];
            }
        }
        // dd($diamond);
        // dd($product);
        $product['images'] = array();
        if(isset($product['product_sku'])){
            $product['images'] = \General::checkProductImages($product['product_sku'], config('constant.COLOR_CODE.' . $product['default_color']));
        }
        $view_data = [
            'header' => [
                "title" => 'Diamonds | ' . self::$platform,
                "css" => ['site/product-detail.min.css', 'dataTable.min.css']
            ],
            'body' => [
                'title' => 'Diamonds',
                'solitiarProduct' => $solitiarProduct,
                'settings' => $settings,
                'step2_title' => ucfirst($param['cat']),
                'category' => $param['cat'],
                'diamond_selected' => $diamond_selected,
                'product_selected' => $product_selected,
                'selected_product' => $product,
                'selected_diamond' => $diamond
            ],
            'footer' => [
                'js' => ['dataTable.min.js', 'site/diamond_filter.min.js', 'site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
            ]
        ];

        // dd($products);
        return view('diamond_filter', $view_data);
    }
    public function getMatchingDiamondPair()
    {
        $param = \Input::all();
        if (!isset($param['cat'])) abort('404');
        if ($param['cat'] == '') abort('404');
        $solitiarProduct = Product::getSolitaireProduct($param);
        foreach ($solitiarProduct as $key => $product) {
            $solitiarProduct[$key] = General::getProductPrice($product, 1);
        }
        $settings = app('settings');
        $diamond_selected = 0;
        $product_selected = 0;
        $product = [];
        $diamond = [];
        if (isset($param['selected'])) {
            $diamond = Session::get('solitaire_pair');
            if ($param['selected'] == 1) {
                $diamond_selected = 1;
            }
            if ($param['selected'] == 2 && Session::has('solitaire_pair') && Session::has('solitaire_pair_product')) {
                $diamond_selected = 1;
                $product_selected = 1;
                $productId = Session::get('solitaire_pair_product');
                $product = Product::where('id', $productId)->first();
                if (is_null($product)) abort('404');

                $product = $product->toArray();
                $product['diamond'] = json_decode($product['diamond'], true);
                $product = General::getProductPrice($product, 1);
                $allColors = explode(',', $product['color']);
                $allColorCodes = array();
                if (isset($product['dimension']) && $product['dimension'] != '') {
                    $product['dimension'] = json_decode($product['dimension'], true);
                }
                foreach ($allColors as $color) {
                    $colorArr = array(
                        'color_code' => config('constant.COLOR_CODE.' . $color),
                        'color' => $color
                    );
                    array_push($allColorCodes, $colorArr);
                }
                $product['all_colors'] = $allColorCodes;

                if (isset($product['video']) && $product['video'] != '') {
                    $product['all_videos'] =  explode(',', $product['video']);
                    $product['default_video'] = config('constant.COLOR_CODE.' . $product['default_color']);
                    $videoList = array();
                    foreach ($allColorCodes as $colors) {
                        $video_code = '';
                        if (in_array($colors['color'], $product['all_videos'])) {
                            $video_code = config('constant.COLOR_CODE.' . $colors['color']);
                        } else {
                            $video_code = $product['default_video'];
                        }
                        if (!isset($videoList[$colors['color_code']])) {
                            $videoList[$colors['color_code']] = $video_code;
                        }
                    }
                    $product['all_videos'] = $videoList;
                }
                $settings = app('settings');
                $product['14K_gold_price'] = $settings['gold_rate_14k'];
                $product['18K_gold_price'] = $settings['gold_rate_18k'];


                if (isset($product['diamond'][0]['price_IJ_SI']))
                    $product['price_IJ_SI'] = $product['diamond'][0]['price_IJ_SI'];
                else
                    $product['price_IJ_SI'] = $settings['price_IJ_SI'] * $product['diamond'][0]['carat'];
                if (isset($product['diamond'][0]['price_GH_SI']))
                    $product['price_GH_SI'] = $product['diamond'][0]['price_GH_SI'];
                else
                    $product['price_GH_SI'] = $settings['price_GH_SI'] * $product['diamond'][0]['carat'];
                if (isset($product['diamond'][0]['price_GH_VS']))
                    $product['price_GH_VS'] = $product['diamond'][0]['price_GH_VS'];
                else
                    $product['price_GH_VS'] = $settings['price_GH_VS'] * $product['diamond'][0]['carat'];
                if (isset($product['diamond'][0]['price_EF_VVS']))
                    $product['price_EF_VVS'] = $product['diamond'][0]['price_EF_VVS'];
                else
                    $product['price_EF_VVS'] = $settings['price_EF_VVS'] * $product['diamond'][0]['carat'];
            }
        }
        $product['images'] = [];
        if(isset($product['product_sku'])){
            $product['images'] = \General::checkProductImages($product['product_sku'], config('constant.COLOR_CODE.' . $product['default_color']));
        }
        $view_data = [
            'header' => [
                "title" => 'Diamonds Pair | ' . self::$platform,
                "css" => ['site/product-detail.min.css', 'dataTable.min.css']
            ],
            'body' => [
                'title' => 'Diamonds Pair',
                'solitiarProduct' => $solitiarProduct,
                'settings' => $settings,
                'category' => $param['cat'],
                'diamond_selected' => $diamond_selected,
                'product_selected' => $product_selected,
                'selected_product' => $product,
                'selected_diamond' => $diamond
            ],
            'footer' => [
                'js' => ['dataTable.min.js', 'site/diamond_filter.min.js', 'site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
            ]
        ];
        // dd($view_data);
        // dd($products);
        return view('matching_diamond_pair', $view_data);
    }

    public function getProductDetail($categoryName = null, $sku = null, $color = null, $productName = null)
    {
        $param = \Input::all();

        if (!isset($param['product'])) {
            $param['product'] = $sku;
        }
        if (!isset($param['col'])) {
            $param['col'] = $color;
        }
        // dd($param);
        $settings = app('settings');
        $related_products = null;
        $product = \App\Models\Admin\Product::with(['category', 'subcategory', 'reviews'])->where('status', 1)
            ->where('product_sku', $param['product'])->where('default_color', $param['col'])->first();
        // dd($product);

        if (is_null($product)) {
            return view('errors.404');
        }
        $product['diamond'] = json_decode($product['diamond'], true);
        if ($product['related_items'] != '') {
            $related_products = \App\Models\Admin\Product::with(['category', 'subcategory'])
                ->whereIn('id', explode(',', $product['related_items']))->get()->toArray();
            if ($related_products) {
                foreach ($related_products as  $key => &$item) {
                    $item['diamond'] = json_decode($item['diamond'], true);
                    $item = General::getProductPrice($item);
                }
            }
        }
        $product = General::getProductPrice($product);
        $allColors = explode(',', $product['color']);
        $allColorCodes = array();
        if (isset($product['dimension']) && $product['dimension'] != '') {
            $product['dimension'] = json_decode($product['dimension'], true);
        }
        foreach ($allColors as $color) {
            $colorArr = array(
                'color_code' => config('constant.COLOR_CODE.' . $color),
                'color' => $color
            );
            array_push($allColorCodes, $colorArr);
        }
        $product['all_colors'] = $allColorCodes;

        $product['all_videos'] = null;
        if (isset($product['video']) && $product['video'] != '') {
            $product['all_videos'] =  explode(',', $product['video']);
            $product['default_video'] = config('constant.COLOR_CODE.' . $product['default_video']);
            $videoList = array();
            foreach ($allColorCodes as $colors) {
                $video_code = '';
                if (in_array($colors['color'], $product['all_videos'])) {
                    $video_code = config('constant.COLOR_CODE.' . $colors['color']);
                } else {
                    $video_code = $product['default_video'];
                }
                if (!isset($videoList[$colors['color_code']])) {
                    $videoList[$colors['color_code']] = $video_code;
                }
            }
            $product['all_videos'] = $videoList;
        }
        // else {
        //     $product['default_video'] =  '0';
        // }
        $settings = app('settings');
        $product['14K_gold_price'] = $settings['gold_rate_14k'];
        $product['18K_gold_price'] = $settings['gold_rate_18k'];
        // dd($product['diamond'][0]['price_IJ_SI']);
        if (isset($product['diamond'][0]['price_IJ_SI']))
            $product['price_IJ_SI'] = $product['diamond'][0]['price_IJ_SI'];
        else
            $product['price_IJ_SI'] = 0;
            // $product['price_IJ_SI'] = $settings['price_IJ_SI'] * $product['diamond'][0]['carat'];
        if (isset($product['diamond'][0]['price_GH_SI']))
            $product['price_GH_SI'] = $product['diamond'][0]['price_GH_SI'];
        else
            $product['price_GH_SI'] = 0;
            // $product['price_GH_SI'] = $settings['price_GH_SI'] * $product['diamond'][0]['carat'];
        if (isset($product['diamond'][0]['price_GH_VS']))
            $product['price_GH_VS'] = $product['diamond'][0]['price_GH_VS'];
        else
            $product['price_GH_VS'] = 0;
            // $product['price_GH_VS'] = $settings['price_GH_VS'] * $product['diamond'][0]['carat'];
        if (isset($product['diamond'][0]['price_EF_VVS']))
            $product['price_EF_VVS'] = $product['diamond'][0]['price_EF_VVS'];
        else
            $product['price_EF_VVS'] = 0;
            // $product['price_EF_VVS'] = $settings['price_EF_VVS'] * $product['diamond'][0]['carat'];

        $product['diamond_discount_per'] = $settings['diamond_discount'];

        if (isset($product['video']) && $product['video'] != '') {
            $product['is_video'] = true;
        } else {
            $product['is_video'] = false;
        }
        $checkChainInPendant = $product['subcategory']->toArray();
        $checkChainInPendant = collect($checkChainInPendant);
        $found = $checkChainInPendant->contains('subcategory_id', 12);
        $product['with_chains'] = 'not pendant';
        if ($found) {
            $product['with_chains'] = 'no';
        } else {
            $product['with_chains'] = 'yes';
        }

        $imagesCheck = \App\Lib\General::checkProductImages($product['product_sku'], config('constant.COLOR_CODE.' . $product['default_color']));
        $product['images'] = $imagesCheck;
        $view_data = [
            'header' => [
                "title" => $product['title'] .' | '. self::$platform .' Jewellery',
                "meta_title" => $product['meta_title'],
                "meta_description" => $product['meta_description'],
                "meta_keywords" => $product['meta_keywords'],
                "css" => ['site/product-detail.min.css']
            ],
            'body' => [
                'title' => 'Product',
                'product' => $product,
                'related_items' => $related_products,
                '14k_gold_price_per_gm' => $settings['gold_rate_14k'],
                '18k_gold_price_per_gm' => $settings['gold_rate_18k'],
            ],
            'footer' => [
                'js' => ['site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
            ]
        ];
        // Review::updateReview($product['product_sku']);
        return view('product_detail', $view_data);
    }

    public function getChainDetail($sku = null, $color = null, $productName = null)
    {
        $param = \Input::all();
        if (!isset($param['selected']) && $sku != null) {
            $param['col'] = $color;
            $param['selected'] = $sku;
        }
        $settings = app('settings');
        $product = \App\Models\Admin\Product::with(['category', 'subcategory'])->where('status', 1)
            ->where('product_sku', $param['selected'])->where('default_color', $param['col'])->first();
        if (is_null($product)) {
            return view('errors.404');
        }
        $product['diamond'] = json_decode($product['diamond'], true);
        $product = General::getProductPrice($product);
        $allColors = explode(',', $product['color']);
        $allColorCodes = array();
        if (isset($product['dimension']) && $product['dimension'] != '') {
            $product['dimension'] = json_decode($product['dimension'], true);
        }
        foreach ($allColors as $color) {
            $colorArr = array(
                'color_code' => config('constant.COLOR_CODE.' . $color),
                'color' => $color
            );
            array_push($allColorCodes, $colorArr);
        }
        $product['all_colors'] = $allColorCodes;

        if (isset($product['video']) && $product['video'] != '') {
            $product['all_videos'] =  explode(',', $product['video']);
            $product['default_video'] = config('constant.COLOR_CODE.' . $product['default_video']);
            $videoList = array();
            foreach ($allColorCodes as $colors) {
                $video_code = '';
                if (in_array($colors['color'], $product['all_videos'])) {
                    $video_code = config('constant.COLOR_CODE.' . $colors['color']);
                } else {
                    $video_code = $product['default_video'];
                }
                if (!isset($videoList[$colors['color_code']])) {
                    $videoList[$colors['color_code']] = $video_code;
                }
            }
            $product['all_videos'] = $videoList;
        }
        $product['is_video'] = 'yes';
        if ($product['video'] == '' && $product['default_video'] == '') {
            $product['is_video'] = 'no';
        }
        // else {
        //     $product['default_video'] =  '0';
        // }
        $settings = app('settings');
        $product['14K_gold_price'] = $settings['gold_rate_14k'];
        $product['18K_gold_price'] = $settings['gold_rate_18k'];

        if (isset($product['diamond'][0]['price_IJ_SI']))
            $product['price_IJ_SI'] = $product['diamond'][0]['price_IJ_SI'];
        else
            $product['price_IJ_SI'] = $settings['price_IJ_SI'] * $product['diamond'][0]['carat'];
        if (isset($product['diamond'][0]['price_GH_SI']))
            $product['price_GH_SI'] = $product['diamond'][0]['price_GH_SI'];
        else
            $product['price_GH_SI'] = $settings['price_GH_SI'] * $product['diamond'][0]['carat'];
        if (isset($product['diamond'][0]['price_GH_VS']))
            $product['price_GH_VS'] = $product['diamond'][0]['price_GH_VS'];
        else
            $product['price_GH_VS'] = $settings['price_GH_VS'] * $product['diamond'][0]['carat'];
        if (isset($product['diamond'][0]['price_EF_VVS']))
            $product['price_EF_VVS'] = $product['diamond'][0]['price_EF_VVS'];
        else
            $product['price_EF_VVS'] = $settings['price_EF_VVS'] * $product['diamond'][0]['carat'];

        $product['images'] = \General::checkProductImages($product['product_sku'], config('constant.COLOR_CODE.' . $product['default_color']));
        // dd($product);
        $view_data = [
            'header' => [
                "title" => 'Product | ' . self::$platform,
                "css" => ['site/product-detail.min.css']
            ],
            'body' => [
                'title' => 'Product',
                'product' => $product,
                '14k_gold_price_per_gm' => $settings['gold_rate_14k'],
                '18k_gold_price_per_gm' => $settings['gold_rate_18k'],
            ],
            'footer' => [
                'js' => ['site/product_detail.min.js', 'https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js']
            ]
        ];
        return view('chain_detail', $view_data);
    }

    public function postSelectChain()
    {
        $param = \Input::all();
        $total = 0;
        $gst = 0;
        if (!empty($param['productData'])) {
            $checkoutProducts = array();
            foreach ($param['productData'] as $cartProduct) {
                $cart = array();

                if ($cartProduct['product_type'] == 'product') {
                    $product = \App\Models\Admin\Product::where('product_sku', $cartProduct['product_sku'])
                        ->first();
                    // ->where('default_color', config('constant.COLOR.' . $cartProduct['color']))

                    if ($product == null) return General::error_res('Something went wrong!');
                    $product = $product->toArray();
                    $product = General::getProductPrice($product);
                    // dd($product);
                    $product['product_type'] = 'product';
                    $product['is_chain'] = 'yes';
                    $product['selected_color_code'] = $cartProduct['color'];
                    $product['selected_color'] = config('constant.COLOR.' . $cartProduct['color']);
                    $product['selected_gold_carat'] = $cartProduct['goldCarat'];



                    $product['selected_product_size'] = $cartProduct['size'];
                    if ($product['category_id'] == 1 || $product['category_id'] == 2 || $product['category_id'] == 5) {
                        $product['selected_gold_price'] = $product['gold_price_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                        $product['selected_gold_weight'] = $product['gold_weight_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                        $product['selected_making_charge'] = $product['making_charge_list'][$cartProduct['goldCarat']][$cartProduct['size']];

                        $product['selected_base_price'] = $product['gold_price_list'][$cartProduct['goldCarat']][$cartProduct['size']] + $product['making_charge_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                        $product['selected_buy_price'] = $product['gold_price_list'][$cartProduct['goldCarat']][$cartProduct['size']] + $product['making_charge_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                    } else {
                        $product['selected_gold_price'] = $product['gold_price_list'][$cartProduct['goldCarat']];
                        $product['selected_gold_weight'] = $product['gold_weight_list'][$cartProduct['goldCarat']];
                        $product['selected_making_charge'] = $product['making_charge_list'][$cartProduct['goldCarat']];

                        $product['selected_base_price'] = $product['gold_price_list'][$cartProduct['goldCarat']] + $product['making_charge_list'][$cartProduct['goldCarat']];
                        $product['selected_buy_price'] = $product['gold_price_list'][$cartProduct['goldCarat']] + $product['making_charge_list'][$cartProduct['goldCarat']];
                    }


                    $product['gst'] = '3';
                    $product['gst_amount'] = round(($product['selected_buy_price'] * 3) / 100);
                    $gst = $product['gst_amount'];
                    $total += $product['selected_buy_price'];
                    $cart = $product;

                    $checkoutProduct = Session::get('checkoutProduct');
                    if (!isset($checkoutProduct)) abort('404');

                    if ($checkoutProduct[0]['is_chain'] == 'yes' && isset($checkoutProduct[0]['chain'])) {
                        $oldChain = json_decode($checkoutProduct[0]['chain'], true);
                        $checkoutProduct[0]['selected_buy_price'] -= $oldChain['selected_buy_price'];
                        $checkoutProduct[0]['gst_amount'] -= $oldChain['gst_amount'];
                    }
                    $checkoutProduct[0]['is_chain'] = 'yes';
                    $checkoutProduct[0]['chain'] = json_encode($cart);

                    $checkoutProduct[0]['selected_buy_price'] = $checkoutProduct[0]['selected_buy_price'] + $total;

                    $checkoutProduct[0]['gst_amount'] = $checkoutProduct[0]['gst_amount'] + $gst;
                    $checkoutProduct[0]['chain_price'] = $product['selected_buy_price'];

                    if (Session::has('checkoutProduct')) Session::forget('checkoutProduct');
                    Session::put('checkoutProduct', $checkoutProduct);
                    return General::success_res();
                }
            }
        }
    }
    
    public function postStartCheckout()
    {
        $param = \Input::all();
        $total = 0;
        if (!empty($param['productData'])) {
            $checkoutProducts = array();
            foreach ($param['productData'] as $cartProduct) {
                $cart = array();
                $selectedDiamondPrice = 0;
                $selectedDiamondBasePrice = 0;
                $selectedSolitairePrice = 0;
                if ($cartProduct['product_type'] == 'product') {
                    $cart['coupon_discount_amount'] = 0;
                    $product = \App\Models\Admin\Product::with(['category', 'subcategory'])->where('product_sku', $cartProduct['product_sku'])
                        ->first();
                    // ->where('default_color', config('constant.COLOR.' . $cartProduct['color']))

                    $checkChainInPendant = $product['subcategory']->toArray();
                    $checkChainInPendant = collect($checkChainInPendant);
                    $found = $checkChainInPendant->contains('subcategory_id', 12);
                    $product['with_chains'] = 'not pendant';
                    if ($found) {
                        $product['with_chains'] = 'no';
                    } else {
                        $product['with_chains'] = 'yes';
                    }

                    $product['is_chain'] = 'no';
                    $product['chain'] = null;
                    if ($product == null) return General::error_res('Something went wrong!');
                    $product = $product->toArray();
                    $product = General::getProductPrice($product);
                    $product['product_type'] = 'product';
                    $product['selected_color_code'] = $cartProduct['color'];
                    $product['selected_color'] = config('constant.COLOR.' . $cartProduct['color']);
                    $product['selected_gold_carat'] = $cartProduct['goldCarat'];
                    if (isset($cartProduct['diamondQuality'])) {
                        $product['selected_diamond_quality'] = $cartProduct['diamondQuality'];
                        $selectedDiamondPrice = $product['diamond_price_list'][$cartProduct['diamondQuality']]['diamond_buy_price'];
                        $selectedDiamondBasePrice = $product['diamond_price_list'][$cartProduct['diamondQuality']]['diamond_base_price'];
                    }

                    $product['selected_diamond_price'] = $selectedDiamondPrice;
                    $product['selected_diamond_base_price'] = $selectedDiamondBasePrice;
                    // dd($cartProduct);
                    if (isset($cartProduct['solitaireQuality']) && $product['is_solitaire'] == 'yes') {
                        $product['product_type'] = 'preset';
                        $selectedSolitairePrice = $product['solitaire_price_list'][$cartProduct['solitaireQuality']][$cartProduct['solitaireCarat']];
                        $product['selected_solitaire_carat'] = $cartProduct['solitaireCarat'];
                        $product['selected_solitaire_shape'] = 'Round';
                        $product['selected_solitaire_FL'] = 'NONE';
                        $product['selected_soliraire_sym'] = 'Min. VG - VG - VG';
                        $product['selected_solitaire_quantity'] = '1';
                        if ($product['category_id'] == 3)
                            $product['selected_solitaire_quantity'] = '2';
                        $product['selected_solitaire_quality'] = $cartProduct['solitaireQuality'];
                    }
                    $stonePrice = 0;
                    if ($product['is_stone'] == 'yes') {
                        $stonePrice = $product['stone_price'];
                    }

                    $product['selected_solitaire_price'] = (int)$selectedSolitairePrice;
                    $product['selected_product_size'] = $cartProduct['size'];
                    if ($product['category_id'] == 1 || $product['category_id'] == 2 || $product['category_id'] == 5) {
                        $product['selected_gold_price'] = $product['gold_price_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                        $product['selected_gold_weight'] = $product['gold_weight_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                        $product['selected_making_charge'] = $product['making_charge_list'][$cartProduct['goldCarat']][$cartProduct['size']];

                        $product['selected_base_price'] = $stonePrice + $product['gold_price_list'][$cartProduct['goldCarat']][$cartProduct['size']] + $product['selected_diamond_base_price'] + $product['making_charge_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                        $product['selected_buy_price'] = $stonePrice + $product['gold_price_list'][$cartProduct['goldCarat']][$cartProduct['size']] + $product['selected_diamond_price'] + $product['making_charge_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                    } else {
                        $product['selected_gold_price'] = $product['gold_price_list'][$cartProduct['goldCarat']];
                        $product['selected_gold_weight'] = $product['gold_weight_list'][$cartProduct['goldCarat']];
                        $product['selected_making_charge'] = $product['making_charge_list'][$cartProduct['goldCarat']];

                        $product['selected_base_price'] = $stonePrice + $product['gold_price_list'][$cartProduct['goldCarat']] + $product['selected_diamond_base_price'] + $product['making_charge_list'][$cartProduct['goldCarat']];
                        $product['selected_buy_price'] = $stonePrice + $product['gold_price_list'][$cartProduct['goldCarat']] + $product['selected_diamond_price'] + $product['making_charge_list'][$cartProduct['goldCarat']];
                    }
                    if (isset($product['selected_solitaire_quantity'])) {
                        $product['selected_base_price'] += $product['selected_solitaire_price'];
                        $product['selected_buy_price'] += $product['selected_solitaire_price'];
                    }

                    $product['gst'] = '3';
                    $product['gst_amount'] = round(($product['selected_buy_price'] * 3) / 100);
                    $total += $product['selected_buy_price'];
                    $cart = $product;
                } else {
                    // solitaire
                    $product = \App\Models\Admin\Product::where('product_sku', $cartProduct['product_sku'])
                        ->first();
                    $product['is_chain'] = 'no';
                    $product['chain'] = null;
                    // ->where('default_color', config('constant.COLOR.' . $cartProduct['color']))
                    $product['selected_solitaire_price'] = 0;
                    if ($product == null) return General::error_res('Something went wrong!');
                    $product = $product->toArray();
                    $product = General::getProductPrice($product);
                    $product['product_type'] = 'solitaire';
                    $product['selected_color_code'] = $cartProduct['color'];
                    $product['selected_gold_carat'] = $cartProduct['goldCarat'];
                    $product['selected_color'] = config('constant.COLOR.' . $cartProduct['color']);
                    $product['selected_diamond_price'] = null;
                    if (isset($cartProduct['diamondQuality'])) {
                        $product['selected_diamond_quality'] = $cartProduct['diamondQuality'];
                        $selectedDiamondPrice = $product['diamond_price_list'][$cartProduct['diamondQuality']]['diamond_buy_price'];
                    }

                    $product['selected_diamond_price'] = $selectedDiamondPrice;

                    $product['selected_product_size'] = $cartProduct['size'];
                    if ($product['category_id'] == 1 || $product['category_id'] == 2 || $product['category_id'] == 5) {
                        $product['selected_gold_price'] = $product['gold_price_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                        $product['selected_gold_weight'] = $product['gold_weight_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                        $product['selected_making_charge'] = $product['making_charge_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                        if (isset($cartProduct['diamondQuality'])) {
                            $product['selected_base_price'] = $product['gold_price_list'][$cartProduct['goldCarat']][$cartProduct['size']] + $product['selected_diamond_price'] + $product['making_charge_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                            $product['selected_buy_price'] = $product['gold_price_list'][$cartProduct['goldCarat']][$cartProduct['size']] + $product['selected_diamond_price'] + $product['making_charge_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                        } else {
                            $product['selected_base_price'] = $product['gold_price_list'][$cartProduct['goldCarat']][$cartProduct['size']] +  $product['making_charge_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                            $product['selected_buy_price'] = $product['gold_price_list'][$cartProduct['goldCarat']][$cartProduct['size']]  + $product['making_charge_list'][$cartProduct['goldCarat']][$cartProduct['size']];
                        }
                    } else {
                        $product['selected_gold_price'] = $product['gold_price_list'][$cartProduct['goldCarat']];
                        $product['selected_gold_weight'] = $product['gold_weight_list'][$cartProduct['goldCarat']];
                        $product['selected_making_charge'] = $product['making_charge_list'][$cartProduct['goldCarat']];
                        if (isset($cartProduct['diamondQuality'])) {
                            $product['selected_base_price'] = $product['gold_price_list'][$cartProduct['goldCarat']] + $product['selected_diamond_price'] + $product['making_charge_list'][$cartProduct['goldCarat']];
                            $product['selected_buy_price'] = $product['gold_price_list'][$cartProduct['goldCarat']] + $product['selected_diamond_price'] + $product['making_charge_list'][$cartProduct['goldCarat']];
                        } else {
                            $product['selected_base_price'] = $product['gold_price_list'][$cartProduct['goldCarat']] + $product['making_charge_list'][$cartProduct['goldCarat']];
                            $product['selected_buy_price'] = $product['gold_price_list'][$cartProduct['goldCarat']] + $product['making_charge_list'][$cartProduct['goldCarat']];
                        }
                    }

                    $product['gst'] = '3';
                    $product['gst_amount'] = round(($product['selected_buy_price'] * 3) / 100);
                    $total += $product['selected_buy_price'];
                    $cart = $product;
                    // $cart = $cartProduct;
                    $solitaire1Cert = null;
                    $solitaire2Cert = null;
                    $solitairePrice = 0;
                    //dd($diamond, $product);
                    if ($product['category_id'] == 3) {
                        $diamond = Session::get('solitaire_pair');
                        $solitaire1Cert = $diamond[0]['CertNo'];
                        $solitaire2Cert = $diamond[1]['CertNo'];
                    } else {
                        $diamond = Session::get('solitaire');
                        $solitaire1Cert = $diamond['CertNo'];
                    }

                    if (\Cache::has('api_data')) {

                        $solitaires = \Cache::get('api_data');

                        $filterSolitaires = array_filter($solitaires, function ($item) use ($solitaire1Cert, $solitaire2Cert) {
                            // Filter based on Cert (GIA or IGI), Status ('S' or 'Available'), Location ('India'), and CertNo is not empty
                            return in_array($item['CertNo'], [$solitaire1Cert, $solitaire2Cert]);
                        });

                        $solArr = array();
                        if ($filterSolitaires) {
                            foreach ($filterSolitaires as $sol) {
                                $solitairePrice += $sol['Price'];
                                $solArr[] = $sol;
                            }
                            // $param['solitaire'] = json_encode($solArr);
                            $cart['gst_amount'] += round(($solitairePrice * 3) / 100);
                            if (count($solArr) == 1) {
                                $cart['solitaire'] = $solArr[0];
                            } else {
                                $solArr['total_price'] = $solitairePrice;
                                $cart['solitaire'] = $solArr;
                            }
                        }
                    } else {
                        \Log::error("Data not found in cache.");
                        return;
                    }

                    // if ($product['category_id'] == 3) {
                    //     $diamond = Session::get('solitaire_pair');
                    //     $diamond['solitaire_gst'] = round(($diamond['total_price'] * 3) / 100);
                    //     $cart['gst_amount'] += $diamond['solitaire_gst'];
                    // } else {
                    //     $diamond = Session::get('solitaire');
                    //     $diamond['solitaire_gst'] = round(($diamond['Price'] * 3) / 100);
                    //     $cart['gst_amount'] += $diamond['solitaire_gst'];
                    // }

                    // $cart['solitaire'] = $diamond;
                }
                array_push($checkoutProducts, $cart);
            }
        }

        if (Session::has('checkoutProduct')) Session::forget('checkoutProduct');
        Session::put('checkoutProduct', $checkoutProducts);
        return General::success_res();
    }

    public function getCheckout()
    {
        $param = \Input::all();
        $login_type = 'user';
        if (\Auth::guard('user')->check()) {
            $login_type = 'user';
        } else {
            $login_type = 'guest';
        }
        // if (isset($param['login_type'])) {
        // }
        $states = \App\Models\Admin\Pincode::select('state', \DB::raw('MIN(id) as id'))->groupBy('state')->get()->toArray();
        $checkoutProduct = Session::get('checkoutProduct');
        if (!isset($checkoutProduct)) abort('404');
        if (!isset($checkoutProduct[0]['product_sku'])) abort('404');
        $coupon = null;
        if (isset($checkoutProduct[0]['coupon_code'])) {
            $coupon = $checkoutProduct[0]['coupon_code'];
        }
        $finalAmount = 0;
        $gst = 0;
        foreach ($checkoutProduct as $product) {
            $getProduct = Product::with(['category', 'subcategory'])->where('product_sku', $product['product_sku'])->first();
            if (is_null($getProduct)) continue;

            $checkChainInPendant = $getProduct['subcategory']->toArray();
            $checkChainInPendant = collect($checkChainInPendant);
            $found = $checkChainInPendant->contains('subcategory_id', 12);
            $getProduct['with_chains'] = 'not pendant';
            if ($found) {
                $getProduct['with_chains'] = 'no';
            } else {
                $getProduct['with_chains'] = 'yes';
            }

            $productDetail[] = $getProduct->toArray();
            if (isset($product['solitaire'])) {
                if ($product['category_id'] == 3) {
                    $finalAmount += $product['solitaire']['total_price'];
                } else {
                    $finalAmount += $product['solitaire']['Price'];
                }
            }

            $finalAmount += $product['selected_buy_price'];
            $gst = $product['gst_amount'];
        }
        if (isset($coupon)) {
            // $coupon = Coupon::where('coupon', $coupon)->where('expiry_date', '>=', date('Y-m-d'))->first();
            $coupon = Coupon::where('coupon', $coupon)->where('status', 1)->where('expiry_date', '>=', date('Y-m-d'))->first();
        }
        $discountAmount = 0;
        if (isset($coupon)) {
            $coupon = $coupon->toArray();
            if ($coupon['discount_type'] == config('constant.DISCOUNT.PERCENTAGE')) {
                $discountAmount = intval(($finalAmount * $coupon['amount']) / 100);
                $finalAmount = $finalAmount - $discountAmount;
                $gst = intval(($finalAmount * 3) / 100);
            } else {
                $discountAmount = $coupon['amount'];
                $finalAmount = $finalAmount - $discountAmount;
                $gst = intval(($finalAmount * 3) / 100);
            }
        }
        // $checkoutProduct[0]['gst_amount'] = $gst;
        // $checkoutProduct[0]['selected_buy_price'] = $finalAmount;
        // if (Session::has('checkoutProduct')) Session::forget('checkoutProduct');
        // Session::put('checkoutProduct', $checkoutProduct);

        if (\Auth::guard('user')->check()) {
            $user = \Auth::guard('user')->id();
            $user_info = \App\Models\User\User::where('id', $user)->first()->toarray();
        } else {
            $user_info = [];
        }
        $view_data = [
            'header' => [
                "title" => 'Checkout | ' . self::$platform,
                "css" => []
            ],
            'body' => [
                'title' => 'Checkout',
                'states' => $states,
                'checkoutProduct' => $checkoutProduct,
                'productDetail' => $productDetail,
                'login_type' => $login_type,
                'finalAmount' => $finalAmount + $gst,
                'discount' => $discountAmount,
                'user_info' => $user_info
            ],
            'footer' => [
                'js' => ['site/checkout.min.js']
            ]
        ];
        return view('checkout', $view_data);
    }

    // cart checkout
    // public function getCheckoutNew()
    // {
    //     $param = \Input::all();
    //     $login_type = 'user';
    //     if (\Auth::guard('user')->check()) {
    //         $login_type = 'user';
    //     } else {
    //         $login_type = 'guest';
    //     }
    //     // if (isset($param['login_type'])) {
    //     // }
    //     $states = \App\Models\Admin\Pincode::select('state', \DB::raw('MIN(id) as id'))->groupBy('state')->get()->toArray();
    //     $checkoutProduct = Session::get('checkoutProduct');
    //     if (!isset($checkoutProduct)) abort('404');
    //     if (!isset($checkoutProduct[0]['product_sku'])) abort('404');
    //     $coupon = null;
    //     if (isset($checkoutProduct[0]['coupon_code'])) {
    //         $coupon = $checkoutProduct[0]['coupon_code'];
    //     }
    //     $finalAmount = 0;
    //     $gst = 0;
    //     foreach ($checkoutProduct as $product) {
    //         $getProduct = Product::with(['category', 'subcategory'])->where('product_sku', $product['product_sku'])->first();
    //         if (is_null($getProduct)) continue;

    //         $checkChainInPendant = $getProduct['subcategory']->toArray();
    //         $checkChainInPendant = collect($checkChainInPendant);
    //         $found = $checkChainInPendant->contains('subcategory_id', 12);
    //         $getProduct['with_chains'] = 'not pendant';
    //         if ($found) {
    //             $getProduct['with_chains'] = 'no';
    //         } else {
    //             $getProduct['with_chains'] = 'yes';
    //         }

    //         $productDetail[] = $getProduct->toArray();
    //         if (isset($product['solitaire'])) {
    //             if ($product['category_id'] == 3) {
    //                 $finalAmount += $product['solitaire']['total_price'];
    //             } else {
    //                 $finalAmount += $product['solitaire']['Price'];
    //             }
    //         }

    //         $finalAmount += $product['selected_buy_price'];
    //         $gst = $product['gst_amount'];
    //     }
    //     if (isset($coupon)) {
    //         // $coupon = Coupon::where('coupon', $coupon)->where('expiry_date', '>=', date('Y-m-d'))->first();
    //         $coupon = Coupon::where('coupon', $coupon)->where('status', 1)->where('expiry_date', '>=', date('Y-m-d'))->first();
    //     }
    //     $discountAmount = 0;
    //     if (isset($coupon)) {
    //         $coupon = $coupon->toArray();
    //         if ($coupon['discount_type'] == config('constant.DISCOUNT.PERCENTAGE')) {
    //             $discountAmount = intval(($finalAmount * $coupon['amount']) / 100);
    //             $finalAmount = $finalAmount - $discountAmount;
    //             $gst = intval(($finalAmount * 3) / 100);
    //         } else {
    //             $discountAmount = $coupon['amount'];
    //             $finalAmount = $finalAmount - $discountAmount;
    //             $gst = intval(($finalAmount * 3) / 100);
    //         }
    //     }
    //     // $checkoutProduct[0]['gst_amount'] = $gst;
    //     // $checkoutProduct[0]['selected_buy_price'] = $finalAmount;
    //     // if (Session::has('checkoutProduct')) Session::forget('checkoutProduct');
    //     // Session::put('checkoutProduct', $checkoutProduct);

    //     if (\Auth::guard('user')->check()) {
    //         $user = \Auth::guard('user')->id();
    //         $user_info = \App\Models\User\User::where('id', $user)->first()->toarray();
    //     } else {
    //         $user_info = [];
    //     }
    //     $view_data = [
    //         'header' => [
    //             "title" => 'Checkout | ' . self::$platform,
    //             "css" => []
    //         ],
    //         'body' => [
    //             'title' => 'Checkout',
    //             'states' => $states,
    //             'checkoutProduct' => $checkoutProduct,
    //             'productDetail' => $productDetail,
    //             'login_type' => $login_type,
    //             'finalAmount' => $finalAmount + $gst,
    //             'discount' => $discountAmount,
    //             'user_info' => $user_info
    //         ],
    //         'footer' => [
    //             'js' => ['site/checkout.min.js']
    //         ]
    //     ];
    //     return view('checkout', $view_data);
    // }

    public function getCheckoutNew(){
        $states = \App\Models\Admin\Pincode::select('state', \DB::raw('MIN(id) as id'))->groupBy('state')->get()->toArray();
        $login_type = 'user';
        if (\Auth::guard('user')->check()) {
            $login_type = 'user';
            $user = \Auth::guard('user')->id();
            $user_info = \App\Models\User\User::where('id', $user)->first()->toarray();
        } else {
            $login_type = 'guest';
            $user_info = [];
        }

        $checkoutProduct = Session::get('checkoutProduct');
        if (!isset($checkoutProduct)) abort('404');
        if (!isset($checkoutProduct['order_total'])) abort('404');
        
        $view_data = [
            'header' => [
                "title" => 'Checkout | ' . self::$platform,
                "css" => []
            ],
            'body' => [
                'title' => 'Checkout',
                'states' => $states,
                'login_type' => $login_type,
                'user_info' => $user_info,
                'checkoutProduct' => $checkoutProduct
            ],
            'footer' => [
                'js' => ['site/checkout.min.js']
            ]
        ];
        return view('confirm_checkout', $view_data);
    }


    public function postMakeCheckout(Request $request)
    {
        $param = \Input::all();
        $logFile = storage_path('logs/create-order/' . date('Y-m-d') . '.log');
        $monolog = new Logger('log');
        $monolog->pushHandler(new StreamHandler($logFile), Logger::INFO);
        $monolog->info(json_encode(['data' => request()->input()]));

        if (\Auth::guard('user')->check()) {
            $param['login_type'] = 'user';
            $param['user_id'] = \Auth::guard('user')->id();
        } else {
            if (isset($param['login_type'])) $param['login_type'] == 'guest';
        }

        // dd($param);
        $checkoutProduct = Session::get('checkoutProduct');
        if (!isset($checkoutProduct)) abort('404');
        // dd($param);
        $msg = [
            "b_fname.required" => 'Billing first name is required.',
            "b_lname.required" => 'Billing last name is required.',
            "b_phone_number.required" => 'Billing phone number is required.',
            "b_phone_number.digits" => 'Billing phone number must be 10 digits.',
            "b_email.required" => 'Billing email is required.',
            "b_address.required" => 'Billing adress is required.',
            "b_landmark.required" => 'Billing landmark is required.',
            "b_city.required" => 'Billing city is required.',
            "b_state.required" => 'Billing state is required.',
            "b_country.required" => 'Billing country is required.',
            "b_pincode.required" => 'Billing pincode is required.',
            "s_fname.required" => 'Shipping first name is required.',
            "s_lname.required" => 'Shipping last name is required.',
            "s_phone_number.required" => 'Shipping phone number is required.',
            "s_phone_number.digits" => 'Shipping phone number must be 10 digits.',
            "s_email.required" => 'Shipping email is required.',
            "s_address.required" => 'Shipping adress is required.',
            "s_landmark.required" => 'Shipping landmark is required.',
            "s_city.required" => 'Shipping city is required.',
            "s_state.required" => 'Shipping state is required.',
            "s_country.required" => 'Shipping country is required.',
            "s_pincode.required" => 'Shipping pincode is required.',
        ];
        $param['final_amount'] = $checkoutProduct[0]['selected_buy_price'] + $checkoutProduct[0]['gst_amount'];
        if (isset($checkoutProduct[0]['solitaire'])) {
            if ($checkoutProduct[0]['category_id'] == 3) {
                $param['final_amount'] += $checkoutProduct[0]['solitaire']['total_price'];
            } else {
                $param['final_amount'] += $checkoutProduct[0]['solitaire']['Price'];
            }
        }


        $validator = \Validator::make($param, \Validation::get_rules("site", "checkout"), $msg);
        if (!isset($param['same_shipping'])) {
            $validator = \Validator::make($param, \Validation::get_rules("site", "checkout_with_shipping"), $msg);
        }
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }
        if ($param['final_amount'] > 200000) {
            if (!isset($param['pannumber'])) {
                return General::validation_error_res('PAN Number is required for order above 2,00,000.');
            }
        }
        if (isset($param['pannumber'])) {
            if (!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $param['pannumber'])) {
                return General::validation_error_res("Please, enter valid PAN Number.");
            }
        }
        if ($param['login_type'] == 'guest') {
            $guest['name'] = $param['b_fname'] . ' ' . $param['b_lname'];
            $guest['number'] = $param['b_phone_number'];
            $guest['email'] = $param['b_email'];
            $guest['status'] = -1; // for guest users
            $user = User::create_guest_user($guest);
            if ($user['flag'] != 1) return $user;            // return with error if guest user not created
            else $param['user_id'] = $user['data']['id'];
        }
        $param['sessionData'] = $checkoutProduct[0];
        $order = Orders::createOrder($param);

        if ($order['flag'] == 1) {
            //  payment gateway

            // $order_id = Session::get('order_id');
            // $orders = Orders::where('order_id',$order_id)->first();
            // $user_id = Session::get('user_id');
            // $user_data = \App\Models\User::where('id',$user_id)->first();

            // // Email Sending To User
            // $orderDetail = Orders::getOrderDetail($order_id);
            // $user_detail['name'] =  $user_data->name;
            // $user_detail['mail_subject'] = 'Diamondsutra Order Confirm';
            // $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
            // $user_detail['mail_from_name'] = 'Diamondsutra';
            // $user_detail['to_email'] = $user_data->email;
            // $user_detail['mail_blade'] = 'email.order-email';
            // $user_detail['orderDetail'] = $orderDetail['data']['orderDetail'];
            // try {
            //     \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
            //         $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
            //     });
            // } catch (\Exception $e) {

            // }


            // // User SMS Sending Start

            // $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
            // $numbers = array($orders->mobile_no);
            // $sender = 'DMNDST';
            // $message = 'Hi '.$user_data->name.',%nThank you for choosing Diamond Sutra. Your order '.$order_id.' %n https://tx.gl/r/ibwpd/'.$order_id.' is confirmed.%nAny questions? Contact us at +91 9799975281. Thank you!';
            // $SendSMS->sendSms($numbers, $message, $sender);


            // // Admin SMS Sending Start

            // $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
            // $numbers = array(9799975281);
            // $sender = 'DMNDST';
            // $message = 'NEW ORDER ALERT FOR DIAMONDSUTRAorder details: https://tx.gl/r/ilQLT/'.$order_id;
            // $SendSMS->sendSms($numbers, $message, $sender);


            return $order;  //
        }
    }

    public function postCreateOrder(Request $request)
    {
        
        $order_id = Session::get('order_id');
        $user_id = Session::get('user_id');
        $cashfree = new \Cashfree\Cashfree();
        $create_order_request = new \Cashfree\Model\CreateOrderRequest();
        $create_order_request->setOrderAmount($request->amount);
        $create_order_request->setOrderCurrency("INR");
        $create_order_request->setOrderId("order_" . $order_id);

        $customer_details = new \Cashfree\Model\CustomerDetails();
        $customer_details->setCustomerId('diamond_sutra_' . $user_id);
        $customer_details->setCustomerPhone($request->phone_no);
        $customer_details->setCustomerName($request->user_name);
        $customer_details->setCustomerEmail($request->email);
        $create_order_request->setCustomerDetails($customer_details);

        $order_meta = new \Cashfree\Model\OrderMeta();
        $order_meta->setReturnUrl('https://dev.diamondsutra.in/cashfree/payments/success/?order_id={order_id}');
        $create_order_request->setOrderMeta($order_meta);
        $res = General::success_res('success');
        try {
            $result = $cashfree->PGCreateOrder(self::$x_api_version, $create_order_request);
            \Log::info('created Order Response');
            \Log::info(json_encode($result));
            $res['payment_session_id'] = $result[0]['payment_session_id'];
        } catch (Exception $e) {
            \Log::info('Error Message For created Order');
            \Log::info(json_encode($e));
            echo 'Exception when calling PGCreateOrder: ', $e->getMessage(), PHP_EOL;
        }
        // Session::forget('order_id');
        // Session::forget('user_id');
        return $res;
    }
    public function postPaymentSuccess(Request $request)
    {
        $cashfree = new \Cashfree\Cashfree();
        $response = $cashfree->PGOrderFetchPayments(self::$x_api_version, $request['order_id']);
        // dd($response);

        $logFile = storage_path('logs/sms-log/' . date('Y-m-d') . '.log');
        $monolog = new Logger('log');
        $monolog->pushHandler(new StreamHandler($logFile), Logger::INFO);

        $order_id = str_replace("order_", "", $request['order_id']);
        $order = DSOrders::where('order_id', $order_id)->first();

        // Check Payment response 
        if (isset($response[0]) && count($response[0]) > 0) {
            // Check Payment Status Code Success
            if (isset($response[1]) && $response[1] == 200) {
                // Check Payment Status Success
                if ($response[0][0]['payment_status'] == 'SUCCESS') {
                    $order->payment_status = 1;
                    $order->transaction_id = $response[0][0]['cf_payment_id'];
                    $order->payment_completion_time = date('Y-m-d H:i:s', strtotime($response[0][0]['payment_completion_time']));
                    $order->save();

                    // $order_id = Session::get('order_id');
                    $orders = DSOrders::where('order_id', $order_id)->first();
                    $user_id = Session::get('user_id');
                    $user_data = \App\Models\User::where('id', $user_id)->first();

                    // Email Sending To User
                    $orderDetail = DSOrders::getOrderDetail($order_id);
                    $user_detail['name'] =  $user_data->name;
                    $user_detail['mail_subject'] = 'Diamond Sutra Order Confirmed | order_id';
                    $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
                    $user_detail['mail_from_name'] = 'Diamond Sutra';
                    $user_detail['to_email'] = $user_data->email;
                    $user_detail['mail_blade'] = 'email.order-email';
                    $user_detail['orderDetail'] = $orderDetail['data']['orderDetail'];
                    try {
                        \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
                            $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
                        });
                    } catch (\Exception $e) {
                        \Log::info("Failed to send order confirm email..!");
                    }


                    // User SMS Sending Start

                    $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
                    $numbers = array($orders->mobile_no);
                    $sender = 'DMNDST';
                    //$message = 'Hi '.$user_data->name.',%nThank you for choosing Diamond Sutra. Your order '.$order_id.' %n https://tx.gl/r/ibwpd/'.$order_id.' is confirmed.%nAny questions? Contact us at +91 9799975281. Thank you!';
                    $message = 'Hi ' . $user_data->name . ' ,Thank you for choosing Diamond Sutra. Your order ' . $order_id . ' ' . $order_id . ' is confirmed.Any questions? Contact us at +91 9799975281. Thank you!';
                    $res_mob = $SendSMS->sendSms($numbers, $message, $sender);

                    $monolog->info('===================================================================');
                    $monolog->info('Ready To Ship SMS Send to Mobile Number :- ' . $orders->mobile_no);
                    $monolog->info(json_encode(['data' => $res_mob]));
                    $monolog->info('===================================================================');


                    // Admin SMS Sending Start

                    $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
                    $numbers = array(9799975281);
                    $sender = 'DMNDST';
                    $message = 'NEW ORDER ALERT FOR DIAMONDSUTRAorder details: https://tx.gl/r/ilQLT/' . $order_id;
                    $admin_mo = $SendSMS->sendSms($numbers, $message, $sender);

                    $monolog->info('===================================================================');
                    $monolog->info('Ready To Ship SMS Send to Mobile Number :- 9799975281');
                    $monolog->info(json_encode(['data' => $admin_mo]));
                    $monolog->info('===================================================================');

                    Session::forget('order_id');
                    Session::forget('user_id');

                    return redirect()->to('thank-you/' . $order_id);
                } elseif ($response[0][0]['payment_status'] == 'FAILED' || $response[0][0]['payment_status'] == 'CANCELLED' || $response[0][0]['payment_status'] == 'USER_DROPPED') {

                    // dd($response);
                    $delDetails = DSOrderDetails::where('ds_order_id',$order->id)->delete();
                    $user_billDetails = UserAddress::where('id',$order->billing_address_id)->delete();
                    $user_shipDetails = UserAddress::where('id',$order->shipping_address_id)->delete();
                    if($delDetails){
                        $order->delete();
                    }
                    
                    return redirect()->to('/order-faild');
                }
            } else {
                $delDetails = DSOrderDetails::where('ds_order_id',$order->id)->delete();
                $user_billDetails = UserAddress::where('id',$order->billing_address_id)->delete();
                $user_shipDetails = UserAddress::where('id',$order->shipping_address_id)->delete();
                if($delDetails){
                    $order->delete();
                }
                return redirect()->to('/order-faild');
            }
        }
        $delDetails = DSOrderDetails::where('ds_order_id',$order->id)->delete();
        $user_billDetails = UserAddress::where('id',$order->billing_address_id)->delete();
        $user_shipDetails = UserAddress::where('id',$order->shipping_address_id)->delete();
        if($delDetails){
            $order->delete();
        }
        return redirect()->to('/order-faild');
    }

    public function getOrderFaild()
    {
        $view_data = [
            'header' => [
                "title" => 'Payment Failed | ' . self::$platform,
                "css" => []
            ],
            'body' => [
                'title' => 'Payment Failed',
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('order_failed', $view_data);
    }

    public function dumpSolPrice()
    {
        \App\Models\Admin\SolitairePrice::dumpSolitairePrice();
    }
    public function postCheckPincode()
    {
        $param = \Input::all();
        $pincode_data = \App\Models\Admin\Pincode::where('pincodes', $param['pincode'])->first();
        $param['state'] = $pincode_data->state;
        if (!isset($param['state'])) return \General::error_res('Please select state.!');
        $date = General::getEstimatedDeliveryDate($param['pincode'], null, $param['state']);
        if (!$date) return General::error_res('Incorrect pincode.!');
        $res = General::success_res('success');
        $res['data'] = $date;
        $res['state'] = $pincode_data->state;
        $res['city'] = $pincode_data->city;
        return $res;
    }
    public function check_estimated_delivery($pincode)
    {
        $date = General::getEstimatedDeliveryDate($pincode);
        if (!$date) return General::error_res('Incorrect pincode.!');
        $res = \General::success_res();
        $res['data'] = $date;
        return $res;
    }
    public function postApplyCoupon()
    {
        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("site", "check_coupon"));
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = General::validation_error_res($msg);
            return $res;
        }

        if (!Session::has('checkoutProduct')) return General::error_res('No product is selected.');
        $checkoutProduct = Session::get('checkoutProduct');
        $finalAmount = 0;
        $product = $checkoutProduct[0];
        // foreach ($checkoutProduct as $product) {
        $getProduct = Product::with(['category', 'subcategory'])->where('product_sku', $product['product_sku'])->first();
        if (is_null($getProduct)) return \General::error_res('Something went wrong.!');
        $productDetail[] = $getProduct->toArray();
        if (isset($product['solitaire'])) {
            if ($product['category_id'] == 3) {
                $finalAmount += $product['solitaire']['total_price'];
            } else {
                $finalAmount += $product['solitaire']['Price'];
            }
        }
        // $chain = null;
        // if (isset($product['is_chain'])) {
        //     if ($product['is_chain'] == 'yes') {
        //         $chain = json_decode($product['chain'], true);
        //         $finalAmount += $chain['selected_buy_price'];
        //     }
        // }
        $finalAmount += $product['selected_buy_price'];
        // $finalAmount += $product['gst_amount'];
        // }


        // $coupon = Coupon::where('coupon', $param['coupon'])->where('expiry_date', '>=', date('Y-m-d'))->first();
        $coupon = Coupon::where('coupon', $param['coupon'])->where('status', 1)->where('expiry_date', '>=', date('Y-m-d'))->first();
        if (is_null($coupon)) return General::error_res('Invalid coupon code.');
        $coupon = $coupon->toArray();
        // dd($coupon);
        if ($coupon['discount_type'] == config('constant.DISCOUNT.PERCENTAGE')) {
            $discountAmount = intval(($finalAmount * $coupon['amount']) / 100);
            $finalAmount = $finalAmount - $discountAmount;
            $gstAmount = intval(($finalAmount * 3) / 100);
        } else {
            $discountAmount = $coupon['amount'];
            $finalAmount = $finalAmount - $discountAmount;
            $gstAmount = intval(($finalAmount * 3) / 100);
        }
        // dd($discountAmount,$finalAmount,$gstAmount);
        $checkoutProduct[0]['coupon_code'] = $coupon['coupon'];
        $checkoutProduct[0]['coupon_discount_amount'] = $discountAmount;
        $checkoutProduct[0]['gst_amount'] = $gstAmount;
        if (Session::has('checkoutProduct')) Session::forget('checkoutProduct');
        Session::put('checkoutProduct', $checkoutProduct);
        // dd( Session::get('checkoutProduct'));
        $res = General::success_res('Coupon Applied!');
        $res['data']['discount'] = $discountAmount;
        $res['data']['coupon_code'] = $coupon['coupon'];
        $res['data']['final_amount'] = $finalAmount;
        $res['data']['gst_amount'] = $gstAmount;
        return $res;
    }
    
    public function postSelectSolitaire()
    {
        $param = \Input::all();
        if (Session::has('solitaire')) Session::forget('solitaire');
        Session::put('solitaire', $param['diamond']);
        return General::success_res('success');
    }
    public function postSelectProduct()
    {
        $param = \Input::all();
        if (Session::has('solitaire_product')) Session::forget('solitaire_product');
        Session::put('solitaire_product', $param['id']);
        return General::success_res('success');
    }
    public function postSettingReset()
    {
        $param = \Input::all();
        Session::forget('solitaire_product');
        return General::success_res('success');
    }
    public function postDiamondReset()
    {
        $param = \Input::all();
        Session::forget('solitaire');
        return General::success_res('success');
    }
    // diamond pair
    public function postSelectSolitairePair()
    {
        $param = \Input::all();
        if (Session::has('solitaire_pair')) Session::forget('solitaire_pair');
        Session::put('solitaire_pair', $param['diamond']);
        return General::success_res('success');
    }
    public function postSelectProductPair()
    {
        $param = \Input::all();
        if (Session::has('solitaire_pair_product')) Session::forget('solitaire_pair_product');
        Session::put('solitaire_pair_product', $param['id']);
        return General::success_res('success');
    }
    public function postSettingResetPair()
    {
        $param = \Input::all();
        Session::forget('solitaire_pair_product');
        return General::success_res('success');
    }
    public function postDiamondPairReset()
    {
        $param = \Input::all();
        Session::forget('solitaire_pair');
        return General::success_res('success');
    }
    public function postSendEmail()
    {
        $user_detail['name'] =  "Ketan Prajapati";
        $user_detail['mail_subject'] = 'Diamondsutra Testing Email ';
        $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
        $user_detail['mail_from_name'] = 'Diamondsutra';
        $user_detail['to_email'] = 'bbtshivam@gmail.com';
        $user_detail['mail_blade'] = 'email.schedular-failed-email';
        $user_detail['schedular_name'] = 'test schedular';
        $user_detail['error_message'] = 'kjhsdjfhgsjdfh';
        try {
            $res = \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
                $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
            });
            dd($res);
            echo "Success";
        } catch (\Exception $e) {
            echo "<pre>";
            dd($e);
        }
    }
    public function orderemail()
    {
        $order_id = "8599328095";
        $orderDetail = DSOrders::getOrderDetail($order_id);
        // dd($orderDetail);
        return view('email.order-email',$orderDetail['data']);
    }
    public function cencelEmail(){
        // $order_id = "8599328095";
        $order_detail_id = 54;
        // $orderDetail = DSOrders::getOrderDetail($order_id);
        $orderDetail = DSOrderDetails::getOrderItemDetail($order_detail_id);
        // dd($orderDetail);
        // dd($orderDetail);
        return view('email.order-cancel',$orderDetail['data']);
    }
    public function deliveredEmail(){
        // $order_id = "8599328095";
        $order_detail_id = 54;
        // $orderDetail = DSOrders::getOrderDetail($order_id);
        $orderDetail = DSOrderDetails::getOrderItemDetail($order_detail_id);
        // dd($orderDetail);
        return view('email.order-delivered-email',$orderDetail['data']);
    }
    public function gettingReadyMail(){
        $order_detail_id = 54;
        // $orderDetail = DSOrders::getOrderDetail($order_id);
        $orderDetail = DSOrderDetails::getOrderItemDetail($order_detail_id);
        // dd($orderDetail);
        return view('email.order-getting-ready-email',$orderDetail['data']);
    }
    public function returnMail(){
        $order_detail_id = 54;
        // $orderDetail = DSOrders::getOrderDetail($order_id);
        $orderDetail = DSOrderDetails::getOrderItemDetail($order_detail_id);
        // dd($orderDetail);
        return view('email.order-return-email',$orderDetail['data']);
    }
    public function shippedMail(){
        $order_detail_id = 54;
        // $orderDetail = DSOrders::getOrderDetail($order_id);
        $orderDetail = DSOrderDetails::getOrderItemDetail($order_detail_id);
        // dd($orderDetail);
        return view('email.order-shipped-email',$orderDetail['data']);
    }

    public function test()
    {
        $orderSolitaire = \App\Models\User\Orders::where('solitaire_cert_no', '!=', '')->get()->pluck('solitaire_cert_no')->toArray();
        $orderSolitaire2 = \App\Models\User\Orders::where('solitaire_cert_no2', '!=', '')->get()->pluck('solitaire_cert_no2')->toArray();
        dd($orderSolitaire2);
    }

    public function postContactUs()
    {
        $param = \Input::all();
        $msg = [
            "name.required" => 'Name field is required.',
            "email.required" => 'Email field is required.',
            "msg.required" => 'Message field is required.',
        ];
        $validator = \Validator::make($param, \Validation::get_rules("site", "contact-us"), $msg);
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = General::validation_error_res($msg);
            return $res;
        }
        $res = \App\Models\User\ContactUs::StoreData($param);

        $user_detail['name'] =  $param['name'];
        $user_detail['email'] =  $param['email'];
        $user_detail['msg'] =  $param['msg'];
        $user_detail['mail_subject'] = 'Diamond Sutra Contactus Request';
        $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
        $user_detail['mail_from_name'] = 'Diamond Sutra';
        $user_detail['to_email'] = 'info@diamondsutra.in';
        $user_detail['mail_blade'] = 'email.contactus';
        try {
            \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
                $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
            });
        } catch (\Exception $e) {
        }

        return $res;
    }
    public function postSubscribeUs()
    {
        $param = \Input::all();
        $msg = [
            "email.required" => 'Email field is required.',
            "email.unique" => 'Email is already subscribed.',
        ];
        $validator = \Validator::make($param, \Validation::get_rules("site", "subscribe-us"), $msg);
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = General::validation_error_res($msg);
            return $res;
        }
        $res = \App\Models\User\Subscribe::StoreData($param);
        return $res;
    }
    public function getThankyou($order_id)
    {
        $orderDetail = Orders::getOrderDetail($order_id);
        if ($orderDetail['flag'] != 1) abort('404');

        $view_data = [
            'header' => [
                "title" => 'Order Recevied ' . self::$platform,
            ],
            'body' => [
                'id'    => 'Order Details',
                'label' => 'Confirm Order',
                'header_title' => 'Confirm Order',
                'orderDetail' => $orderDetail['data']['orderDetail']
            ],
            "footer" => [
                'js' => ['']
            ]
        ];
        return view('order_success', $view_data);
    }
    public function getThankyouNew($order_id)
    {
        $orderDetail = DSOrders::getOrderDetail($order_id);
        if ($orderDetail['flag'] != 1) abort('404');

        $view_data = [
            'header' => [
                "title" => 'Order Recevied ' . self::$platform,
            ],
            'body' => [
                'id'    => 'Order Details',
                'label' => 'Confirm Order',
                'header_title' => 'Confirm Order',
                'orderDetail' => $orderDetail['data']['orderDetail']
            ],
            "footer" => [
                'js' => ['']
            ]
        ];
        return view('order_success_new', $view_data);
    }
    // public function postCancelOrder()
    // {
    //     $param = \Input::all();
    //     $orderDetail = Orders::where('order_id', $param['order_id'])->first();
    //     $orderDetail->order_status = 4;
    //     $orderDetail->cancel_reason = $param['cancel-reason'] ?? null;
    //     $orderDetail->save();

    //     $order_id = $param['order_id'];

    //     $user_data = \App\Models\User::where('id', \Auth::guard('user')->id())->first();

    //     // User Send SMS For Cancel
    //     $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
    //     $numbers = array($orderDetail->mobile_no);
    //     $sender = 'DMNDST';
    //     $message = 'Hello ' . $user_data->name . ',You have canceled your order https://tx.gl/r/ibwpd/' . $order_id . ' on diamond Sutra. Our team will be in touch shortly with further instructions for refund.Thank you!';
    //     $SendSMS->sendSms($numbers, $message, $sender);


    //     // Email Sending To User Cancel
    //     $order = \App\Models\User\Orders::getOrderDetail($order_id);
    //     $user_detail['name'] =  $user_data->name;
    //     $user_detail['mail_subject'] = 'Your order is canceled ' . $order_id;
    //     $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
    //     $user_detail['mail_from_name'] = 'Diamond Sutra';
    //     $user_detail['to_email'] = $user_data->email;
    //     $user_detail['mail_blade'] = 'email.order-cancel';
    //     $user_detail['orderDetail'] = $order['data']['orderDetail'];
    //     try {
    //         \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
    //             $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
    //         });
    //     } catch (\Exception $e) {
    //         \Log::info($e);
    //     }

    //     // Admin Send SMS For Cancel
    //     $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
    //     $numbers = array(9799975281);
    //     $sender = 'DMNDST';
    //     $message = 'DIAMOND SUTRA ORDER CANCELLATION ALERTThe following order https://tx.gl/r/ibwpd/' . $order_id . ' has been cancelled by the user. Please get in touch with user ' . $user_data->name;
    //     $SendSMS->sendSms($numbers, $message, $sender);


    //     return General::success_res('Order Cancel');
    // }

    // public function postReturnOrder()
    // {

    //     $param = \Input::all();
    //     $orderDetail = Orders::where('order_id', $param['order_id'])->first();
    //     $orderDetail->order_status = 5;
    //     $orderDetail->return_reason = $param['return-reason'] ?? null;
    //     $orderDetail->save();

    //     $order_id = $param['order_id'];

    //     $user_data = \App\Models\User::where('id', \Auth::guard('user')->id())->first();

    //     // User Send SMS For Return Initiated
    //     $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
    //     $numbers = array($orderDetail->mobile_no);
    //     $sender = 'DMNDST';
    //     $message = 'Hello ' . $user_data->name . ', Return initiated for order ' . $order_id . ' on Diamond Sutra. Our team will be in touch shortly with instructions to schedule pickup. Thank you!';
    //     $SendSMS->sendSms($numbers, $message, $sender);


    //     // Email Sending To User Return Initiated
    //     $order = \App\Models\User\Orders::getOrderDetail($order_id);
    //     $user_detail['name'] =  $user_data->name;
    //     $user_detail['mail_subject'] = 'Return Initiated for your order ' . $order_id;
    //     $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
    //     $user_detail['mail_from_name'] = 'Diamond Sutra';
    //     $user_detail['to_email'] = $user_data->email;
    //     $user_detail['mail_blade'] = 'email.order-return-email';
    //     $user_detail['orderDetail'] = $order['data']['orderDetail'];
    //     try {
    //         \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
    //             $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
    //         });
    //     } catch (\Exception $e) {
    //         \Log::info($e);
    //     }

    //     // Admin Send SMS For Return Initiated
    //     $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
    //     $numbers = array(9799975281);
    //     $sender = 'DMNDST';
    //     $message = 'RETRUN REQUEST ALERT FOR DIAMOND SUTRA Return initiated for order https://tx.gl/r/ilQLT/' . $order_id . '. Please get in touch with the customer ' . $user_data->name . ' ' . $order_id;
    //     $SendSMS->sendSms($numbers, $message, $sender);

    //     return General::success_res('Order Return Initiated');
    // }

    public function postForgetPassword()
    {
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("site", "forgot-password"));
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }
        return \App\Models\User\User::forgotPassword($param);
    }
    public function postResetPassword($token)
    {
        $user = \App\Models\User\User::get_by_pass_token($token);
        if (empty($user)) {
            abort('404');
        }
        $view_data_back = [
            'header' => [
                "title" => "Reset  Password ",
                "desc" => "",
            ],
            'body' => [
                'token' => $token,
            ],
            'footer' => [
                "js"    => ['forgot-password.min.js'],
                "css"   => [],
            ],
        ];
        return view('reset_password', $view_data_back);
    }

    public function postChangePassword()
    {
        $param = \Input::all();
        $pass_token = isset($param['pass_token']) ? $param['pass_token'] : "";
        $json = \General::error_res('Somthing Wrong!');
        $json['data'] = [];
        $custome_msg = [
            'new_pass.regex' => ' Password accepts only letters, Numbers, Special characters(@, _, -).',
        ];
        $niceNames = [
            'password' => 'New Password',
            'confirm_password' => 'Confirm Password',
        ];
        $validator = \Validator::make($param, \Validation::get_rules("site", "change_password"), $custome_msg);
        $validator->setAttributeNames($niceNames);

        $user = \App\Models\User\User::get_by_pass_token($pass_token);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $error = $messages->all();
            return  \General::validation_error_res($messages->first());
        }
        if (empty($user)) {
            return \General::error_res("Oops something went wrong !!!");
        }
        $hashPass = \Hash::make($param['confirm_password']);
        $user = \App\Models\User\User::where("password_token", $pass_token)->first();
        $user->password = $hashPass;
        $user->password_token = "";
        if ($user->save()) {
            return \General::success_res('Your password change successfully.');
        } else {
            return \General::error_res("Oops something went wrong !!!");
        }
    }

    public function postDownloadInvoice($order_id)
    {
        $order = \App\Models\User\Orders::getOrderDetail($order_id);
        dd($order);
        $user_detail['orderDetail'] = $order['data']['orderDetail'];
        $pdf = Pdf::loadView('user.invoice', $user_detail);

        return $pdf->download('invoice.pdf');
        //return $pdf->stream();

        //return view('user.invoice_copy',$user_detail);
    }

    public function postDownloadInvoiceNew($order_id)
    {
        $order = \App\Models\User\DSOrders::getOrderDetail($order_id);
        // dd($order);
        $user_detail['orderDetail'] = $order['data']['orderDetail'];
        $pdf = Pdf::loadView('user.invoice_new', $user_detail);

        $filename = $user_detail['orderDetail']['order_id'].'.pdf';

        return $pdf->download($filename);
        // return $pdf->stream();

        // return view('user.invoice_new',$user_detail);
    }

    public function postCashfreeWebhook()
    {

        \Cashfree\Cashfree::$XClientId = config('Cashfree')['cashfree_ClientId'];
        \Cashfree\Cashfree::$XClientSecret = config('Cashfree')['cashfree_Secret'];

        $param = \Input::all();

        $inputJSON = file_get_contents('php://input');

        $expectedSig = getallheaders()['x-webhook-signature'];
        $ts = getallheaders()['x-webhook-timestamp'];

        if (!isset($expectedSig) || !isset($ts)) {
            echo "Bad Request";
            die();
        }

        $cashfree = new \Cashfree\Cashfree();


        // Verify the signature
        $isVerified = $cashfree->PGVerifyWebhookSignature($expectedSig, $inputJSON, $ts);

        if (!$isVerified) {
            Log::error('Webhook signature verification failed');
            return response()->json(['message' => 'Invalid signature'], 400);
        }


        $status = false;


        if (isset($param['data'])) {
            if (isset($param['data']['payment'])) {
                if (isset($param['data']['payment']['payment_status'])) {
                    $status = $param['data']['payment']['payment_status'];
                }
            }
        }
        if (isset($param['data']['order']['order_id'])) {
            $order_id = $param['data']['order']['order_id'];
            // Only replace the prefix if it exists
            if (strpos($order_id, "order_") === 0) {
                $order_id = str_replace("order_", "", $order_id);
            }
        } else {
            // Handle the case where 'order_id' is not set
            $order_id = null; // or handle the error as appropriate
        }


        if ($status) {
            $order = Orders::where('order_id', $order_id)->first();
            if ($status == 'SUCCESS') {
                $order->payment_status = 1;
                $order->transaction_id = $param['data']['payment']['cf_payment_id'];
                $order->payment_completion_time = date('Y-m-d H:i:s', strtotime($param['data']['payment']['payment_completion_time']));
                $order->save();
            } elseif ($status == 'FAILED' || $status == 'CANCELLED' || $status == 'USER_DROPPED') {
                $order->delete();
            }
        }
        return response()->json(['message' => 'Webhook received'], 200);
    }

    public function getCart()
    {
        $view_data = [
            'header' => [
                "title" => 'Cart | ' . self::$platform,
            ],
            'body' => [
                'title' => 'Login'
            ],
            'footer' => [
                'js' => []
            ]
        ];
        return view('cart', $view_data);
    }

    public function getProductCustomPrice()
    {
        $param = \Input::all();
        $res = General::getCartProductPrice($param);
        return $res;
    }

    public function getPairCustomPrice(){
        $param = \Input::all();
        $res1 = General::getCartProductPrice($param['cartData'][0]);
        $res2 = General::getCartProductPrice($param['cartData'][1]);
        $data = array();
        if($res1['flag'] == 1 && $res2['flag'] == 1){
            $data[] = $res1['data'];
            $data[] = $res2['data'];
            $bindNo = time();
            $data[0]['binded'] = $data[1]['binded'] = $bindNo;

            $paired = General::success_res('Success');
            $paired['data'] = $data;
            return $paired;
        }

        return General::error_res('Something went wrong');
    }

    public function postApplyCouponNew(){
        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("site", "apply_coupon"));
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = General::validation_error_res($msg);
            return $res;
        }
        $couponData = Coupon::checkApplicable($param);
        if($couponData['flag'] == 0){
            return \General::error_res($couponData['msg']);
        }
        $res = General::updateCartProductPrices($param['cartData'],$couponData['data']);
        if($res['flag'] == 1){
            $res['data']['couponData'] = $couponData['data'];
        }

        return $res;
    }

    public function postRemoveCouponNew(){
        $param = \Input::all();

        if(isset($param['cartData'])){
            $res = General::updateCartProductPrices($param['cartData'],null);
        } else {
            return General::info_res('No items in cart');
        }
        
        return $res;
    }

    public function postCheckCouponNew(){
        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("site", "apply_coupon"));
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = General::validation_error_res($msg);
            return $res;
        }
        $couponData = Coupon::checkApplicable($param);
        if($couponData['flag'] == 0){
            return \General::error_res($couponData['msg']);
        }

        return $couponData;
    }

    public function getRefreshCart(){
        $param = \Input::all();
        $res = null;
        if(!isset($param['cartData']))
            return \General::info_res('Cart is empty');

        if($param['coupon_code'] != 'NA'){
            $couponData = Coupon::checkApplicable($param);
            if($couponData['flag'] != 1) $couponData['data'] = null;
            $res = General::updateCartProductPrices($param['cartData'],$couponData['data']);
            if($res['flag'] == 1){
                $res['data']['couponData'] = $couponData['data'];
            }
        } elseif($param['coupon_code'] == 'NA') {
            $res = General::updateCartProductPrices($param['cartData'],null);
        
            return $res;
        }

        return $res;
    }

    public function postConfirmAndPay()
    {
        $param = \Input::all();
        $logFile = storage_path('logs/create-order/' . date('Y-m-d') . '.log');
        $monolog = new Logger('log');
        $monolog->pushHandler(new StreamHandler($logFile), Logger::INFO);
        $monolog->info(json_encode(['data' => request()->input()]));

        if (\Auth::guard('user')->check()) {
            $param['login_type'] = 'user';
            $param['user_id'] = \Auth::guard('user')->id();
        } else {
            // if (isset($param['login_type'])) $param['login_type'] == 'guest';
            $param['login_type'] = 'guest';
        }

        // dd($param);
        $checkoutProduct = Session::get('checkoutProduct');
        if (!isset($checkoutProduct)) abort('404');
        // dd($param);
        $msg = [
            "b_fname.required" => 'Billing first name is required.',
            "b_lname.required" => 'Billing last name is required.',
            "b_phone_number.required" => 'Billing phone number is required.',
            "b_phone_number.digits" => 'Billing phone number must be 10 digits.',
            "b_email.required" => 'Billing email is required.',
            "b_address.required" => 'Billing adress is required.',
            "b_landmark.required" => 'Billing landmark is required.',
            "b_city.required" => 'Billing city is required.',
            "b_state.required" => 'Billing state is required.',
            "b_country.required" => 'Billing country is required.',
            "b_pincode.required" => 'Billing pincode is required.',
            "s_fname.required" => 'Shipping first name is required.',
            "s_lname.required" => 'Shipping last name is required.',
            "s_phone_number.required" => 'Shipping phone number is required.',
            "s_phone_number.digits" => 'Shipping phone number must be 10 digits.',
            "s_email.required" => 'Shipping email is required.',
            "s_address.required" => 'Shipping adress is required.',
            "s_landmark.required" => 'Shipping landmark is required.',
            "s_city.required" => 'Shipping city is required.',
            "s_state.required" => 'Shipping state is required.',
            "s_country.required" => 'Shipping country is required.',
            "s_pincode.required" => 'Shipping pincode is required.',
        ];
        $param['final_amount'] = $checkoutProduct['order_total'];


        $validator = \Validator::make($param, \Validation::get_rules("site", "checkout_new"), $msg);
        if (!isset($param['same_shipping'])) {
            $validator = \Validator::make($param, \Validation::get_rules("site", "checkout_with_shipping_new"), $msg);
        }
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }
        if ($checkoutProduct['order_total'] > 200000) {
            if (!isset($param['pannumber'])) {
                return General::validation_error_res('PAN Number is required for order above 2,00,000.');
            }
        }
        if (isset($param['pannumber'])) {
            if (!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $param['pannumber'])) {
                return General::validation_error_res("Please, enter valid PAN Number.");
            }
        }
        
        if(!isset($param['expected_delivery_date'])){
            $param['expected_delivery_date'] = General::getEstimatedDeliveryDate($param['b_pincode'], null, $param['b_state']);
        }
        if($param['expected_delivery_date'] == ''){
            $param['expected_delivery_date'] = General::getEstimatedDeliveryDate($param['b_pincode'], null, $param['b_state']);
        }

        if ($param['login_type'] == 'guest') {
            $guest['name'] = $param['b_fname'] . ' ' . $param['b_lname'];
            $guest['number'] = $param['b_phone_number'];
            $guest['email'] = $param['b_email'];
            $guest['status'] = -1; // for guest users
            $user = User::create_guest_user($guest);
            if ($user['flag'] != 1) return $user;            // return with error if guest user not created
            else $param['user_id'] = $user['data']['id'];
        }
        $param['sessionData'] = $checkoutProduct;
        $order = DSOrders::createOrder($param);

        if ($order['flag'] == 1) {
            //  payment gateway

            // $order_id = Session::get('order_id');
            // $orders = Orders::where('order_id',$order_id)->first();
            // $user_id = Session::get('user_id');
            // $user_data = \App\Models\User::where('id',$user_id)->first();

            // // Email Sending To User
            // $orderDetail = Orders::getOrderDetail($order_id);
            // $user_detail['name'] =  $user_data->name;
            // $user_detail['mail_subject'] = 'Diamondsutra Order Confirm';
            // $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
            // $user_detail['mail_from_name'] = 'Diamondsutra';
            // $user_detail['to_email'] = $user_data->email;
            // $user_detail['mail_blade'] = 'email.order-email';
            // $user_detail['orderDetail'] = $orderDetail['data']['orderDetail'];
            // try {
            //     \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
            //         $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
            //     });
            // } catch (\Exception $e) {

            // }


            // // User SMS Sending Start

            // $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
            // $numbers = array($orders->mobile_no);
            // $sender = 'DMNDST';
            // $message = 'Hi '.$user_data->name.',%nThank you for choosing Diamond Sutra. Your order '.$order_id.' %n https://tx.gl/r/ibwpd/'.$order_id.' is confirmed.%nAny questions? Contact us at +91 9799975281. Thank you!';
            // $SendSMS->sendSms($numbers, $message, $sender);


            // // Admin SMS Sending Start

            // $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
            // $numbers = array(9799975281);
            // $sender = 'DMNDST';
            // $message = 'NEW ORDER ALERT FOR DIAMONDSUTRAorder details: https://tx.gl/r/ilQLT/'.$order_id;
            // $SendSMS->sendSms($numbers, $message, $sender);


            return $order;  //
        }
    }

    public function postStartCheckoutNew()
    {

        $param = \Input::all();
        $res = null;
        if(!isset($param['cartData']))
            return \General::info_res('Cart is empty');

        if($param['coupon_code'] != 'NA'){
            $couponData = Coupon::checkApplicable($param);
            $res = General::updateCartProductPrices($param['cartData'],$couponData['data']);
            if($res['flag'] == 1){
                $res['data']['couponData'] = $couponData['data'];
            } else {
                return $res;
            }
        } elseif($param['coupon_code'] == 'NA') {
            $res = General::updateCartProductPrices($param['cartData'],null);
        }

        if(!isset($res['data']['cartSummery']))
        return General::error_res("Sorry we can't place this order right now!");

        $order = [
            'item_total' => $res['data']['cartSummery']['itemTotal'],
            'order_total' => $res['data']['cartSummery']['orderTotal'],
            'gst_total' => 0,
            'discount_total' => $res['data']['cartSummery']['discountAmount'],
            'coupon_code' => '',
            'total_items' => $res['data']['cartSummery']['itemCount'],
            'order_items' => []
        ];


        $order['order_items'] = $res['data']['cartData'];
        foreach($res['data']['cartData'] as $cartItem){
            if(isset($cartItem['quantity'])){
                // $order['total_items'] += $cartItem['quantity'];
                // $order['item_total'] += $cartItem['product_buy_price_with_gst'];
                // $order['order_total'] += $cartItem['product_buy_price_with_gst'] - $cartItem['coupon_discount'];
            } else {
                // $order['item_total'] += $cartItem['product_buy_price_with_gst'];
                // $order['order_total'] += $cartItem['product_buy_price_with_gst'] - $cartItem['coupon_discount'];
                // $order['total_items'] += 1;
            }
            // $order['discount_total'] += $cartItem['coupon_discount'];
            $order['gst_total'] += $cartItem['product_gst'];
            if($cartItem['coupon_code'] != '')
                $order['coupon_code'] = $cartItem['coupon_code'];

        }
        $checkoutProducts = array();
        if (Session::has('checkoutProduct')) Session::forget('checkoutProduct');
        Session::put('checkoutProduct', $order);
        return General::success_res();
    }


    public function getDbSol(){
        $res = SolitaireData::get_solitaire();
    }

    public function getSampleBlog(){
        return view('sample_blog');
    }
    
}
