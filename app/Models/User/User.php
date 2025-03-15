<?php

namespace App\Models\User;

use App\Lib\General;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Event;
use App\Http\Controllers\SMSController;

class User extends Model implements Authenticatable
{

    use AuthenticableTrait;

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    protected $table = 'users';
    protected $fillable = ['name'];
    protected $hidden = ['password'];

    public function getprofileImageUrlAttribute(){
        $return=null;
        if($this->profile_image){
            $imgPathUrl = config('constant.USER_PROFILE_PATH').'/'.$this->profile_image;
            if(file_exists($imgPathUrl)) return config('constant.USER_PROFILE_LINK').'/'.$this->profile_image;
        }

        $return = config('constant.USER_DUMMY_PROFILE_LINK');
        return $return;
    }

    static public function doLogin($param)
    {
        $user = self::where("email", $param['email'])->first();
        $user_type = 'user';
        $res['data'] = $user;
        $res['flag'] = 0;

        if (is_null($user)) {
            return \General::error_res("Your email doesn’t exists.");
        }
        if ($user['status'] == 0) {
            return \General::error_res("Your acount is not actived.");
        }
        if ($user['status'] == 2) {
            return \General::error_res("Your acount is suspend.");
        }
        if (($user['type'] == 1 || $user['type'] == 2) && !\Hash::check($param['password'], $user->password)) {
            return \General::error_res("Your email already used you can forgot your password.");
        }
        if ($user['login_type'] == config('constant.EMAIL_LOGIN') && !\Hash::check($param['password'], $user->password)) {
            return \General::error_res("Invalid password");
        }

        \App\Models\User\Token::delete_token($user->id);
        $auth_token = \App\Models\User\Token::generate_auth_token();

        $data = [
            'status' => 1,
            'type' => config('constant.AUTH_TOKEN_STATUS'),
            'platform' => 0,
            'user_id' => $user->id,
            'token' => $auth_token,
            "ip" => \Request::getClientIp(),
            "ua" => \Request::server("HTTP_USER_AGENT")
        ];
        \App\Models\User\Token::save_token($data);
        \Auth::guard("user")->loginUsingId($user['id'], true);
        $json = \General::success_res("Login successfully");
        return $json;
    }

    public static function create_guest_user($guest){
        $res = \General::error_res('Something went wrong');
        $checkUser = self::where('number',$guest['number'])->first();
        if(isset($checkUser->id)){
            $res = \General::success_res('Guest user created successfully');
            $res['data']['id'] = $checkUser->id;
            return $res;
        }

        $user =  new self;
        $user->name = $guest['name'];
        $user->number = $guest['number'];
        $user->email = $guest['email'];
        $user->status = $guest['status'];
        $user->password = \Hash::make(General::rand_str(10));
        if($user->save()){
            $res = \General::success_res('Guest user created successfully');
            $res['data']['id'] = $user->id;
        }
        return $res;
    }

