<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\User\Token;

class ApiController extends Controller
{
    private static $bypass_url = ['postLogin', "postSignup", "postJewelleryData","postGetRecommendProduct","postGetProductDetail","postGetCategory","postGetSubCategory"];

    private $user_id;

    public function __construct()
    {
        $this->middleware('Maintenance');
        $this->middleware('ApiAuth', ['except' => self::$bypass_url]);
        $token = \Request::header('AuthToken');
        $this->user_id = Token::get_user_by_token($token);
        $this->ip = \Request::ip();
        $this->action = \Request::path();
    }

    public function postSignup()
    {
        $param = \Input::all();
        $validation_rules = \Validation::get_rules("api", "signup");
        $validation_msg = [
            "email.required" => "Email Filed is required.",
            "email.exists" => "This email is not registered.",
            "is_accept.required" => "Please accept terms and condition.",
        ];
        $validate = \Validation::custom_validate($param, $validation_rules, $validation_msg);
        if ($validate['flag'] != 1) {
            return $validate;
        }
        return User::signup($param);
    }

    public function postLogin()
    {
        $param = \Input::all();
        $validation_rules = \Validation::get_rules("api", "login");
        $validation_msg = [
            "email.required" => "Email Filed is required.",
            "email.exists" => "This email is not registered.",
        ];
        $validate = \Validation::custom_validate($param, $validation_rules, $validation_msg);
        if ($validate['flag'] != 1) {
            return $validate;
        }

        $result = User::checkUser($param);
        // dd($result);
        if ($result['existing_user']) {
            if ($result['status'] == 1) {
                $user = User::get_by_id($result['id']);
            } elseif ($result['status'] == 2) {
                return \General::error_res("Your account is suspended.");
            } else {
                return \General::error_res("Your account is not active.");
            }
        } else {
            if ($result['status'] == 3) {
                return \General::error_res("Incorrect login Email or Password.");
            } else {
                return \General::error_res("Your account is not register.");
            }
        }

        $delete_token = Token::where('user_id', $user['id'])->delete();
        $loginToken = Token::generate_auth_token();
        $token_data = ['user_id' => $user['id'], 'token' => $loginToken, 'type' => \ConstType::get_type('users_token.type', 'auth'), 'platform' => app('platform')];
        Token::save_token($token_data);

        $json = \General::success_res("Login Successfully...");
        $json['data'] = $user;
        $json['data']['auth_token'] = $loginToken;
        return $json;
    }

    public function postJewelleryData()
    {

        $param = \Input::all();
        if (!isset($param['token'])) {
            return \General::error_res('Token is required');
        }
        if ($param['token'] != env('SECRET_API_TOKEN')) {
            return \General::error_res('Invalid token');
        }

            $response = \Http::get('https://parishidiamond.com/aspxpages/StkDwnlJason.aspx?uname=adityashah&pwd=Crazyadi5');
            if ($response->successful()) {
                $data = $response->json();
                // Handle the data here
            } else {
                // Handle the error here
                $status = $response->status();
                $errorMessage = $response->body();
            }
        $res = \General::success_res();
        $res['data'] = $data;
        return $res;
    }

    public function postGetRecommendProduct()
    {

        $param = \Input::all();
        if (!isset($param['token'])) {
            return \General::error_res('Token is required');
        }
        if ($param['token'] != env('SECRET_API_TOKEN')) {
            return \General::error_res('Invalid token');
        }

        $product = \App\Models\Admin\Product::with('category','sub_category')->where('is_recommended',1)->get()->toArray();

        $res = \General::success_res();
        $res['data'] = $product;
        return $res;
    }
    
    public function postGetProductDetail()
    {

        $param = \Input::all();
        if (!isset($param['token'])) {
            return \General::error_res('Token is required');
        }
        if ($param['token'] != env('SECRET_API_TOKEN')) {
            return \General::error_res('Invalid token');
        }
        if(!isset($param['id']) || $param == ""){
            return \General::error_res('Id is required');
        }

        $product = \App\Models\Admin\Product::with('category','sub_category')->where('id',$param['id'])->get()->toArray();
        if(empty($product)){
            return \General::error_res('Product not found');
        }

        $res = \General::success_res();
        $res['data'] = $product;
        return $res;
    }
    
    public function postGetCategory()
    {

        $param = \Input::all();
        if (!isset($param['token'])) {
            return \General::error_res('Token is required');
        }
        if ($param['token'] != env('SECRET_API_TOKEN')) {
            return \General::error_res('Invalid token');
        }
        $category = \App\Models\Admin\Category::getCategory();
        $res = \General::success_res();
        $res['data'] = $category;
        return $res;
    }
    
    public function postGetSubCategory()
    {

        $param = \Input::all();
        if (!isset($param['token'])) {
            return \General::error_res('Token is required');
        }
        if ($param['token'] != env('SECRET_API_TOKEN')) {
            return \General::error_res('Invalid token');
        }
        $subcategory = \App\Models\Admin\SubCategory::getSubCategory();
        $res = \General::success_res();
        $res['data'] = $subcategory;
        return $res;
    }
}
