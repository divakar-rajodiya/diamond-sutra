<?php

namespace App\Http\Controllers;

use App\Lib\General;
use App\Models\User\DSOrderDetails;
use App\Models\User\DSOrders;
use App\Models\User\Orders;
use PhpParser\Node\Expr\FuncCall;
use Psy\TabCompletion\Matcher\FunctionDefaultParametersMatcher;

class UserController extends Controller
{

    private static $bypass_url;
    static $platform =  "";
    static $user =  "";

    public function __construct()
    {
        $this->middleware('UserAuth', ['except' => self::$bypass_url]);
        self::$platform = config('constant.PLATFORM_NAME');
        self::$user = app('login_user');
    }

    public function getLogout()
    {
        \App\Models\User\Token::delete_token(\Auth::guard('user')->user()->id);
        \Auth::guard('user')->logout();
        return redirect("/");
    }
 
    public function getProfile()
    {
        $userData = \App\Models\User\User::where('id',\Auth::guard('user')->id())->first();
        $view_data = [
            'header' => [
                "title" => 'Profile ' . self::$platform,
            ],
            'body' => [
                'id'    => 'profile',
                'label' => 'Profile',
                'header_title' => 'Profile',
                'user' => $userData
            ],
            "footer" => [
                'js' => ['admin/profile.min.js']
            ]
        ];
        return view('user.profile', $view_data);
    }
    public function getOrders(){
        
        $fields = 'id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username';
        $token ='IGQWRPeFZAzWnp4T251d0UyZA3J5RFRpd2JBV1NxdEJMU2ZAZASWRKSlNaTFZAIWFJPNzZAzbkczMEJBci10NE1GeDRoQk5oVGlCWmpCaDA1RndWaFU3NFQtUnFISEtNbEFmY1RJd1dMRnhZASHUzeWFUd1doekxWWHlvUlUZD';
        $limit = 12;
        $json_feed_url = "https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
        $json_feed = @file_get_contents($json_feed_url);
        $contents = json_decode($json_feed, true, 512, JSON_BIGINT_AS_STRING);
        $view_data = [
            'header' => [
                "title" => 'My orders ' . self::$platform,
            ],
            'body' => [
                'id'    => 'My orders',
                'label' => 'My orders',
                'header_title' => 'My orders',
                'contents'=>$contents
            ],
            "footer" => [
                'js' => []
            ]
        ];
        return view('user.my_orders', $view_data);
    }