    static public function doMobileLogin($param){
        $user = self::where("number", $param['phone_number'])->first();
        $user_type = 'user';
        $res['data'] = $user;
        $res['flag'] = 0;
        if (is_null($user)) {
            return \General::error_res("Your mobile number doesn’t exists.");
        }
        if ($user['status'] == 0) {
            return \General::error_res("Your acount is not actived.");
        }
        if ($user['status'] == 2) {
            return \General::error_res("Your acount is suspend.");
        }
        $param['otp'] = UserOtp::generate_otp($user->id,config('constant.OTP_TYPE.LOGIN'));
        $param['otp_type'] = config('constant.OTP_TYPE.LOGIN');
        $param['user_id'] = $user->id;
        $res = UserOtp::save_otp($param);
        // send otp on sms api
        $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
        $numbers = array($param['phone_number']);
        $sender = 'DMNDST';
        $message = 'Welcome to Diamond Sutra! Your OTP for Login is: '.$param['otp'].'. Please use this code to complete your purchase securely.';
        $SendSMS->sendSms($numbers, $message, $sender);
        //
        $res['data'] = array(
            'user_id' => $user->id,
            'number' => $param['phone_number']
        );
        return $res;
    }
    static public function signup($param)
    {
        $user = new self;
        $user->name = $param['name'];
        $user->email = $param['email'] ?? null;
        $user->number = $param['phone_number'];
        $user->status = 0;
        if ($user->save()) {
            $param['otp'] = UserOtp::generate_otp($user->id,config('constant.OTP_TYPE.LOGIN'));
            $param['otp_type'] = config('constant.OTP_TYPE.LOGIN');
            $param['user_id'] = $user->id;
            $res = UserOtp::save_otp($param);
            // send otp on sms api
            $SendSMS = (new SMSController(false, false, 'NmU3MDM4NTEzMjUwNDQ2OTUyNjM0MjUyNzQ1NDM2N2E='));
            $numbers = array($param['phone_number']);
            $sender = 'DMNDST';
            $message = 'Welcome to Diamond Sutra! Your OTP for Signup is: '.$param['otp'].'. Please use this code to complete your purchase securely.';
            $SendSMS->sendSms($numbers, $message, $sender);
            //

            $user_detail['name'] =  $param['name'];
            $user_detail['mail_subject'] = 'Confirmation ';
            $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
            $user_detail['mail_from_name'] = '';
            $user_detail['to_email'] = $param['email'];
            $user_detail['mail_blade'] = 'emails.confirmation';

            $activation_token = \App\Models\User\Token::generate_activation_token();
            $user_detail['activation_token'] = $activation_token;
            $data = [
                'status' => 1,
                'type' => 1,
                'platform' => 0,
                'user_id' => $user->id,
                'token' => $activation_token,
                "ip" => \Request::getClientIp(),
                "ua" => \Request::server("HTTP_USER_AGENT")
            ];
            $saved_token = \App\Models\User\Token::save_token($data);
            // \Mail::send('emails.confirmation', $user_detail, function ($message) use ($user_detail) {
            //     $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
            // });
            $res = \General::success_res("Register successfully, Please check your inbox for otp.");
            $res['data'] = array(
                'user_id' => $user->id,
                'number' => $param['phone_number']
            );
            return $res;
        }
    }
    public static function update_profile($param)
    {
        $userid = \Auth()->guard('user')->id();
        $user = self::where('id', $userid)->first();
        $user->name = $param['fullname'];
        if(isset($param['password']))
        {
            $user->password = \Hash::make($param['password']);
        }
        if (request()->hasFile('image')) {

            $oldImageName = $user->profile_image;
            if(isset($user->profile_image)){
                $oldImageName = $user->profile_image ?? null;
                if (!file_exists(config('constant.USER_PROFILE_PATH'))) mkdir(config('constant.USER_PROFILE_PATH'), 0777, true);
                $oldImagePath = config('constant.USER_PROFILE_PATH'). '/' . $oldImageName;
                if($oldImageName){
                    if(file_exists($oldImagePath)){
                        unlink($oldImagePath);
                    }
                }
            }
            $file = request()->file('image');
            $ext = $file->getClientOriginalExtension();
            $randomName = substr(md5(mt_rand()), 0, 5);
            $image_name = $randomName . time() . "." . $ext;
            if (!$file->move(config('constant.USER_PROFILE_PATH'), $image_name)) {
                return \General::error_res('Something wrong with uploading Profile image.!');
            }

            $user->profile_image = (string)$image_name;
        }

        if ($user->save()) {
            \Request()->session()->forget('user');
            \Request()->session()->put('user', $user);
            return \General::success_res('Profile updated successfully');
        } else {
            return \General::error_res('Something went wrong.');
        }
    }
    public static function checkUser($param)
    {
        $user = self::where('email', $param['email'])->first();
        $res = [];
        if ($user) {
            if (!\Hash::check($param['password'], $user->password)) {
                $res['status'] = 3;
                $res['existing_user'] = false;
                return $res;
            }
            $user = $user->toArray();

            $res['existing_user'] = true;
            $res['status'] = $user['status'];
            $res['id'] = $user['id'];
        } else {
            $res['status'] = 0;
            $res['existing_user'] = false;
        }
        return $res;
    }
    public static function check_user_active_or_not($user_id)
    {
        $user = self::select("status")->where("id", $user_id)->first();
        if ($user && ($user->status == 3 || $user->status == 0)) {
            return true;
        } else {
            return false;
        }
    }
    public static function get_by_id($id = '')
    {
        $merchant = self::find($id);
        if ($merchant) {
            $merchant = $merchant->toArray();
        } else {
            $merchant = [];
        }
        return  $merchant;
    }
    static function do_active($id = "")
    {
        $merchant = self::where('id', $id)->first();
        $merchant->status = 1;
        if ($merchant->save()) {

            $user_detail['name'] =  $merchant->first_name;
            $user_detail['mail_subject'] = 'CoffeeRun account Confirmation ';
            $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
            $user_detail['mail_from_name'] = 'CoffeeRun';
            $user_detail['to_email'] = $merchant->email;
            $user_detail['mail_blade'] = 'emails.verified_success';

            dispatch(new \App\Jobs\CustomerJob($user_detail));

            return true;
        } else {
            return false;
        }
    }
    public static function filter($param)
    {
        $data = self::latest('id', 'desc');
        if (isset($param['first_name']) && $param['first_name'] != "") {
            $data = $data->where("first_name", "like", "%" . $param['first_name'] . "%");
        }
        if (isset($param['last_name']) && $param['last_name'] != "") {
            $data = $data->where("last_name", "like", "%" . $param['last_name'] . "%");
        }
        if (isset($param['email']) && $param['email'] != "") {
            $data = $data->where("email", $param['email']);
        }
        if (isset($param['status']) && $param['status'] != "") {
            $data = $data->where("status", (int)$param['status']);
        }
        if (isset($param['type']) && $param['type'] != "") {
            $data = $data->where("type", (int)$param['type']);
        }

        $count = $data->count();
        $len = $param['itemPerPage'];
        $start = ($param['currentPage'] - 1) * $len;
        $data = $data->skip($start)->take($len)->get()->toArray();
        $res['data'] = $data;
        $res['total_record'] = $count;
        return $res;
    }
    public static function forgotPassword($param)
    {
        $user = self::where('email', $param['email'])->first();
        if (is_null($user)) {
            return \General::error_res("Invalid Email.");
        }
        if ($user->status == 2) {
            return \General::error_res("Your account is suspended.");
        }
        $forgotpass_token = \App\Lib\General::generateResetPasswordKey();
        $mch_detail = $user->toArray();
        $mch_detail['forgotpass_token'] = $forgotpass_token;
        $mch_detail['mail_subject'] = 'Forgot Password';
        $mch_detail['mail_from_email'] = env('SYSTEM_MAIL');
        $mch_detail['mail_from_name'] = 'Diamondsutra';
        $mch_detail['to_email'] = $param['email'];
        $mch_detail['name'] =  $user->name;
        $mch_detail['mail_blade'] = 'email.forget_password';
        $user->password_token = $forgotpass_token;
        $user->save();
        \Mail::send($mch_detail['mail_blade'], $mch_detail, function ($message) use ($mch_detail) {
            $message->from($mch_detail['mail_from_email'], $mch_detail['mail_from_name'])->to($mch_detail['email'])->subject('Forgot Password');
        });
        return \General::success_res("Email send successfully.");
    }
    public static function get_by_pass_token($token = "")
    {
        $user = [];
        if ($token != '' && $token != null) {
            $user = self::where("password_token", $token)->first();
            if ($user) {
                $user = $user->toArray();
            }
        }
        return $user;
    }
    public static function update_user_password($param)
    {
        $data = self::where('id', $param['id'])->first();
        $data->password = \Hash::make($param['newPassword']);
        $password = $param['newPassword'];
        $conformPassword = $param['confirmNewPassword'];
        if ($password != $conformPassword) {
            return \General::error_res("Password and conform password cannot be match");
        } else {
            $result = $data->save();
            if ($result) {
                return \General::success_res("successfully change password.");
            } else {
                return \General::error_res("something went to worng");
            }
        }
    }
    public static function get_all()
    {
        $data = self::get();
        if ($data->isEmpty()) {
            $data =  [];
        } else {
            $data =  $data->toArray();
        }
        return $data;
    }
}
