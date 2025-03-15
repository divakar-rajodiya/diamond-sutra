<?php

namespace App\lib;

class Validation
{
    private static $rules = array(
        'site' => [
            'check_order' => [
                "saloon" => 'required',
                "address" => 'required',
                "fullName" => 'required',
                "email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i",
                "phone" => "required|numeric|regex:/^[0-9]+$/u",
            ],
            'login' => [
                'email' => 'required|email',
                'password' => 'required',
            ],
            'forgot-password'=>[
                'email'=>"required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i"
            ],
            'change_password'=>[
                'password'  => 'required|min:6|max:15|regex:/^[a-zA-Z0-9@_-]+$/i',
                'confirm_password' => 'required|same:password',
            ],
            'verify_otp' => [
                'user_id' => 'required|exists:users,id',
                'otp' => 'required|size:6'
            ],
            'resend_otp' => [
                'user_id' => 'required|exists:users,id',
                'otp_type' => 'required'
            ],
            'signup' => [
                "name" => "required",
                "phone_number" => "required|min:10|max:10|unique:users,number",
                "email" => "nullable|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i|unique:users,email",
                // "password" => "required|min:6|max:16",
                // "confirm_password" => "required|same:password",
                "is_accept" => 'required'
            ],
            'subscribe' => [
                "email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i|unique:subscribe,email",
            ],
            'partners' => [
                "name" => 'required',
                "business_type" => 'required',
                "restaurent_salon_name" => 'required',
                "email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i|unique:partners,email",
                "phone" => 'required|numeric',
                "address" => 'required',
                "state" => 'required',
                "pincode" => 'required',
            ],
            'check_coupon' => [
                "coupon" => "required",
            ],
            'apply_coupon' => [
                "coupon_code" => "required",
            ],
            'contact-us' => [
                "name" => "required",
                "email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i",
                "msg" => "required|min:3|max:255",
            ],
            'subscribe-us' => [
                "email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i|unique:subscribe,email",
            ],
            'checkout' => [
                "product_sku" => "required",
                "color" => "required",
                "size" => "nullable",
                "gold_weight" => "required",
                "diamond_quality" => "nullable",
                "gold_carat" => "required",
                "diamond_price" => "nullable",
                "gold_price" => "required",
                "making_charges" => "required",
                "gst" => "required",
                "net_amount" => "required",
                "final_amount" => "required",
                "b_fname" => "required",
                "b_lname" => "required",
                "b_phone_number" => ['required', 'digits:10'],
                "b_email" => "required",
                "b_address" => "required",
                "b_city" => "required",
                "b_state" => "required",
                "b_pincode" => "required",
            ],
            'checkout_with_shipping' => [
                "product_sku" => "required",
                "color" => "required",
                "size" => "nullable",
                "gold_weight" => "required",
                "diamond_quality" => "nullable",
                "gold_carat" => "required",
                "diamond_price" => "nullable",
                "gold_price" => "required",
                "making_charges" => "required",
                "gst" => "required",
                "net_amount" => "required",
                "final_amount" => "required",
                "b_fname" => "required",
                "b_lname" => "required",
                "b_phone_number" => ['required', 'digits:10'],
                "b_email" => "required",
                "b_address" => "required",
                "b_city" => "required",
                "b_state" => "required",
                "b_pincode" => "required",
                "s_fname" => "required",
                "s_lname" => "required",
                "s_phone_number" => ['required', 'digits:10'],
                "s_email" => "required",
                "s_address" => "required",
                "s_city" => "required",
                "s_state" => "required",
                "s_pincode" => "required",
            ],
            'checkout_new' => [
                "b_fname" => "required",
                "b_lname" => "required",
                "b_phone_number" => ['required', 'digits:10'],
                "b_email" => "required",
                "b_address" => "required",
                "b_city" => "required",
                "b_state" => "required",
                "b_pincode" => "required",
            ],
            'checkout_with_shipping_new' => [
                "b_fname" => "required",
                "b_lname" => "required",
                "b_phone_number" => ['required', 'digits:10'],
                "b_email" => "required",
                "b_address" => "required",
                "b_city" => "required",
                "b_state" => "required",
                "b_pincode" => "required",
                "s_fname" => "required",
                "s_lname" => "required",
                "s_phone_number" => ['required', 'digits:10'],
                "s_email" => "required",
                "s_address" => "required",
                "s_city" => "required",
                "s_state" => "required",
                "s_pincode" => "required",
            ],
           
        ],
        "api" => [
            'signup' => [
                "name" => "required|regex:/(^([a-zA-z]+)(\d+)?$)/i",
                "email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i|unique:users,email",
                "phone_number" => "required|min:7",
                "password" => "required|min:6|max:16",
                "confirm_password" => "required|same:password",
                "is_accept" => 'required'
            ],
            'login' => [
                'email' => 'required|email',
                'password' => 'required',
            ],
            'mobile_login' => [
                'phone_number' => 'required|digits:10|exists:users,number',
            ],
            'forgot-password' => [
                'email' => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i"
            ],
            'forgot_pass' => [
                'password'  => 'required|min:6|max:15|regex:/^[a-zA-Z0-9@_-]+$/i',
                'confirm_password' => 'required|same:password',
            ],
            'update_profile' => [
                "firstname" => "required|regex:/(^([a-zA-z]+)(\d+)?$)/i",
                "lastname" => "required|regex:/(^([a-zA-z]+)(\d+)?$)/i",
                "profileImage"  => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000"
            ],
          
            'update_user_password' => [
                "newPassword" => "required",
                "confirmNewPassword" => "required",
            ],
        ],
        "user" => [
            'update_profile' => [
                'fullname' => 'required|min:2|max:120|regex:/^[a-zA-Z\s]+$/i',
            ],
            'profile_image' => [
                'image' => 'required|image|mimetypes:image/jpg,image/jpeg,image/png|mimes:jpeg,png,jpg|max:2048',
            ],
            'add_review' => [
                'rating' => 'required|integer|min:1|max:5',
                "title" => "required",
                "order_id" => "required",
                "description" => "required"
            ],
            'image1' => [
                'image1' => 'nullable|image|mimetypes:image/jpg,image/jpeg,image/png|mimes:jpeg,png,jpg|max:2048',
            ],
            'image2' => [
                'image1' => 'nullable|image|mimetypes:image/jpg,image/jpeg,image/png|mimes:jpeg,png,jpg|max:2048',
            ],
        ],
        "admin" => [
            'login' => [
                'email' => 'required|email',
                'password' => 'required'
            ],
            'upload_product_csv' => [
                'category' => 'required',
                'sub_category' => 'required',
                'csv_file' => 'required'
            ],
            'upload_product_seo_csv' => [
                'csv_file' => 'required'
            ],
            'upload_pincode_excel' => [
                'excel_file' => 'required'
            ],
            'add_category' => [
                'name' => 'required|max:20',
            ],
            'update_category' => [
                'update_id' => 'required',
                'name' => 'required|max:20',
            ],
            'update_product' => [
                'product_id' => 'required',
                'product_name' => 'required',
                'colors' => 'required'
            ],
            'delete' => [
                'delete_id' => 'required',
            ],
            'validate_coupon' => [
                'coupon_code' => 'required',
            ],
            'add_coupon' => [
                'coupon_name' => 'required|max:20',
                'coupon_type' => 'required',
                'coupon_for' => 'required',
                'discount_type' => 'required',
                'discount' => 'required',
                'quantity' =>'required|numeric',
                'expiry_date' => 'required|max:20',
            ],
            'customer_mobile_number' => [
                'coupon_for_customer' => 'required|digits:10'
            ],
            'update_coupon' => [
                'update_id' => 'required|exists:ds_coupan,id',
                'coupon_type' => 'required',
                'coupon_for' => 'required',
                'discount_type' => 'required',
                'discount' => 'required',
                'quantity' =>'required|numeric',
                'expiry_date' => 'required|max:20',
            ],
            'add_subcategory' => [
                'name' => 'required|max:200',
                'category_id' => 'required',
            ],
            'update_subcategory' => [
                'update_id' => 'required',
                'name' => 'required|max:20',
                'category_id' => 'required',
            ],
            'add_banner' => [
                'banner_image' => 'required|image|mimes:jpg,png,jpeg,webp',
                'link' => 'string',
                'sort_order' => 'integer',
            ],
            'update_banner' => [
                'banner_image' => 'nullable|mimes:jpg,png,jpeg,webp',
                'link' => 'string',
                'sort_order' => 'integer',
            ],
            'update_solitaire_price' => [
                'price' => 'required'
            ],
            'add_review' => [
                'rating' => 'required|integer|min:1|max:5',
                "title" => "required",
                "description" => "required"
            ],
        ]
    );

