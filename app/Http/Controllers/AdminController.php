<?php

namespace App\Http\Controllers;

use App\Imports\ExcelImport;
use App\Lib\General;
use App\Models\Admin\Category;
use App\Models\Admin\Pincode;
use App\Models\Admin\Product;
use App\Models\User\Orders;
use App\Models\User\ContactUs;
use App\Models\Admin\SubCategory;
use App\Http\Controllers\SMSController;
use App\Models\User\DSOrders;
use App\Models\User\DSOrderDetails;
use App\Models\User\Review;
use Dotenv\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class AdminController extends Controller
{

    private static $bypass_url = ['getLogin', 'postLogin', 'getForgotPassword', 'postForgotPassword', 'getResetPassword', 'postResetPassword', 'getLogout', 'getMaintenance'];
    static $x_api_version = '';
    public function __construct()
    {
        self::$x_api_version = "2023-08-01";
        $this->middleware('AdminAuth', ['except' => self::$bypass_url]);
    }
    public function getMaintenance()
    {
        $settings = app('settings');
        ini_set('memory_limit', '512M'); // Set the memory limit to 512 megabytes
        if ($settings['maintenance_mode'] != 1) {
            return redirect('/');
            // return view('undermaintenance');
        } else {
            return view('site.undermaintenance');
        }
    }
    public function getLogin($sec_token = "")
    {
        $s = app('settings');

        if ($sec_token != $s['admin_login_url_token']) {
            return \Redirect::to("/");
        }
        // dd(\Auth::guard("admin")->check());
        if (\Auth::guard("admin")->check()) {
            return \Redirect::to("admin/dashboard");
        }
        $view_data = [
            'header' => [
                "title" => 'Login | Admin Panel ',
            ],
            'body' => [
                'title' => 'login',
            ],
            'js' => []
        ];
        return view('admin.login', $view_data);
    }
    public function postLogin()
    {
        $view_data = [
            'header' => [
                "title" => 'Login | Admin Panel ',
            ],
            'body' => [
                'title' => 'login',
            ],
            'js' => []
        ];
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "login"));
        if ($validator->fails()) {
            $messages = $validator->messages();
            $error = $messages->all();

            return view('admin.login', $view_data)->withErrors($validator);
        }
        $res = \App\Models\Admin\Admin::do_login($param);

        if ($res['flag'] == 0) {
            return view('admin.login', $view_data)->withErrors('Wrong User Id or Password.');
        } elseif ($res['flag'] == 4) {
            return view('admin.login', $view_data)->withErrors('Your Account is not active currently.');
        } elseif ($res['flag'] == 5) {
            return view('admin.login', $view_data)->withErrors('Your Account is not Approved yet.');
        } elseif ($res['flag'] == 6) {
            return view('admin.login', $view_data)->withErrors('Your Account is Suspended.');
        }

        return \Redirect::to("admin/dashboard");
    }
    public function getLogout()
    {
        \Auth::guard('admin')->logout();
        $s = app('settings');
        return redirect("admin/login/" . $s['admin_login_url_token']);
    }
    public function getUpdatePrice()
    {
        try {
            $products = \App\Models\Admin\Product::get();
            foreach ($products as &$product) {
                $tempObj = $product;
                $tempObj = $tempObj->toArray();
                $productDetails = \App\Lib\General::getProductPrice($tempObj, null, 'price');
                $product->product_base_price = $productDetails['base_price'];
                $product->product_buy_price = $productDetails['buy_price'];
                $product->save();
            }
            echo "Script executed successfully...";
            exit;
        } catch (\Exception $e) {
            \Log::error("Error while updating product prices " . $e->getMessage());
        }
    }
    public function getDashboard()
    {
        $products = app('total_product');
        $users = app('total_user');
        $receive_order = \App\Models\User\DSOrders::where('order_status', 0)->count();
        $getting_ready_order = \App\Models\User\DSOrders::where('order_status', 1)->count();
        $shipped_order = \App\Models\User\DSOrders::where('order_status', 2)->count();
        $Complete_order = \App\Models\User\DSOrders::where('order_status', 3)->count();
        $Cancelled_order = \App\Models\User\DSOrders::where('order_status', 4)->count();
        $initiated_order = \App\Models\User\DSOrders::where('order_status', 5)->count();
        $Refunded_order = \App\Models\User\DSOrders::where('order_status', 6)->count();
        // $total_ready_to_ship =\App\Models\User\Orders::where('order_type','product')->count();
        // $total_solitaire =\App\Models\User\Orders::where('order_type','solitaire')->count();
        $Earnings_order = \App\Models\User\DSOrders::sum('order_total');
        $view_data = [
            'header' => [
                "title" => 'Dashboard | Admin Panel ',
            ],
            'body' => [
                'id'    => 'dashboard',
                'label' => 'Dashboard',
                'header_title' => 'Dashboard',
                'total_user' => $users,
                'total_product' => $products,
                'receive_order' => $receive_order,
                'getting_ready_order' => $getting_ready_order,
                'shipped_order' => $shipped_order,
                'Complete_order' => $Complete_order,
                'Cancelled_order' => $Cancelled_order,
                'initiated_order' => $initiated_order,
                'Refunded_order' => $Refunded_order,
                // 'total_ready_to_ship' => $total_ready_to_ship,
                // 'total_solitaire' => $total_solitaire,
                'Earnings_order' => $Earnings_order,
            ]
        ];
        return view('admin.dashboard', $view_data);
    }

    public function getProfile()
    {
        $view_data = [
            'header' => [
                "title" => 'Profile | Admin Panel ',
            ],
            'body' => [
                'id'    => 'profile',
                'label' => 'Profile',
                'header_title' => 'Profile',
            ],
            "footer" => [
                'js' => ['admin/profile.min.js']
            ]
        ];
        return view('admin.profile', $view_data);
    }
    public function getProduct()
    {
        $category = \App\Models\Admin\Category::getAllCategory();
        $subcategory = \App\Models\Admin\SubCategory::get()->toArray();
        $view_data = [
            'header' => [
                "title" => 'Product | Admin Panel ',
            ],
            'body' => [
                'id'    => 'product',
                'label' => 'Product',
                'header_title' => 'Product',
                'category' => $category,
                'subcategory' => $subcategory,
            ],
            "footer" => [
                'js' => ['admin/product.min.js']
            ]
        ];
        return view('admin.product', $view_data);
    }
    public function getProductDetail($id)
    {
        $product = Product::with('category', 'subcategory')->where('id', $id)->first();
        if (is_null($product)) {
            return view('errors.404');
        }
        $product = $product->toArray();
        $allSubcategory = SubCategory::whereIn('category_id', [$product['category_id'], -1])->get()->toArray();
        $allCategory = Category::get()->toArray();
        $subcategory = Arr::pluck($product['subcategory'], 'subcategory_id');
        $subcategoryData = [];
        foreach ($allSubcategory as $value) {
            $tempData = [
                "value" => $value['id'],
                "text" => $value['name']
            ];
            if (in_array($value['id'], $subcategory)) array_push($subcategoryData, json_encode($tempData));
        }
        $related_products = \App\Models\Admin\Product::where('product_sku', '!=', $product['product_sku'])
            ->where('category_id', '!=', 6)
            ->where('is_solitaire', $product['is_solitaire'])->get()->toArray();
        $view_data = [
            'header' => [
                "title" => 'Product Detail | Admin Panel ',
            ],
            'body' => [
                'id'    => 'product',
                'label' => 'Product',
                'header_title' => 'Product',
                'product' => $product,
                'sub_category' => $allSubcategory,
                'subcategory' => implode(',', $subcategory),
                'subcategoryData' => $subcategoryData,
                'related_products' => $related_products,
                'category' => $allCategory,
            ],
            "footer" => [
                'js' => ['admin/product_detail.min.js']
            ]
        ];
        return view('admin.product_detail', $view_data);
    }
    public function postUpdateProduct()
    {
        $param = \Input::all();
        // dd($param);
        $validator = \Validator::make($param, \Validation::get_rules("admin", "update_product"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        if (!is_array($param['sub_category']) || count($param['sub_category']) < 1) return \General::error_res('Please select subcategory');

        $res = Product::update_product($param);
        return $res;
    }
    public function getPincode()
    {
        $view_data = [
            'header' => [
                "title" => 'Pincodes | Admin Panel ',
            ],
            'body' => [
                'id'    => 'pincode',
                'label' => 'Pincode',
                'header_title' => 'pincode',
            ],
            "footer" => [
                'js' => ['admin/pincode.min.js']
            ]
        ];
        return view('admin.pincode', $view_data);
    }
    public function getCoupon()
    {
        $view_data = [
            'header' => [
                "title" => 'Coupon | Admin Panel ',
            ],
            'body' => [
                'id'    => 'coupon',
                'label' => 'Coupon',
                'header_title' => 'Coupon',
            ],
            "footer" => [
                'js' => ['admin/coupon.min.js']
            ]
        ];
        return view('admin.coupon', $view_data);
    }
    public function getCategory()
    {
        $view_data = [
            'header' => [
                "title" => 'Category | Admin Panel ',
            ],
            'body' => [
                'id'    => 'category',
                'label' => 'Category',
                'header_title' => 'Category',
            ],
            "footer" => [
                'js' => ['admin/category.min.js']
            ]
        ];
        return view('admin.category', $view_data);
    }
    public function getSubCategory()
    {
        $category = \App\Models\Admin\Category::getAllCategory();
        $view_data = [
            'header' => [
                "title" => 'Sub Category | Admin Panel ',
            ],
            'body' => [
                'id'    => 'subcategory',
                'label' => 'Sub Category',
                'header_title' => 'Subcategory',
                'category' => $category
            ],
            "footer" => [
                'js' => ['admin/subcategory.min.js']
            ]
        ];
        return view('admin.subcategory', $view_data);
    }
    public function getUser()
    {
        $view_data = [
            'header' => [
                "title" => 'User | Admin Panel ',
            ],
            'body' => [
                'id'    => 'user',
                'label' => 'User',
                'header_title' => 'User',
            ],
            "footer" => [
                'js' => ['admin/user.min.js']
            ]
        ];
        return view('admin.user', $view_data);
    }
    public function postUploadProductData(Request $request)
    {
        $param = $request->all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "upload_product_csv"));

        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csvData = array_map('str_getcsv', file($file));
            unset($csvData[0]);

            foreach ($csvData as $data) {
                $product = \App\Models\Admin\Product::where('product_sku', trim($data[0]))
                    ->where('default_color', trim($data[12]))
                    ->first();

                if (is_null($product)) {
                    $product = new \App\Models\Admin\Product();
                }

                try {
                    $this->processProductData($product, $param, $data);
                } catch (\Exception $e) {
                    // Log the error and continue to the next record
                    \Log::error("Error importing product SKU: " . trim($data[0]) . " - Error: " . $e->getMessage());
                    continue;
                }
            }
        }

        return \General::success_res("Product imported successfully!");
    }
    private function processProductData($productObj, $param, $data)
    {
        $productObj->category_id = $param['category'];
        $productObj->product_sku = trim($data[0]);
        $productObj->name = trim($data[1]);
        $productObj->description = trim($data[2]);
        $productObj->dimension = trim($data[3]);
        $productObj->material = trim($data[4]);
        $productObj->diamond = trim($data[5]);
        $productObj->stone = trim($data[6]);
        $productObj->gold_weight_18k = trim($data[7]);
        $productObj->gold_weight_14k = trim($data[8]);
        $productObj->making_charges = trim($data[9]);
        $productObj->quantity = trim($data[10]);
        $productObj->default_color = trim($data[12]);
        $productObj->color = trim($data[13]);
        $productObj->default_video = trim($data[14]);
        $productObj->video = trim($data[15]);
        if (trim($data[11]) == 1)
            $productObj->is_recommended = 1;
        else
            $productObj->is_recommended = 0;

        if (trim($data[16]) == 1)
            $productObj->is_most_selling = 1;
        else
            $productObj->is_most_selling = 0;

        if (trim($data[17]) == 1)
            $productObj->is_most_liked = 1;
        else
            $productObj->is_most_liked = 0;

        if (trim($data[18]) == 1)
            $productObj->is_solitaire = 'yes'; // Corrected index: 17 to 18
        else
            $productObj->is_solitaire = 'no';
        if (trim($data[19]) == 1)
            $productObj->solitaire_setting = 'yes'; // Corrected index: 17 to 19
        else
            $productObj->solitaire_setting = 'no';

        $tempObj = $productObj;

        $tempObj = $tempObj->toArray();

        $productDetails = \App\Lib\General::getProductPrice($tempObj, null, 'price');

        $productObj->product_base_price = $productDetails['base_price'];
        $productObj->product_buy_price = $productDetails['buy_price'];
        $productObj->save();


        \App\Models\Admin\ProductSubcategory::where('product_id', $productObj->id)->delete();
        foreach ($param['sub_category'] as $sc) {
            $obj = new \App\Models\Admin\ProductSubcategory();
            $obj->product_id = $productObj->id;
            $obj->subcategory_id = $sc;
            $obj->save();
        }
    }

    public function postUploadPincodeData(Request $request)
    {
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "upload_pincode_excel"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return General::error_res($err_msg);
        }
        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');
            Excel::import(new ExcelImport, $file);
        }

        return \General::success_res("Pincode imported successfully!");
    }
    public function postPincodeList()
    {

        $param = \Input::all();
        $data = Pincode::filter($param);
        $res = General::success_res();
        $res['blade'] = view("admin.pincode_list", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postPincodeDelete()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "delete"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        Pincode::where('id', $param['delete_id'])->delete();
        return \General::success_res('Pincode delete successfully.');
    }
    public function postCategoryList()
    {

        $param = \Input::all();
        $data = \App\Models\Admin\Category::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.category_list", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postCategoryAdd()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "add_category"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        return \App\Models\Admin\Category::addCategory($param);
    }
    public function postCategoryUpdate()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "update_category"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        return \App\Models\Admin\Category::updateCategory($param);
    }
    public function postCategoryDelete()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "delete"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        \App\Models\Admin\Category::where('id', $param['delete_id'])->delete();
        return \General::success_res('Category delete successfully.');
    }

    public function postValidateCoupon()
    {
        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "validate_coupon"));

        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        return \App\Models\Admin\Coupon::validateCoupon($param);
    }
    public function postCouponList()
    {

        $param = \Input::all();
        $data = \App\Models\Admin\Coupon::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.coupon_list", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postCouponAdd()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "add_coupon"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        if ($param['coupon_for'] ==  1) {
            $validator = \Validator::make($param, \Validation::get_rules("admin", "customer_mobile_number"));
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return \General::error_res($err_msg);
            }
        }

        // dd($param);
        // if ($param['discount_type'] == 0) {
        // }

        return \App\Models\Admin\Coupon::addCoupon($param);
    }
    public function postCouponUpdate()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "update_coupon"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }

        // if ($param['min_amount'] != null) {
        //     if ($param['up_to_amount'] != null) {
        //         if ($param['discount'] < $param['min_amount']) {
        //             return \General::error_res('Min Amount must be less than discount amount ');
        //         }
        //     }
        // }

        return \App\Models\Admin\Coupon::updateCoupon($param);
    }
    public function postCouponDelete()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "delete"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        \App\Models\Admin\Coupon::where('id', $param['delete_id'])->delete();
        return \General::success_res('Coupon delete successfully.');
    }
    public function postProductList()
    {
        $param = \Input::all();
        $data = \App\Models\Admin\Product::admin_filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.product_list", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postProductDelete()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "delete"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        \App\Models\Admin\Product::where('id', $param['delete_id'])->delete();
        return \General::success_res('Product delete successfully.');
    }
    public function postGetCategory()
    {
        $res = \General::success_res();
        $res['data'] = \App\Models\Admin\Category::where('status', 1)->get()->toArray();
        return $res;
    }
    public function postSubCategoryList()
    {

        $param = \Input::all();
        $data = \App\Models\Admin\SubCategory::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.subcategory_list", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postSubCategoryAdd()
    {

        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "add_subcategory"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        return \App\Models\Admin\SubCategory::addSubCategory($param);
    }
    public function postSubCategoryUpdate()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "update_subcategory"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        return \App\Models\Admin\SubCategory::updateSubCategory($param);
    }
    public function postSubCategoryDelete()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "delete"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        \App\Models\Admin\SubCategory::where('id', $param['delete_id'])->delete();
        return \General::success_res('SubCategory delete successfully.');
    }
    public function postUserList()
    {

        $param = \Input::all();
        $data = \App\Models\User\User::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.user_list", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postGetSubCategory()
    {

        $param = \Input::all();
        $data = \App\Models\Admin\SubCategory::where('category_id', $param['id'])->get()->toArray();
        $res = \General::success_res();
        $res['data'] = $data;
        return $res;
    }

    public function getBanner()
    {
        $view_data = [
            'header' => [
                "title" => 'Banner | Admin Panel ',
            ],
            'body' => [
                'id'    => 'banner',
                'label' => 'Banner',
                'header_title' => 'banner',
            ],
            "footer" => [
                'js' => ['admin/banner.min.js']
            ]
        ];
        return view('admin.banner', $view_data);
    }

    public function postBannerList()
    {

        $param = \Input::all();
        $data = \App\Models\Admin\Banner::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.banner_list", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postBannerAdd()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "add_banner"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        return \App\Models\Admin\Banner::addBanner($param);
    }
    public function postBannerUpdate()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "update_banner"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        return \App\Models\Admin\Banner::updateBanner($param);
    }
    public function postBannerDelete()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "delete"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        \App\Models\Admin\Banner::where('id', $param['delete_id'])->delete();
        return \General::success_res('Banner delete successfully.');
    }
    public function getSiteContent()
    {
        $view_data = [
            'header' => [
                "title" => 'Site Content | Admin Panel ',
            ],
            'body' => [
                'id'    => 'site_content',
                'label' => 'Site Content',
                'header_title' => 'Site Content',
            ],
            "footer" => [
                'js' => ["ckeditor/ckeditor.js", 'admin/site_content.min.js']
            ]
        ];
        return view('admin.site_content', $view_data);
    }
    public function getSettings()
    {
        $setting = app('settings');
        $view_data = [
            'header' => [
                "title" => 'Setting | Admin Panel ',
            ],
            'body' => [
                'id'    => 'setting',
                'label' => 'Setting',
                'header_title' => 'Profile',
                'setting' => $setting
            ],
            "footer" => [
                'js' => ['admin/setting.min.js']
            ]
        ];
        return view('admin.setting', $view_data);
    }
    public function postSaveSettings()
    {
        $param = \Input::all();
        // dd($param);
        $rule = array(
            'setting_type' => 'required|in:general,password,advance,credentials'
        );
        $validator = \Validator::make($param, $rule);
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        $setting_type = $param['setting_type'];
        unset($param['_token']);
        unset($param['setting_type']);
        $param['settings'] = $param;
        if ($setting_type == 'general') {
            $res = \App\Models\Admin\Settings::edit_general_settings($param);
        } else if ($setting_type == 'credentials') {
            $res = \App\Models\Admin\Settings::set_config($param);
        } else if ($setting_type == 'password') {
            $validator = \Validator::make(\Input::all(), \Validation::get_rules("admin", "change_admin_password"));
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return \General::error_res($err_msg);
            }
            $res = \App\Models\Admin\Admin::change_admin_password($param);
        }
        return $res;
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
    public function postChangeMaintenanceMode()
    {
        $param = \Input::all();
        $setting = \App\Models\Admin\Settings::where('name', 'maintenance_mode')->first();
        $setting->val = $param['maintenance_mode'];
        $setting->save();
        return \General::success_res('Change maintenance mode successfully.');
    }
    public function postGetContent()
    {
        $param = \Input::all();
        return \App\Models\Admin\SiteContent::getContent($param);
    }
    public function postSetContent()
    {
        $param = \Input::all();
        return \App\Models\Admin\SiteContent::setContent($param);
    }
    public function postUpdateProfile()
    {
        $param = \Input::all();
        // dd($param);
        $validator = \Validator::make(\Input::all(), \Validation::get_rules("admin", "update_profile"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }

        $res = \App\Models\Admin\Admin::updateProfile($param);

        return $res;
    }

    public function getContactUs()
    {
        $view_data = [
            'header' => [
                "title" => 'Contact Us | Admin Panel ',
            ],
            'body' => [
                'id'    => 'contactus',
                'label' => 'Contact Us',
                'header_title' => 'Contact Us',
            ],
            "footer" => [
                'js' => ['admin/user.min.js']
            ]
        ];
        return view('admin.contactus', $view_data);
    }
    public function postContactusFilter()
    {
        $param = \Input::all();
        $data = \App\Models\User\ContactUs::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.contactus-filter", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postContactUsDelete()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "delete"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        ContactUs::where('id', $param['delete_id'])->delete();
        return \General::success_res('Contact us data delete successfully.');
    }
    public function getSubscribeUs()
    {
        $view_data = [
            'header' => [
                "title" => 'Subscribe | Admin Panel ',
            ],
            'body' => [
                'id'    => 'subscribe',
                'label' => 'Subscribe',
                'header_title' => 'Subscribe',
            ],
            "footer" => [
                'js' => ['admin/user.min.js']
            ]
        ];
        return view('admin.subscribe', $view_data);
    }
    public function postSubscribeFilter()
    {
        $param = \Input::all();
        $data = \App\Models\User\Subscribe::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.subscribe-filter", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }

    public function getTestimonial()
    {
        $view_data = [
            'header' => [
                "title" => 'Testimonial | Admin Panel ',
            ],
            'body' => [
                'id'    => 'testimonial',
                'label' => 'Testimonial',
                'header_title' => 'Testimonial',
            ],
            "footer" => [
                'js' => ['admin/user.min.js']
            ]
        ];
        return view('admin.testimonial', $view_data);
    }
    public function postTestimonialFilter()
    {
        $param = \Input::all();
        $faq = \App\Models\Admin\Testimonial::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.testimonial_filter", $faq)->render();
        $res['total_record'] = $faq['total_record'];
        return $res;
    }
    public function postAddTestimonial()
    {
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "testimonial"));
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }
        $res = \App\Models\Admin\Testimonial::addTestimonial($param);
        return $res;
    }
    public function postUpdateTestimonial()
    {
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "update_testimonial"));
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }
        $res = \App\Models\Admin\Testimonial::updateTestimonial($param);
        return $res;
    }
    public function postDeleteTestimonial()
    {
        $param = \Input::all();
        $res = \App\Models\Admin\Testimonial::where('id', $param['delete_id']);
        $res->delete();
        $json = \General::success_res('Testimonial deleted successfully.');
        return $json;
    }

    public function getProductReview()
    {
        $product = \App\Models\Admin\Product::get();
        $view_data = [
            'header' => [
                "title" => 'Product Review | Admin Panel ',
            ],
            'body' => [
                'id'    => 'product-review',
                'label' => 'Product Review',
                'header_title' => 'Product Review',
                'product' => $product
            ],
            "footer" => [
                'js' => ['admin/user.min.js']
            ]
        ];
        return view('admin.product_review', $view_data);
    }
    public function postProductReview()
    {
        $param = \Input::all();
        $review = \App\Models\User\Review::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.product_review_filter", $review)->render();
        $res['total_record'] = $review['total_record'];
        return $res;
    }
    public function postAddProductReview()
    {
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "add_review"));
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }
        $res =  \App\Models\User\Review::add_admin_review($param);
        return $res;
    }
    public function postUpdateProductReview()
    {
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "add_review"));
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $res = \General::validation_error_res($msg);
            return $res;
        }
        // $res =  \App\Models\User\Review::updateTestimonial($param);
        return $res;
    }
    public function postDeleteProductReview()
    {
        $param = \Input::all();
        $res =  \App\Models\User\Review::where('id', $param['delete_id']);
        $res->delete();
        $json = \General::success_res('Review deleted successfully.');
        return $json;
    }
    public function postStatusChangeProductReview()
    {
        $param = \Input::all();
        $res =  \App\Models\User\Review::where('id', $param['update_id'])->first();
        $res->status = $param['order_status'];
        if ($res->save()) {
            \App\Models\User\Review::updateReview($res->product_sku);
        }
        $json = \General::success_res('Review status change successfully.');
        return $json;
    }
    public function getSolitairePrice()
    {
        $view_data = [
            'header' => [
                "title" => 'Solitaire Price | Admin Panel ',
            ],
            'body' => [
                'id'    => 'solitaireprice',
                'label' => 'Solitaire Price',
                'header_title' => 'Solitaire Price',
            ],
            "footer" => [
                'js' => ['admin/solitaire_price.min.js']
            ]
        ];
        return view('admin.solitaire_price', $view_data);
    }
    public function postSolitairePriceList()
    {

        $param = \Input::all();
        $data = \App\Models\Admin\SolitairePrice::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.solitaire_price_list", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postSolitairePriceUpdate()
    {

        $param = \Input::all();

        $validator = \Validator::make($param, \Validation::get_rules("admin", "update_solitaire_price"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        return \App\Models\Admin\SolitairePrice::updateSolitairePrice($param);
    }
    public function getOrder()
    {
        $view_data = [
            'header' => [
                "title" => 'Order | Admin Panel ',
            ],
            'body' => [
                'id'    => 'order',
                'label' => 'Order',
                'header_title' => 'Order',
            ],
            "footer" => [
                'js' => ['admin/order.min.js']
            ]
        ];
        return view('admin.order', $view_data);
    }
    public function postOrderList()
    {
        $param = \Input::all();
        $data = \App\Models\User\DSOrders::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.order_list", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postOrderStatusUpdate()
    {

        $param = \Input::all();
        // 0 for single itme, 1 for multi (solitairs with mount)
        $mailItemType = 0;
        $mount_id = 0;
        $obj = \App\Models\User\DSOrderDetails::with('order')->where('id', $param['update_id'])->first();
        if ($obj == null) return General::error_res('Something went wrong.!');
        if ($obj->mount_id != '' && ($obj->product_type == 1 || $obj->product_type == 2 || $obj->product_type == 3)) {
            $mount_id = $obj->mount_id;
            $mailItemType = 1;
            $updateArr = array(
                'dispatch_status' => $param['order_status'],
                'tracking_id' => $param['tracking_id'] ?? null,
                'tracking_url' => $param['tracking_url'] ?? null,
                'tracking_note' => $param['tracking_note'] ?? null,
            );
            \App\Models\User\DSOrderDetails::where('mount_id', $obj->mount_id)->update($updateArr);
        } else {
            $obj->dispatch_status = $param['order_status'];
            $obj->tracking_id = $param['tracking_id'] ?? null;
            $obj->tracking_url = $param['tracking_url'] ?? null;
            $obj->tracking_note = $param['tracking_note'] ?? null;
            $obj->save();
        }

        $logFile = storage_path('logs/sms-log/' . date('Y-m-d') . '.log');
        $monolog = new Logger('log');
        $monolog->pushHandler(new StreamHandler($logFile), Logger::INFO);

        $order_status = $param['order_status'];

        $user_details = \App\Models\User\User::where('id', $obj['order']['user_id'])->first();

        $orderDetail = \App\Models\User\DSOrderDetails::getOrderItemDetail($param['update_id']);
        if($orderDetail['flag'] != 1) return $orderDetail;
        $order_id = $orderDetail['data']['orderDetail']['order_with_detail']['order_id'];

        if ($order_status == '1') {
            // Email Sending To User Getting Ready
           
            if($mailItemType == 1){
                
                $orderDetail = DSOrders::getOrderDetail($orderDetail['data']['orderDetail']['order_with_detail']['order_id']);
                $moutItems = DSOrderDetails::getItemsByMountId($mount_id);
                $orderDetail['data']['orderDetail']['order_detail'] = $moutItems['data']['order_items'];
            }
            $user_detail['mail_blade'] = 'email.order-getting-ready-email';
            
            if($mailItemType == 1){
                $user_detail['mail_blade'] = 'email.order-getting-ready-email-multi';
            }

            $user_detail['name'] =  $user_details->name;
            $user_detail['mail_subject'] = 'Diamond Sutra Getting Your Order Ready | '.$order_id;
            $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
            $user_detail['mail_from_name'] = 'Diamond Sutra';
            $user_detail['to_email'] = $user_details->email;
            $user_detail['orderDetail'] = $orderDetail['data']['orderDetail'];
            try {
                \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
                    $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
                });
            } catch (\Exception $e) {
                dd($e);
            }
        } elseif ($order_status == '2') {
            // Email Sending To User Ready To Ship
            // $orderDetail = \App\Models\User\DSOrderDetails::getOrderItemDetail($param['update_id']);

            if($mailItemType == 1){
                $orderDetail = DSOrders::getOrderDetail($orderDetail['data']['orderDetail']['order_with_detail']['order_id']);
                $moutItems = DSOrderDetails::getItemsByMountId($mount_id);
                $orderDetail['data']['orderDetail']['order_detail'] = $moutItems['data']['order_items'];
            }
            $user_detail['mail_blade'] = 'email.order-shipped-email';

            if($mailItemType == 1){
                $user_detail['mail_blade'] = 'email.order-shipped-email-multi';
            }

            $user_detail['name'] =  $user_details->name;
            $user_detail['mail_subject'] = 'Your order is shipped | ' . $obj['order']['order_id'];
            $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
            $user_detail['mail_from_name'] = 'Diamond Sutra';
            $user_detail['to_email'] = $user_details->email;
            $user_detail['orderDetail'] = $orderDetail['data']['orderDetail'];
            try {
                \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
                    $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
                });
            } catch (\Exception $e) {
            }

            // Send SMS to Customer To Ready To Ship
            $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
            $numbers = array($obj['order']['mobile_no']);
            $sender = 'DMNDST';
            $message = 'Hi ' . $user_details->name . ',%nGreat news! Your order ' . $obj['order']['order_id'] . ' https://tx.gl/r/ibwpd/' . $obj['order']['order_id'] . ' from Diamond Sutra is now ready for shipping. Expect it to arrive soon. Thank you for shopping with us!';
            $res = $SendSMS->sendSms($numbers, $message, $sender);

            $monolog->info('===================================================================');
            $monolog->info('Ready To Ship SMS Send to Mobile Number :- ' . $obj['order']['mobile_no']);
            $monolog->info(json_encode(['data' => $res]));
            $monolog->info('===================================================================');
        } elseif ($order_status == '3') {


            // Email Sending To User Delivered
            // $orderDetail = \App\Models\User\DSOrderDetails::getOrderItemDetail($param['update_id']);

            $updateDeliveryDate = DSOrders::where('order_id',$order_id)->first();
            if($updateDeliveryDate){
                $updateDeliveryDate->expected_delivery_date = date('Y-m-d');
                $updateDeliveryDate->save();
            }

            if($mailItemType == 1){
                $orderDetail = DSOrders::getOrderDetail($orderDetail['data']['orderDetail']['order_with_detail']['order_id']);
                $moutItems = DSOrderDetails::getItemsByMountId($mount_id);
                $orderDetail['data']['orderDetail']['order_detail'] = $moutItems['data']['order_items'];
            }
            $user_detail['mail_blade'] = 'email.order-delivered-email';

            if($mailItemType == 1){
                $user_detail['mail_blade'] = 'email.order-delivered-email-multi';
            }

            $user_detail['name'] =  $user_details->name;
            $user_detail['mail_subject'] = 'Your order is delivered | ' . $obj['order']['order_id'];
            $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
            $user_detail['mail_from_name'] = 'Diamond Sutra';
            $user_detail['to_email'] = $user_details->email;
            $user_detail['orderDetail'] = $orderDetail['data']['orderDetail'];
            try {
                \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
                    $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
                });
            } catch (\Exception $e) {
            }


            // Send SMS to Customer To Delivered
            $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
            $numbers = array($obj['order']['mobile_no']);
            $sender = 'DMNDST';

            // $message = 'Hello '.$user_details->name.',%nExciting news! Your order '.$obj['order']['order_id'].' https://tx.gl/r/ibwpd/'.$obj['order']['order_id'].' from Diamond Sutra has been successfully delivered. We hope you enjoy your purchase!If you have any questions or concerns, feel free to reach out to us at +91 9799975281';

            $message = 'Hello ' . $user_details->name . ', Exciting news! Your order ' . $obj['order']['order_id'] . ' from Diamond Sutra has been successfully delivered. We hope you enjoy your purchase!Thanks!';

            // $smessage = 'Hello Ketan, Exciting news! Your order 123123123 from Diamond Sutra has been successfully delivered. We hope you enjoy your purchase!Thanks!';

            // dd($message,$smessage);

            $res = $SendSMS->sendSms($numbers, $message, $sender);
            $monolog->info('===================================================================');
            $monolog->info('Delivered SMS Send to Mobile Number :- ' . $obj['order']['mobile_no']);
            $monolog->info(json_encode(['data' => $res]));
            $monolog->info('===================================================================');
        } elseif ($order_status == '-1') {

            // User Send SMS For Cancel
            $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
            $numbers = array($obj['order']['mobile_no']);
            $sender = 'DMNDST';
            $message = 'Hello ' . $user_details->name . ',You have canceled your order https://tx.gl/r/ibwpd/' . $obj['order']['order_id'] . ' on diamond Sutra. Our team will be in touch shortly with further instructions for refund.Thank you!';
            $res_mob = $SendSMS->sendSms($numbers, $message, $sender);

            $monolog->info('===================================================================');
            $monolog->info('Cancel SMS Send to Customer Mobile Number :- ' . $obj['order']['mobile_no']);
            $monolog->info(json_encode(['data' => $res_mob]));
            $monolog->info('===================================================================');

            // Email Sending To User Cancel

            // $orderDetail = \App\Models\User\DSOrderDetails::getOrderItemDetail($param['update_id']);
            if($mailItemType == 1){
                $orderDetail = DSOrders::getOrderDetail($orderDetail['data']['orderDetail']['order_with_detail']['order_id']);
                $moutItems = DSOrderDetails::getItemsByMountId($mount_id);
                $orderDetail['data']['orderDetail']['order_detail'] = $moutItems['data']['order_items'];
            }
            $user_detail['mail_blade'] = 'email.order-cancel';
            if($mailItemType == 1){
                $user_detail['mail_blade'] = 'email.order-cancel-multi';
            }
            $user_detail['name'] =  $user_details->name;
            $user_detail['mail_subject'] = 'Your order is canceled ' . $obj['order']['order_id'];
            $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
            $user_detail['mail_from_name'] = 'Diamond Sutra';
            $user_detail['to_email'] = $user_details->email;
            $user_detail['orderDetail'] = $orderDetail['data']['orderDetail'];
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
            $message = 'DIAMOND SUTRA ORDER CANCELLATION ALERTThe following order https://tx.gl/r/ibwpd/' . $obj['order']['order_id'] . ' has been cancelled by the user. Please get in touch with user ' . $user_details->name;
            $res = $SendSMS->sendSms($numbers, $message, $sender);

            $monolog->info('===================================================================');
            $monolog->info('Cancel SMS Send to Mobile Number :- 9799975281');
            $monolog->info(json_encode(['data' => $res]));
            $monolog->info('===================================================================');
        } elseif ($order_status == '4') {

            // User Send SMS For Return Initiated
            $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
            $numbers = array($obj['order']['mobile_no']);
            $sender = 'DMNDST';
            // $message = 'Hello '.$user_details->name.', Return initiated for order https://tx.gl/r/ibwpd/'.$obj['order']['order_id'].' on Diamond Sutra. Our team will be in touch shortly with instructions to schedule pickup. Thank you!';
            $message = 'Hello ' . $user_details->name . ', Return initiated for order ' . $obj['order']['order_id'] . ' on Diamond Sutra. Our team will be in touch shortly with instructions to schedule pickup. Thank you!';
            $res_mo = $SendSMS->sendSms($numbers, $message, $sender);

            $monolog->info('===================================================================');
            $monolog->info('Return Initiated Customer SMS Send to Mobile Number :- ' . $obj['order']['mobile_no']);
            $monolog->info(json_encode(['data' => $res_mo]));
            $monolog->info('===================================================================');

            // Email Sending To User Return Initiated
            // $orderDetail = \App\Models\User\DSOrderDetails::getOrderItemDetail($param['update_id']);
            $user_detail['name'] =  $user_details->name;
            $user_detail['mail_subject'] = 'Return Initiated for your order ' . $obj['order']['order_id'];
            $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
            $user_detail['mail_from_name'] = 'Diamond Sutra';
            $user_detail['to_email'] = $user_details->email;
            $user_detail['mail_blade'] = 'email.order-return-email';
            $user_detail['orderDetail'] = $orderDetail['data']['orderDetail'];
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
            $message = 'RETRUN REQUEST ALERT FOR DIAMOND SUTRA Return initiated for order https://tx.gl/r/ilQLT/' . $obj['order']['order_id'] . '. Please get in touch with the customer ' . $user_details->name . ' ' . $obj['order']['order_id'];
            $res = $SendSMS->sendSms($numbers, $message, $sender);

            $monolog->info('===================================================================');
            $monolog->info('Return Initiated Admin SMS Send to Mobile Number :- 9799975281');
            $monolog->info(json_encode(['data' => $res]));
            $monolog->info('===================================================================');
        }
        return \General::success_res('Order status update successfully.');
    }
    public function getOrderDetail($id)
    {
        $orderDetail = DSOrders::getOrderDetail($id);
        // if ($orderDetail['flag'] != 1) abort('404');
        // dd($orderDetail);
        foreach ($orderDetail['data']['orderDetail']['order_detail'] as $key => &$item) {
            // 0 = product, 1 = solitaire_setting, 2 = solitaire, 3 = solitaire_pair, 4 = loose_solitaire, 5 = loose_solitaire_pair
            if ($item['product_type'] == 2 || $item['product_type'] == 3) {
                $item['mount_product'] = null;
                $mount_id = $item['mount_id'];
                $mount_product = array();
                foreach ($orderDetail['data']['orderDetail']['order_detail'] as $setting) {
                    if ($setting['product_type'] == 1 && $setting['mount_id'] == $mount_id) {
                        $mount_product[$mount_id] = $setting;
                        $item['mount_product'] = $setting['product_sku'] . '_' . $setting['product_gold_quality'] . 'KT_' . config('constant.COLOR_CODE.' . $setting['product_color']);
                        if ($setting['product_size'] != '') {
                            $item['mount_product'] .= '_' . $setting['product_size'];
                        }
                    }
                }
            }
        }
        // dd($orderDetail);
        $view_data = [
            'header' => [
                "title" => 'Order Detail ',
            ],
            'body' => [
                'id'    => 'Order Details',
                'label' => 'Order Details',
                'header_title' => 'Order Details',
                'orderDetail' => $orderDetail['data']['orderDetail']
            ],
            "footer" => [
                'js' => ['admin/order.min.js']
            ]
        ];
        return view('admin.order_detail', $view_data);
    }

    public function getUpdateAllReviews()
    {
        $products = Product::get()->toArray();
        foreach ($products as $product) {
            $res = Review::updateReview($product['product_sku']);
        }

        echo "<h3> All Product Reviews updated </h3>";
        die();
    }
    public function getSubscribeExport()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        ini_set('memory_limit', '-1');

        $headers = ['ID', 'EMAIL'];
        $filename = 'Subscribe-Report-' . date('d-m-Y') . '.csv';

        $file_path = $filename;
        $file = fopen($file_path, "w+");
        fputcsv($file, $headers);

        $Subscribe_list = \App\Models\User\Subscribe::get();

        foreach ($Subscribe_list as $data) {
            $temp = [
                $data->id,
                $data->email,
            ];
            fputcsv($file, $temp);
        }
        fclose($file);
        $headers = ['Content-Type' => 'application/csv'];
        return response()->download($file_path, $filename, $headers);
    }
    public function getContactUsExport()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        ini_set('memory_limit', '-1');

        $headers = ['ID', 'NAME', 'EMAIL', 'MESSAGE'];
        $filename = 'ContactUs-Report-' . date('d-m-Y') . '.csv';

        $file_path = $filename;
        $file = fopen($file_path, "w+");
        fputcsv($file, $headers);

        $Subscribe_list = \App\Models\User\ContactUs::get();

        foreach ($Subscribe_list as $data) {
            $temp = [
                $data->id,
                $data->name,
                $data->email,
                $data->message,
            ];
            fputcsv($file, $temp);
        }
        fclose($file);
        $headers = ['Content-Type' => 'application/csv'];
        return response()->download($file_path, $filename, $headers);
    }

    public function getMigrateOldOrders()
    {
        $orders = Orders::get()->toArray();
        foreach ($orders as $order) {
            if ($order['order_type'] == 'product') {
                if ($order['chain'] == null) {
                    $res = DSOrders::migrateNormalOrder($order);
                    \Log::error($res['msg']);
                } else {
                    $res = DSOrders::migratePendantWithChainOrder($order);
                    \Log::error($res['msg']);
                }
            } elseif ($order['order_type'] == 'preset') {
                $res = DSOrders::migratePresetOrder($order);
            } elseif ($order['order_type'] == 'solitaire') {
                $res = DSOrders::migrateSolitaireOrder($order);
            }
        }
        die('migration completed');
    }



    public function getSeoScript()
    {
        $view_data = [
            'header' => [
                "title" => 'Product | Admin Panel ',
            ],
            'body' => [
                'id'    => 'product',
                'label' => 'Product',
                'header_title' => 'Product SEO',
            ],
            "footer" => [
                'js' => ['admin/product.min.js']
            ]
        ];
        return view('admin.seo_script_upload', $view_data);
    }

    public function postUploadProductSeoData(Request $request)
    {
        $param = $request->all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "upload_product_seo_csv"));

        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csvData = array_map('str_getcsv', file($file));
            unset($csvData[0]);

            foreach ($csvData as $data) {
                try {
                    if (isset($data[1])) {
                        $updateData = [];
                        if (trim($data[2]) != "") {
                            $updateData['title'] = trim($data[2]);
                        }
                        if (trim($data[3]) != "") {
                            $updateData['meta_title'] = trim($data[3]);
                        }
                        if (trim($data[4]) != "") {
                            $updateData['meta_description'] = trim($data[4]);
                        }
                        if (trim($data[5]) != "") {
                            $updateData['meta_keywords'] = trim($data[5]);
                        }
                        $product = \App\Models\Admin\Product::where('product_sku', trim($data[1]))
                            ->update($updateData);
                    }
                } catch (\Exception $e) {
                    \Log::error("Error updating seo script product SKU: " . trim($data[1]) . " - Error: " . $e->getMessage());
                    continue;
                }
            }
        }

        return \General::success_res("SEO updated successfully!");
    }
    
    public function postUploadProductDescData(Request $request)
    {
        $param = $request->all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "upload_product_seo_csv"));

        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csvData = array_map('str_getcsv', file($file));
            unset($csvData[0]);

            foreach ($csvData as $data) {
                try {
                    if (isset($data[2]) && isset($data[0])) {
                        $updateData = [];
                        if (trim($data[2]) != "") {
                            $updateData['description'] = trim($data[2]);
                        }
                        
                        $product = \App\Models\Admin\Product::where('product_sku', trim($data[0]))
                            ->update($updateData);
                    }
                } catch (\Exception $e) {
                    \Log::error("Error updating description script product SKU: " . trim($data[1]) . " - Error: " . $e->getMessage());
                    continue;
                }
            }
        }

        return \General::success_res("Product Desc updated successfully!");
    }


    public function getFlushCache()
    {
        \Cache::flush();
        return "cache clear comeplet.";
    }
}
