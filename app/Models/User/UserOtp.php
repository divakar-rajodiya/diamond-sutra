<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;


class UserOtp extends Eloquent
{

    public $table = 'user_otp';
    protected $hidden = [];
    protected $fillable = array('otp', 'otp_type', 'expire_time', 'user_id');

    public function scopeActive($query)
    {
        return $query->where('expire_time', '>', Carbon::now()->timestamp);
    }

    public function userInfo()
    {
        return $this->hasOne('App\Models\Users', 'id', 'user_id');
    }

    public static function generate_otp($user_id, $type)
    {
        static $call_cnt = 0;
        if ($call_cnt > 50)
            return "";
        ++$call_cnt;
        $otp = \General::rand_otp(6);
        $user = self::active()->where("otp_type", '=', $type)->where("user_id", '=', $user_id)->first();
        if (isset($user->otp)) {
            // return self::generate_otp($user_id,$type);

            $user->delete();
        }
        return $otp;
    }

    public static function resendOtp($param)
    {
        $delete = self::delete_all_otp($param['user_id']);
        static $call_cnt = 0;
        if ($call_cnt > 50)
            return "";
        ++$call_cnt;
        $param['otp'] = \General::rand_otp(6);
        $user = self::active()->where("otp_type", '=', $param['otp_type'])->where("user_id", '=', $param['user_id'])->first();
        if (isset($user->otp)) {
            return self::resendOtp($param);
        }
        $res = self::save_otp($param);
        return $res;
    }

    public static function save_otp($param)
    {
        $currentDateTime = Carbon::now();
        $otpExpiration = $currentDateTime->addMinutes(5);
        $formattedExpiration = $otpExpiration->format('Y-m-d H:i:s');
        $otp = new self;
        $otp->otp = $param['otp'];
        $otp->otp_type = $param['otp_type'];
        $otp->expire_time = $formattedExpiration;
        $otp->user_id = $param['user_id'];
        $otp->save();
        $res = \General::success_res('OTP send successfully');
        $res['data'] = $otp->toArray();
        return $res;
    }

    public static function verifyOtp($param)
    {
        $otp = self::where("otp", $param['otp'])
            ->where("user_id", $param['user_id'])
            ->first();
        if (!isset($otp->otp)) return \General::error_res('Invalid OTP');
        if ($otp->expire_time <  Carbon::now()) return \General::error_res('OTP expired');
        $user = User::where('id', $param['user_id'])->first();
        if ($user->status == 0 || $user->status == -1) {
            $user->status = 1;
            $user->save();
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
        \Auth::guard("user")->loginUsingId($user->id, true);
        self::delete_all_otp($user->id);
        return \General::success_res('Otp verified successfully');
    }

    public static function get_active_otp($user_id, $type)
    {
        $otp = self::active()->where("otp_type", "=", $type)
            ->where("user_id", "=", $user_id)
            ->first();
        if (!is_null($otp)) {

            $otp = $otp->toArray();
            return $otp['otp'];
        }
        return FALSE;
    }

    public static function delete_all_otp($user_id)
    {
        $otp = self::where('user_id', $user_id)->delete();
        return \General::success_res();
    }
}