    public static function get_rules($type, $rules_name)
    {
        if (isset(self::$rules[$type][$rules_name]))
            return self::$rules[$type][$rules_name];
        return array();
    }

    public static function validate($type, $rule_name, $custom_msg = [], $args_param = [], $niceNames = [])
    {

        $rules = self::get_rules($type, $rule_name);

        if (count($args_param) > 0) {
            $param = $args_param;
        } else {
            $param = \Input::all();
        }

        if (count($custom_msg) > 0) {
            $validator = \Validator::make($param, $rules, $custom_msg);
        } else {
            $validator = \Validator::make($param, $rules);
        }
        $validator->setAttributeNames($niceNames);

        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $json = \General::error_res($msg);
            $json['data'] = [$msg];
            return $json;
        }

        return \General::success_res();
    }

    public static function custom_validate($param, $rules, $custom_msg = [], $custom_names = [], $sometimes = [])
    {
        $json = [];
        if (count($custom_msg) > 0) {
            $validator = \Validator::make($param, $rules, $custom_msg);
        } else {
            $validator = \Validator::make($param, $rules);
        }
        if (!empty($sometimes)) {
            foreach ($sometimes as $some) {
                if (isset($some['field']) && isset($some['rules']) && isset($some['callback'])) {
                    $validator->sometimes($some['field'], $some['rules'], $some['callback']);
                }
            }
        }

        if (!empty($custom_names)) {
            $validator->setAttributeNames($custom_names);
        }
        if ($validator->fails()) {
            $error = $validator->messages()->all();
            $msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
            $json = \General::validation_error_res($msg);
            $json['data'] = [$msg];
            return $json;
        }
        $json = \General::success_res();
        return  $json;
    }
}