    public function postOrderList()
    {

        $param = \Input::all();
        $param['user_id'] = \Auth::guard('user')->id();
        // $data = \App\Models\User\Orders::getOrdersByUSer($param);
        $data = \App\Models\User\DSOrders::getOrdersByUSer($param);
        $res = \General::success_res();
        $res['blade'] = view("user.order_list_filter", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function getOrderDetail($order_id){
        $orderDetail = Orders::getOrderDetail($order_id); 
        // $orderDetail = DSOrders::getOrderDetail($order_id);
        if($orderDetail['flag'] != 1) abort('404');

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
    }

    public function getOrderDetailNew($order_id){
        $orderDetail = DSOrders::getOrderDetail($order_id); 
        if($orderDetail['flag'] != 1) abort('404');

        $view_data = [
            'header' => [
                "title" => 'Order Details ' . self::$platform,
            ],
            'body' => [
                'id'    => 'Order Details',
                'label' => 'Order Details',
                'header_title' => 'Order Details',
                'orderData' => $orderDetail['data']['orderDetail']
            ],
            "footer" => [
                'js' => ['']
            ]
        ];
        return view('user.order_detail_new', $view_data);   
    }

   
    public function postChangePassword()
    {
        $param = \Input::all();
        // dd($param);
        $validator = \Validator::make(\Input::all(), \Validation::get_rules("admin", "change_admin_password"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }

        $res = \App\Models\Admin\Admin::change_admin_password($param);

        return $res;
    }

    public function postUpdateProfile()
    {
        $param = \Input::all();
        $rules = \Validation::get_rules("user", "update_profile");
        $validate = \Validation::custom_validate($param, $rules);
        if ($validate['flag'] != 1) {
            return $validate;
        }
        if (isset($param['image'])) {
            $imageRules =  \Validation::get_rules("user", "profile_image");
            $imageValidationMsg = [
                'image.required' => 'Profile image is required.',
                'image.image' => 'Profile image must be an image type.',
            ];
            $validate = \Validation::custom_validate($param, $imageRules, $imageValidationMsg);
            if ($validate['flag'] != 1) {
                return $validate;
            }
        }

        $res = \App\Models\User\User::update_profile($param);
        return $res;
    }

    public function postAddWishlist(){
        $param = \Input::all();
        dd($param);
    }

    public function postAddReview(){
        $param = \Input::all();
        $rules = \Validation::get_rules("user", "add_review");  
        $validate = \Validation::custom_validate($param, $rules);
        if ($validate['flag'] != 1) {
            return $validate;
        }
        if (isset($param['image1'])) {
            $imageRules =  \Validation::get_rules("user", "image1");
            $imageValidationMsg = [
                'image1.required' => 'Review image 1 is required.',
                'image1.image' => 'Review image 1 must be an image type.',
            ];
            $validate = \Validation::custom_validate($param, $imageRules, $imageValidationMsg);
            if ($validate['flag'] != 1) {
                return $validate;
            }
        }
        if (isset($param['image2'])) {
            $imageRules =  \Validation::get_rules("user", "image2");
            $imageValidationMsg = [
                'image2.required' => 'Review image 2 is required.',
                'image2.image' => 'Review image 2 must be an image type.',
            ];
            $validate = \Validation::custom_validate($param, $imageRules, $imageValidationMsg);
            if ($validate['flag'] != 1) {
                return $validate;
            }
        }

        $res = \App\Models\User\Review::add_user_review($param);
        return $res;
    }

    public function getThankyou($order_id){
        $orderDetail = Orders::getOrderDetail($order_id);
        if($orderDetail['flag'] != 1) abort('404');

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

    public function postCancelOrder()
    {
        $param = \Input::all();
        $orderDetail = DSOrderDetails::with('order')->where('id', $param['cancel_id'])->first();

        $mailItemType = 0;
        $mount_id = 0;
        
        if($orderDetail){
            if($orderDetail['order']['order_id'] == $param['order_id']){
                // product type
                // 0 = product, 1 = solitaire_setting, 2 = solitaire, 3 = solitaire_pair, 4 = loose_solitaire, 5 = loose_solitaire_pair
                
                // item status
                // -1 = cancelled, 0 = placed, 1 = getting ready, 2 = shipped, 3 = delivered, 4 = initiate return 5 = Returned

                // order status
                // -1 = cancelled, 0 = placed, 1 = getting ready, 2 = shipped, 3 = delivered, 4 = initiate return 5 = Returned

                if ($orderDetail->mount_id != '' && ($orderDetail->product_type == 1 || $orderDetail->product_type == 2 || $orderDetail->product_type == 3)) {
                    $mount_id = $orderDetail->mount_id;
                    $mailItemType = 1;
                    $updateArr = array(
                        'dispatch_status' => -1
                    );
                    \App\Models\User\DSOrderDetails::where('mount_id', $mount_id)->update($updateArr);

                }
                
                if($orderDetail->product_type == 0 || $orderDetail->product_type == 1){
                    if($orderDetail->dispatch_status <= 1){
                        $orderDetail->dispatch_status = -1;
                        $orderDetail->cancel_reason = $param['cancel-reason'] ?? null;
                        $orderDetail->save();
                    } else {
                        return General::error_res('Soory! we are not able to cancel this item. Please contact on support.');
                    }
                } else {
                    
                    if($orderDetail->dispatch_status <= 1 && $orderDetail->product_buy_price < 200000){
                        $orderDetail->dispatch_status = -1;
                        $orderDetail->cancel_reason = $param['cancel-reason'] ?? null;
                        $orderDetail->save();
                    } else {
                        return General::error_res('Soory! we are not able to cancel this item. Please contact on support.');
                    }
                }
            }
        } else {
            return General::error_res('Something went wrong.');
        }
        
        $order_id = $param['order_id'];
        
        $user_data = \App\Models\User::where('id', \Auth::guard('user')->id())->first();

        // User Send SMS For Cancel
        $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
        $numbers = array($orderDetail['order']['mobile_no']);
        $sender = 'DMNDST';
        $message = 'Hello ' . $user_data->name . ',You have canceled your order https://tx.gl/r/ibwpd/' . $order_id . ' on diamond Sutra. Our team will be in touch shortly with further instructions for refund.Thank you!';
        $SendSMS->sendSms($numbers, $message, $sender);


        // Email Sending To User Cancel
        $order = \App\Models\User\DSOrderDetails::getOrderItemDetail($param['cancel_id']);

        if($mailItemType == 1){
            $order = DSOrders::getOrderDetail($order['data']['orderDetail']['order_with_detail']['order_id']);
            $moutItems = DSOrderDetails::getItemsByMountId($mount_id);
            $order['data']['orderDetail']['order_detail'] = $moutItems['data']['order_items'];
        }
        $user_detail['mail_blade'] = 'email.order-cancel';
        if($mailItemType == 1){
            $user_detail['mail_blade'] = 'email.order-cancel-multi';
        }

        $user_detail['name'] =  $user_data->name;
        $user_detail['mail_subject'] = 'Your order is cancelled ' . $order_id;
        $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
        $user_detail['mail_from_name'] = 'Diamond Sutra';
        $user_detail['to_email'] = $user_data->email;
        $user_detail['orderDetail'] = $order['data']['orderDetail'];
        try {
            \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
                $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
            });
        } catch (\Exception $e) {
            \Log::info($e);
        }

        // Admin Send SMS For Cancel
        $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
        $numbers = array(9799975281);
        $sender = 'DMNDST';
        $message = 'DIAMOND SUTRA ORDER CANCELLATION ALERTThe following order https://tx.gl/r/ibwpd/' . $order_id . ' has been cancelled by the user. Please get in touch with user ' . $user_data->name;
        $SendSMS->sendSms($numbers, $message, $sender);


        return General::success_res('Order Cancel');
    }

    public function postReturnOrder()
    {

        $param = \Input::all();
        $orderDetail = DSOrderDetails::with('order')->where('id', $param['return_id'])->first();
        
        if($orderDetail){
            if($orderDetail['order']['order_id'] == $param['order_id']){
               
                if($orderDetail->product_type == 0 || $orderDetail->product_type == 1){
                    if($orderDetail->dispatch_status == 3){
                        $orderDetail->dispatch_status = 5;
                        $orderDetail->return_reason = $param['return-reason'] ?? null;
                        $orderDetail->save();
                    } else {
                        return General::error_res('Soory! we are not able to return this item. Please contact on support.');
                    }
                } else {
                    
                    if($orderDetail->dispatch_status <= 1 && $orderDetail->product_buy_price < 200000){
                        $orderDetail->dispatch_status = -1;
                        $orderDetail->cancel_reason = $param['return-reason'] ?? null;
                        $orderDetail->save();
                    } else {
                        return General::error_res('Soory! we are not able to return this item. Please contact on support.');
                    }
                }
            }
        } else {
            return General::error_res('Something went wrong.');
        }

        $order_id = $param['order_id'];

        $user_data = \App\Models\User::where('id', \Auth::guard('user')->id())->first();

        // User Send SMS For Return Initiated
        $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
        $numbers = array($orderDetail->mobile_no);
        $sender = 'DMNDST';
        $message = 'Hello ' . $user_data->name . ', Return initiated for order ' . $order_id . ' on Diamond Sutra. Our team will be in touch shortly with instructions to schedule pickup. Thank you!';
        $SendSMS->sendSms($numbers, $message, $sender);

        // Email Sending To User Return Initiated
        $order = \App\Models\User\DSOrderDetails::getOrderItemDetail($param['return_id']);
        $user_detail['name'] =  $user_data->name;
        $user_detail['mail_subject'] = 'Return Initiated for your order ' . $order_id;
        $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
        $user_detail['mail_from_name'] = 'Diamond Sutra';
        $user_detail['to_email'] = $user_data->email;
        $user_detail['mail_blade'] = 'email.order-return-email';
        $user_detail['orderDetail'] = $order['data']['orderDetail'];
        try {
            \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
                $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
            });
        } catch (\Exception $e) {
            \Log::info($e);
        }

        // Admin Send SMS For Return Initiated
        $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
        $numbers = array(9799975281);
        $sender = 'DMNDST';
        $message = 'RETRUN REQUEST ALERT FOR DIAMOND SUTRA Return initiated for order https://tx.gl/r/ilQLT/' . $order_id . '. Please get in touch with the customer ' . $user_data->name . ' ' . $order_id;
        $SendSMS->sendSms($numbers, $message, $sender);

        return General::success_res('Order Return Initiated');
    }


}
