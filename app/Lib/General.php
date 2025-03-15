<?php

namespace App\Lib;

use App\Models\Admin\Pincode;
use App\Models\Admin\Product;
use App\Models\Admin\SolitaireData;
use DateInterval;
use DateTime;
use Illuminate\Support\Arr;
use \Mycrypt;
use PDO;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Securities\Price;
use PragmaRX\Google2FA\Google2FA as Google2FA;
use Twilio\Rest\Client;

class General
{

    static function error_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "error" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 0, 'msg' => $msg);
        return $json;
    }

    static function success_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "success" : $msg;
        $msg_id = 'success.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 1, 'msg' => $msg);
        return $json;
    }

    static function validation_error_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "validation error" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 2, 'msg' => $msg);
        return $json;
    }

    static function info_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "information" : $msg;
        $msg_id = 'info.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 3, 'msg' => $msg);
        return $json;
    }

    static function email_verify_error_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "Your account is not active. Please verify your email address" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 4, 'msg' => $msg);
        return $json;
    }

    static function mobile_verify_error_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "mobile_not_verified" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 4, 'msg' => $msg);
        return $json;
    }

    static function maintenance_mode_error_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "maintenance_mode_on" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 5, 'msg' => $msg);
        return $json;
    }

    static function request_token_expire_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "Request token invalid" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 7, 'msg' => $msg);
        return $json;
    }

    static function session_expire_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "Session Expired" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 8, 'msg' => $msg);
        return $json;
    }

    static function _url($str)
    {
        if (is_string($str))
            return preg_match("/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/", $str) ? TRUE : FALSE;
        return FALSE;
    }

    static function dd($data, $exit = 0)
    {
        if (in_array(\App::environment(), array("production")))
            return;
        if (is_array($data) || is_object($data)) {
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        } else {
            echo $data . "<br>";
        }
        if ($exit == 1)
            exit;
    }

    static function rand_str($len)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-.';
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    static function MongoDate($date_str = "")
    {
        $date_str = $date_str == "" ? date("Y-m-d H:i:s") : $date_str;
        $time = strtotime($date_str) * 1000;
        $date = date("Y-m-d H:i:s",  $time);
        if (class_exists('\MongoDate')) {
            $date = new \MongoDate($time);
        } else if (class_exists('\MongoDB\BSON\UTCDateTime')) {
            $date = new \MongoDB\BSON\UTCDateTime($time);
        }
        return $date;
    }
    static function mongoDateToDate($object = false)
    {
        if (method_exists($object, "__toString")) {
            return date('Y-m-d H:i:s', $object->__toString() / 1000);
        } else {
            return false;
        }
    }

    static function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    static function get_external_ip()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://ipinfo.io");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        if (\General::is_json($result)) {
            $arr = json_decode($result, true);
            return $arr['ip'];
        }
        return "";
    }

    static function file_get_content_curl($url)
    {
        // Throw Error if the curl function does'nt exist.
        if (!function_exists('curl_init')) {
            die('CURL is not installed!');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    static function number_format($number, $dec = 3)
    {
        return number_format($number / 1000, $dec, ".", "");
    }

    static function google_authenticate($user, $param)
    {
        $custome_msg = [
            'totp.required'   => 'Please Fill OTP',
            'totp.digits'   => 'OTP must 6 digits',
        ];

        $rule = [
            'totp' => 'bail|required|digits:6',
        ];

        $validator = \Validator::make(\Input::all(), $rule, $custome_msg);
        if ($validator->fails()) {
            if (!isset($param['enbdis'])) {
                \App\Models\Token::delete_token();
                \Auth::guard('merchant')->logout();
            }

            $messages = $validator->messages();
            $error = $messages->all();

            $res = \General::validation_error_res($error[0]);
            $res['data'] = $error;
            return $res;
        }

        $key = $user['id'] . ':' . $param['totp'];
        $exist = \Cache::has($key);
        if ($exist) {
            if (!isset($param['enbdis'])) {
                \App\Models\Token::delete_token();
                \Auth::guard('merchant')->logout();
            }
            return \General::error_res('OTP is expired.');
        }

        $secret = \Crypt::decrypt($user['google2fa_secret']);
        // $google2fa = new Google2FA();
        $verify =   \Google2FA::verifyKey($secret, $param['totp']);
        \General::log('2fa verification : ' .  json_encode($verify));
        if (!$verify) {
            if (!isset($param['enbdis'])) {
                \App\Models\Token::delete_token();
                \Auth::guard('merchant')->logout();
            }
            return \General::error_res('OTP is incorrect.');
        }
        $key    = $user['id'] . ':' . $param['totp'];

        //use cache to store token to blacklist
        \Cache::add($key, true, 4);

        return \General::success_res();
    }

    public static function post_curl($url, $param)
    {
        $data = '';
        foreach ($param as $k => $v) {
            $data .= $k . '=' . $v . '&';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            $data
        );
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    static function commonData($param, $type)
    {

        if ($param == 'name' && $type == 'admin') {
            $user = \Auth::guard('admin')->user()->toArray();
            return  $user['username'];
        }
        if ($param == 'name' && $type == 'user') {
            $user = \Auth::guard('merchant')->user()->toArray();
            return  $user['name'];
        }
        return;
    }
    static function rand_key($len)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    static function generateAppKey()
    {
        $app_id = 'live_' . self::rand_key(10);
        $chk = \App\Models\Application::where('app_id', $app_id)->first();
        while (!is_null($chk)) {
            $app_id = 'live_' . self::rand_key(10);
            $chk = \App\Models\Application::where('app_id', $app_id)->first();
        }

        $app = array('app_id' => $app_id);
        return $app;
    }
    static function generateResetPasswordKey()
    {
        $key = self::rand_key(20);
        $chk = \App\Models\User\User::where('password_token', $key)->first();
        while (!is_null($chk)) {
            $key = self::rand_key(20);
            $chk = \App\Models\User\User::where('password_token', $key)->first();
        }

        return $key;
    }
    static function ip2location($ip)
    {
        $url = 'http://www.geoplugin.net/json.gp?ip=' . $ip;
        //        $url = 'https://www.geoip-db.com/json/'; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

        $output = curl_exec($ch);
        curl_close($ch);

        $location = $output;
        $location = json_decode($output, true);
        // dd($location);
        $data = [];
        if ($location['geoplugin_status'] != 404) {
            $data = [
                'country_name' => $location['geoplugin_countryName'],
                'country_code' => $location['geoplugin_countryCode'],
                "city" => $location['geoplugin_city'],
                "region" => $location['geoplugin_region'],
                'lat' => $location['geoplugin_latitude'],
                'long' => $location['geoplugin_longitude'],
            ];
            $res = \General::success_res();
            $res['data'] = $data;
        } else {
            $data = [
                'country_name' => 'Not Found',
            ];
            $res = \General::error_res();
            $res['data'] = $data;
        }

        return $res;
    }

    static function  resize_n_copy_image($file, $w, $h, $tofile, $crop = FALSE)
    {
        $status = false;

        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if ($ext == "gd") {
            $src = imagecreatefromgd($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagegd($dst, $tofile);
        } elseif ($ext == "gif") {
            $src = imagecreatefromgif($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagegif($dst, $tofile);
        } elseif ($ext == "bmp") {
            $src = imagecreatefrombmp($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagebmp($dst, $tofile);
        } elseif ($ext == "png") {
            $src = imagecreatefrompng($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagepng($dst, $tofile);
        } elseif ($ext == "gd2") {
            $src = imagecreatefromgd2($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagegd2($dst, $tofile);
        } elseif ($ext == "xbm") {
            $src = imagecreatefromxbm($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagexbm($dst, $tofile);
        } elseif ($ext == "vnd.wap.wbmp" || $ext == "wbmp") {
            $src = imagecreatefromwbmp($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagewbmp($dst, $tofile);
        } elseif ($ext == "webp") {
            $src = imagecreatefromwebp($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagewebp($dst, $tofile);
        } else {
            $src = imagecreatefromjpeg($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagejpeg($dst, $tofile);
        }
        return $status;
    }
    static function is_api_url()
    {
        $path = request()->path();
        $exp_path = explode("/", $path);

        if (isset($exp_path[0]) && $exp_path[0] == "api") {
            return true;
        } else {
            return false;
        }
    }

    static function secondsToTime($seconds)
    {
        $return = [
            'year' => 0,
            'month' => 0,
            'days' => 0,
            'hours' => 0,
            'minutes' => 0,
            'seconds' => 0,
        ];
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        $return['year'] = (int)$dtF->diff($dtT)->format('%y');
        $return['month'] = (int)$dtF->diff($dtT)->format('%m');
        $return['day'] = (int)$dtF->diff($dtT)->format('%d');
        $return['hour'] = (int)$dtF->diff($dtT)->format('%h');
        $return['minute'] = (int)$dtF->diff($dtT)->format('%i');
        $return['second'] = (int)$dtF->diff($dtT)->format('%s');
        return $return;
    }
    static function get_codecard_arr()
    {
        $codecard = [
            1 =>  rand(111111, 999999),
            2 =>  rand(111111, 999999),
            3 =>  rand(111111, 999999),
            4 =>  rand(111111, 999999),
            5 =>  rand(111111, 999999),
            6 =>  rand(111111, 999999),
            7 =>  rand(111111, 999999),
            8 =>  rand(111111, 999999),
            9 =>  rand(111111, 999999),
        ];

        $codecard = array_unique($codecard);
        if (sizeof($codecard) == 9) {
            return $codecard;
        } else {
            return self::get_codecard_arr();
        }
    }
    static function get_number_arr($min = 1, $max = 9, $count = 3)
    {
        $codecard = [];

        if ($max - ($min - 1) < $count) {
            return [];
        }

        for ($i = 1; $i <= $count; $i++) {
            $codecard[] =  rand($min, $max);
        }
        $codecard = array_unique($codecard);
        if (sizeof($codecard) == $count) {
            return $codecard;
        } else {
            return self::get_number_arr($min, $max, $count);
        }
    }
    static function get_ip_by_domain_name($domain_name = '')
    {
        $ip = false;
        if ($domain_name != '') {
            $data_json = file_get_contents("http://ip-api.com/json/" . $domain_name);
            $data_arr = json_decode($data_json, true);
            if (isset($data_arr['status']) && strtolower($data_arr['status']) == 'success') {
                $ip = $data_arr['query'];
            }
        }
        return $ip;
    }
    static function validateURL($url)
    {
        $pattern_1 = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
        if (preg_match($pattern_1, $url)) {
            return true;
        } else {
            return false;
        }
    }
    static function http_build_query_for_curl($arrays, &$new = array(), $prefix = null)
    {

        if (is_object($arrays)) {
            $arrays = get_object_vars($arrays);
        }

        foreach ($arrays as $key => $value) {
            $k = isset($prefix) ? $prefix . '[' . $key . ']' : $key;
            if (is_array($value) or is_object($value)) {
                self::http_build_query_for_curl($value, $new, $k);
            } else {
                $new[$k] = $value;
            }
        }
    }

    static function get_browser($useragent_string = '')
    {
        $u_agent = $useragent_string;
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";
        $ub = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Opera/i', $u_agent) || preg_match('/OPR/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = isset($matches['version'][0]) ? $matches['version'][0] : '';
            } else {
                $version = isset($matches['version'][1]) ? $matches['version'][1] : '';
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }

    public static function array_except($array, $keys)
    {
        foreach ($keys as $key) {
            unset($array[$key]);
        }
        return $array;
    }

    public static function has_script_keyword($str = '')
    {
        if ($str == '' || strpos($str, 'script') !== false) {
            return true;
        }
        return false;
    }
    static function rand_otp($len)
    {
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    static function check_webhook_url($url = '')
    {
        $check = self::validateURL($url);
        if ($check) {
            stream_context_set_default(
                array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => "Content-Length: 0",
                        'timeout' => 10
                    )
                )
            );
            $headers = @get_headers($url);
            if ($headers && substr($headers[0], 9, 3) == 200) {
                /*$httpcode = substr($headers[0], 9, 3);
                if($httpcode == 200){*/
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    static function send_sms($number, $msg = '')
    {
        try {
            $sid    = env('TWILLIO_SID', "ACae2d67521fbc1846a491ac5253074c96");
            $token  = env('TWILLIO_AUTH_TOKEN', 'd36b9937a803335680e46ca0cc5ab710');
            $twilio = new Client($sid, $token);
            if (env('APP_ENV') == 'local') {
                $number = "+919737023110";
            } else {
                $number = '+61' . $number;
            }
            $message = $twilio->messages
                ->create(
                    $number, // to 
                    array(
                        "messagingServiceSid" => env('TWILLIO_SERVICE_ID', 'MG24bd3358e6caac66cb51438efa870867'),
                        "body" => $msg
                    )
                );
            if (isset($message->sid)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function check_facebook_access_token($token)
    {
        $url = "https://graph.facebook.com/me?fields=email,id&access_token=" . $token;
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2
        ));

        $result = curl_exec($ch);
        // \General::log("Facebook login res");
        // \General::log($result);
        $result = json_decode($result, true);
        curl_close($ch);
        $res = self::error_res("not_authorise");
        if (isset($result['email'])) {
            $res = self::success_res();
            $res['data']['email'] = $result['email'];
            return $res;
        }

        return $res;
    }

    public static function check_google_access_token($token)
    {
        $url = "https://www.googleapis.com/oauth2/v3/tokeninfo?access_token=" . $token;
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2
        ));

        $result = curl_exec($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if (isset($result['email'])) {
            $res = self::success_res();
            $res['data']['email'] = $result['email'];
            return $res;
        }
        $res = self::error_res("not_authorise");
        return $res;
    }

    public static function log($log)
    {
        $cacheLog = [];
        if (\Cache::has('logs')) {
            $cacheLog = \Cache::get('logs');
        }
        if (is_array($log)) {
            $cacheLog[date('Y-m-d')][date('Y-m-d H:i:s')] = json_encode($log);
        } else {
            $cacheLog[date('Y-m-d')][date('Y-m-d H:i:s')] = $log;
        }
        \Cache::forever('logs', $cacheLog);
    }

    public static function getEstimatedDeliveryDate($pincode, $date = null, $state = null)
    {
        $pincodeData = Pincode::where('pincodes', $pincode);
        if ($state != null) $pincodeData = $pincodeData->where('state', $state);

        $pincodeData = $pincodeData->first();
        if (is_null($pincodeData)) {
            return 0;
        }
        $pincodeData = $pincodeData->toArray();

        if (is_null($date))
            $currentDate = new DateTime();

        $estimatedDay = $pincodeData['estimated_time'] + app('settings')['default_delivery_period'];
        $currentDate->add(new DateInterval('P' . $estimatedDay . 'D'));
        return $currentDate->format('Y-m-d');
    }
    public static function addCommission($price)
    {
        if ($price < 2000000) {
            return $price + ((10 * $price) / 100);
        } else {
            return $price + ((5 * $price) / 100);
        }
    }
    // Sort function for comparing products based on their default_base_price
    static function compareByPrice($a, $b)
    {
        if ($a['default_base_price'] == $b['default_base_price']) {
            return 0;
        }
        return ($a['default_base_price'] < $b['default_base_price']) ? -1 : 1;
    }

    static function getProductPrice($product = null, $settingPrice = null, $returnType = 'product')
    {
        if ($product == null) abort('404');
        $settings = app('settings');
        if (isset($product['diamond'])) {
            if (!is_array($product['diamond'])) $product['diamond'] = json_decode($product['diamond'], true);
        }
        if (isset($product['stone'])) {
            if (!is_array($product['stone'])) {
                if ($product['stone'] != '') {
                    $product['stone'] = json_decode($product['stone'], true);
                    $product['stone_price'] =  $product['stone'][0]['price'];
                } else {
                    $product['stone_price'] =  null;
                }
            }
        }
        $sizeList = null;
        $goldPriceList = array(
            '14' => null,
            '18' => null
        );
        $goldWeightList = array(
            '14' => null,
            '18' => null
        );
        $makingChargesList = array(
            '14' => null,
            '18' => null
        );
        $makingChargesDiscountList = array(
            '14' => null,
            '18' => null
        );
        $defaultSize = config('constant.DEFAULT_RING_SIZE');
        $weightPerSize = config('constant.RING_INCREASE_PER_SIZE');
        $increaseWeightPerSize = config('constant.RING_INCREASE_PER_SIZE');
        $decreaseWeightPerSize = config('constant.RING_DECREASE_PER_SIZE');

        $increaseWeightPerSize14 = 0;
        $decreaseWeightPerSize14 = 0;
        $increaseWeightPerSize18 = 0;
        $decreaseWeightPerSize18 = 0;

        // dd($product);
        if ($product['category_id'] == 1) {
            $sizeList = config('constant.RING_SIZE_LIST');
            $product['size_chart_name'] = 'Ring';
        } elseif ($product['category_id'] == 2) {
            $product['size_chart_name'] = 'Bracelate';
            $sizeList = config('constant.BRACELATE_SIZE_LIST');
            $defaultSize = config('constant.DEFAULT_BRACELATE_SIZE');
            // $weightPerSize = config('constant.BRACELATE_WEIGHT_PER_SIZE');
            $increaseWeightPerSize = config('constant.BRACELATE_INCREASE_PER_SIZE');
            $decreaseWeightPerSize = config('constant.BRACELATE_DECREASE_PER_SIZE');
        } elseif ($product['category_id'] == 5) {
            $product['size_chart_name'] = 'Bangle';
            $sizeList = config('constant.BANGLE_SIZE_LIST');
            $defaultSize = config('constant.DEFAULT_BANGLE_SIZE');
            // $weightPerSize = config('constant.BRACELATE_WEIGHT_PER_SIZE');
            $increaseWeightPerSize = config('constant.BANGLE_INCREASE_PER_SIZE');
            $decreaseWeightPerSize = config('constant.BANGLE_DECREASE_PER_SIZE');
        } else if ($product['category_id'] == 6) {
            $product['size_chart_name'] = 'Chain';
            $sizeList = config('constant.CHAIN_SIZE_LIST');
            $defaultSize = config('constant.DEFAULT_CHAIN_SIZE');
        }
        $product['size_chart'] = null;
        if ($sizeList != null) {
            $product['size_chart'] = $sizeList;
            foreach ($sizeList as $size) {
                $weight14 = null;
                $weight18 = null;
                $perSize14 = null;
                $perSize18 = null;
                if ($size < $defaultSize) {
                    if ($product['category_id'] == 2 || $product['category_id'] == 5) {
                        $perSize14 = ($product['gold_weight_14k'] * $decreaseWeightPerSize) / 100;
                        $perSize18 = ($product['gold_weight_18k'] * $decreaseWeightPerSize) / 100;
                    } elseif ($product['category_id'] == 6) {
                        $perSize14 = ($product['gold_weight_14k'] / $defaultSize);
                        $perSize18 = ($product['gold_weight_18k'] / $defaultSize);
                    } else {
                        $perSize14 = $decreaseWeightPerSize;
                        $perSize18 = $decreaseWeightPerSize;
                    }
                    $diffSize = $defaultSize - $size;
                    $removeWeight14 = $diffSize * $perSize14;
                    $removeWeight18 = $diffSize * $perSize18;
                    $weight14 = round($product['gold_weight_14k'] - $removeWeight14, 3);
                    $weight18 = round($product['gold_weight_18k'] - $removeWeight18, 3);

                    $goldPriceList[14][$size] = round($weight14 * $settings['gold_rate_14k']);
                    $goldPriceList[18][$size] = round($weight18 * $settings['gold_rate_18k']);
                    $goldWeightList[14][$size] = $weight14;
                    $goldWeightList[18][$size] = $weight18;

                    $makingChargesDiscountList[14][$size]['actual_price'] = round($weight14 * $product['making_charges']);
                    $makingChargesDiscountList[14][$size]['discount'] = $settings['making_discount'];
                    $makingChargesDiscountList[14][$size]['discount_amount'] = round(($makingChargesDiscountList[14][$size]['actual_price'] * $makingChargesDiscountList[14][$size]['discount']) / 100);
                    $makingChargesDiscountList[14][$size]['finalMakingCharge'] = $makingChargesDiscountList[14][$size]['actual_price'] - $makingChargesDiscountList[14][$size]['discount_amount'];

                    $makingChargesDiscountList[18][$size]['actual_price'] = round($weight18 * $product['making_charges']);
                    $makingChargesDiscountList[18][$size]['discount'] = $settings['making_discount'];
                    $makingChargesDiscountList[18][$size]['discount_amount'] = round(($makingChargesDiscountList[18][$size]['actual_price'] * $makingChargesDiscountList[18][$size]['discount']) / 100);
                    $makingChargesDiscountList[18][$size]['finalMakingCharge'] = $makingChargesDiscountList[18][$size]['actual_price'] - $makingChargesDiscountList[18][$size]['discount_amount'];


                    $makingChargesList[14][$size] = $makingChargesDiscountList[14][$size]['finalMakingCharge'];
                    $makingChargesList[18][$size] = $makingChargesDiscountList[18][$size]['finalMakingCharge'];
                } elseif ($size > $defaultSize) {
                    if ($product['category_id'] == 2 || $product['category_id'] == 5) {
                        $perSize14 = ($product['gold_weight_14k'] * $increaseWeightPerSize) / 100;
                        $perSize18 = ($product['gold_weight_18k'] * $increaseWeightPerSize) / 100;
                    } elseif ($product['category_id'] == 6) {
                        $perSize14 = ($product['gold_weight_14k'] / $defaultSize);
                        $perSize18 = ($product['gold_weight_18k'] / $defaultSize);
                    } else {
                        $perSize14 = $increaseWeightPerSize;
                        $perSize18 = $increaseWeightPerSize;
                    }
                    $diffSize =  $size - $defaultSize;
                    $addWeight14 = $diffSize * $perSize14;
                    $addWeight18 = $diffSize * $perSize18;
                    $weight14 = round($product['gold_weight_14k'] + $addWeight14, 3);
                    $weight18 = round($product['gold_weight_18k'] + $addWeight18, 3);

                    $goldPriceList[14][$size] = round($weight14 * $settings['gold_rate_14k']);
                    $goldPriceList[18][$size] = round($weight18 * $settings['gold_rate_18k']);
                    $goldWeightList[14][$size] = $weight14;
                    $goldWeightList[18][$size] = $weight18;


                    $makingChargesDiscountList[14][$size]['actual_price'] = round($weight14 * $product['making_charges']);
                    $makingChargesDiscountList[14][$size]['discount'] = $settings['making_discount'];
                    $makingChargesDiscountList[14][$size]['discount_amount'] = round(($makingChargesDiscountList[14][$size]['actual_price'] * $makingChargesDiscountList[14][$size]['discount']) / 100);
                    $makingChargesDiscountList[14][$size]['finalMakingCharge'] = $makingChargesDiscountList[14][$size]['actual_price'] - $makingChargesDiscountList[14][$size]['discount_amount'];

                    $makingChargesDiscountList[18][$size]['actual_price'] = round($weight18 * $product['making_charges']);
                    $makingChargesDiscountList[18][$size]['discount'] = $settings['making_discount'];
                    $makingChargesDiscountList[18][$size]['discount_amount'] = round(($makingChargesDiscountList[18][$size]['actual_price'] * $makingChargesDiscountList[18][$size]['discount']) / 100);
                    $makingChargesDiscountList[18][$size]['finalMakingCharge'] = $makingChargesDiscountList[18][$size]['actual_price'] - $makingChargesDiscountList[18][$size]['discount_amount'];

                    $makingChargesList[14][$size] = $makingChargesDiscountList[14][$size]['finalMakingCharge'];
                    $makingChargesList[18][$size] = $makingChargesDiscountList[18][$size]['finalMakingCharge'];
                } else {
                    $weight14 = round($product['gold_weight_14k'], 3);
                    $weight18 = round($product['gold_weight_18k'], 3);

                    $goldPriceList[14][$size] = round($weight14 * $settings['gold_rate_14k']);
                    $goldPriceList[18][$size] = round($weight18 * $settings['gold_rate_18k']);
                    $goldWeightList[14][$size] = $weight14;
                    $goldWeightList[18][$size] = $weight18;

                    $makingChargesDiscountList[14][$size]['actual_price'] = round($weight14 * $product['making_charges']);
                    $makingChargesDiscountList[14][$size]['discount'] = $settings['making_discount'];
                    $makingChargesDiscountList[14][$size]['discount_amount'] = round(($makingChargesDiscountList[14][$size]['actual_price'] * $makingChargesDiscountList[14][$size]['discount']) / 100);
                    $makingChargesDiscountList[14][$size]['finalMakingCharge'] = $makingChargesDiscountList[14][$size]['actual_price'] - $makingChargesDiscountList[14][$size]['discount_amount'];

                    $makingChargesDiscountList[18][$size]['actual_price'] = round($weight18 * $product['making_charges']);
                    $makingChargesDiscountList[18][$size]['discount'] = $settings['making_discount'];
                    $makingChargesDiscountList[18][$size]['discount_amount'] = round(($makingChargesDiscountList[18][$size]['actual_price'] * $makingChargesDiscountList[18][$size]['discount']) / 100);
                    $makingChargesDiscountList[18][$size]['finalMakingCharge'] = $makingChargesDiscountList[18][$size]['actual_price'] - $makingChargesDiscountList[18][$size]['discount_amount'];


                    $makingChargesList[14][$size] = $makingChargesDiscountList[14][$size]['finalMakingCharge'];
                    $makingChargesList[18][$size] = $makingChargesDiscountList[18][$size]['finalMakingCharge'];
                }
            }
        } else {
            $weight14 = round($product['gold_weight_14k'], 3);
            $weight18 = round($product['gold_weight_18k'], 3);

            $goldPriceList[14] = round($weight14 * $settings['gold_rate_14k']);
            $goldPriceList[18] = round($weight18 * $settings['gold_rate_18k']);
            $goldWeightList[14] = $weight14;
            $goldWeightList[18] = $weight18;

            $makingChargesDiscountList[14]['actual_price'] = round($weight14 * $product['making_charges']);
            $makingChargesDiscountList[14]['discount'] = $settings['making_discount'];
            $makingChargesDiscountList[14]['discount_amount'] = round(($makingChargesDiscountList[14]['actual_price'] * $makingChargesDiscountList[14]['discount']) / 100);
            $makingChargesDiscountList[14]['finalMakingCharge'] = $makingChargesDiscountList[14]['actual_price'] - $makingChargesDiscountList[14]['discount_amount'];

            $makingChargesDiscountList[18]['actual_price'] = round($weight18 * $product['making_charges']);
            $makingChargesDiscountList[18]['discount'] = $settings['making_discount'];
            $makingChargesDiscountList[18]['discount_amount'] = round(($makingChargesDiscountList[18]['actual_price'] * $makingChargesDiscountList[18]['discount']) / 100);
            $makingChargesDiscountList[18]['finalMakingCharge'] = $makingChargesDiscountList[18]['actual_price'] - $makingChargesDiscountList[18]['discount_amount'];

            $makingChargesList[14] = $makingChargesDiscountList[14]['finalMakingCharge'];
            $makingChargesList[18] = $makingChargesDiscountList[18]['finalMakingCharge'];
        }
        $product['making_charge_list'] = $makingChargesList;
        $product['making_charge_discount_list'] = $makingChargesDiscountList;
        $product['gold_price_list'] = $goldPriceList;
        $product['gold_weight_list'] = $goldWeightList;
        $product['default_size'] = $product['category_id'] == 1 || $product['category_id'] == 2 || $product['category_id'] == 5 || $product['category_id'] == 6 ? "$defaultSize" : null;
        $product['diamond_quality_display_list'] = array(
            'IJ_SI' => 'IJ SI',
            'GH_SI' => 'GH SI',
            'GH_VS' => 'GH VS',
            'EF_VVS' => 'EF VVS',
        );

        $diamondPriceList = array(
            'IJ_SI' => null,
            'GH_SI' => null,
            'GH_VS' => null,
            'EF_VVS' => null
        );

        $diamondPrice = array(
            'IJ_SI' => $settings['price_IJ_SI'],
            'GH_SI' => $settings['price_GH_SI'],
            'GH_VS' => $settings['price_GH_VS'],
            'EF_VVS' => $settings['price_EF_VVS']
        );


        if (isset($product['diamond'][0]['price_IJ_SI'])) {
            $discount = round(($product['diamond'][0]['price_IJ_SI'] * $settings['diamond_discount']) / 100);
            $diamondPriceList = array(
                'IJ_SI' => array(
                    'diamond_base_price' => $product['diamond'][0]['price_IJ_SI'],
                    'diamond_discount' => $settings['diamond_discount'],
                    'diamond_discount_amount' => $discount,
                    'diamond_buy_price' => round($product['diamond'][0]['price_IJ_SI'] - $discount)
                ),
                'GH_SI' => array(
                    'diamond_base_price' => $product['diamond'][0]['price_GH_SI'],
                    'diamond_discount' => $settings['diamond_discount'],
                    'diamond_discount_amount' => $discount,
                    'diamond_buy_price' => round($product['diamond'][0]['price_GH_SI'] - $discount)
                ),
                'GH_VS' => array(
                    'diamond_base_price' => $product['diamond'][0]['price_GH_VS'],
                    'diamond_discount' => $settings['diamond_discount'],
                    'diamond_discount_amount' => $discount,
                    'diamond_buy_price' => round($product['diamond'][0]['price_GH_VS'] - $discount)
                ),
                'EF_VVS' => array(
                    'diamond_base_price' => $product['diamond'][0]['price_EF_VVS'],
                    'diamond_discount' => $settings['diamond_discount'],
                    'diamond_discount_amount' => $discount,
                    'diamond_buy_price' => round($product['diamond'][0]['price_EF_VVS'] - $discount)
                )
            );
        }
        $product['default_diamond_quality'] = config('constant.DEFAULT_DIAMOND_QUALITY');
        $product['selected_diamond_quality'] = null;
        if (isset($product['diamond']) && $product['diamond'][0]['quantity'] < 1) {
            $product['is_diamond'] = 'no';
            $diamondPriceList = array(
                'IJ_SI' => array(
                    'diamond_base_price' => 0,
                    'diamond_discount' => 0,
                    'diamond_discount_amount' => 0,
                    'diamond_buy_price' => 0
                ),
                'GH_SI' => array(
                    'diamond_base_price' => 0,
                    'diamond_discount' => 0,
                    'diamond_discount_amount' => 0,
                    'diamond_buy_price' => 0
                ),
                'GH_VS' => array(
                    'diamond_base_price' => 0,
                    'diamond_discount' => 0,
                    'diamond_discount_amount' => 0,
                    'diamond_buy_price' => 0
                ),
                'EF_VVS' => array(
                    'diamond_base_price' => 0,
                    'diamond_discount' => 0,
                    'diamond_discount_amount' => 0,
                    'diamond_buy_price' => 0
                )
            );
        } else {
            $product['is_diamond'] = 'yes';
            $product['selected_diamond_quality'] =  $product['default_diamond_quality'];
            $productDiamondPrice = $diamondPrice['IJ_SI'] * (isset($product['diamond'][0]['carat']) ? $product['diamond'][0]['carat'] : 1);
            $discount = round(($productDiamondPrice * $settings['diamond_discount']) / 100);
            $diamondPriceList['IJ_SI'] = array(
                'diamond_base_price' => $productDiamondPrice,
                'diamond_discount' => $settings['diamond_discount'],
                'diamond_discount_amount' => $discount,
                'diamond_buy_price' => round($productDiamondPrice - $discount)
            );
            $productDiamondPrice = $diamondPrice['GH_SI'] * (isset($product['diamond'][0]['carat']) ? $product['diamond'][0]['carat'] : 1);
            $discount = round(($productDiamondPrice * $settings['diamond_discount']) / 100);
            $diamondPriceList['GH_SI'] = array(
                'diamond_base_price' => $productDiamondPrice,
                'diamond_discount' => $settings['diamond_discount'],
                'diamond_discount_amount' => $discount,
                'diamond_buy_price' => round($productDiamondPrice - $discount)
            );
            $productDiamondPrice = $diamondPrice['GH_VS'] * (isset($product['diamond'][0]['carat']) ? $product['diamond'][0]['carat'] : 1);
            $discount = round(($productDiamondPrice * $settings['diamond_discount']) / 100);
            $diamondPriceList['GH_VS'] = array(
                'diamond_base_price' => $productDiamondPrice,
                'diamond_discount' => $settings['diamond_discount'],
                'diamond_discount_amount' => $discount,
                'diamond_buy_price' => round($productDiamondPrice - $discount)
            );
            $productDiamondPrice = $diamondPrice['EF_VVS'] * (isset($product['diamond'][0]['carat']) ? $product['diamond'][0]['carat'] : 1);
            $discount = round(($productDiamondPrice * $settings['diamond_discount']) / 100);
            $diamondPriceList['EF_VVS'] = array(
                'diamond_base_price' => $productDiamondPrice,
                'diamond_discount' => $settings['diamond_discount'],
                'diamond_discount_amount' => $discount,
                'diamond_buy_price' => round($productDiamondPrice - $discount)
            );
        }

        $product['diamond_price_list'] = $diamondPriceList;


        $product['default_gold_quality'] = config('constant.DEFAULT_GOLD_QUALITY');
        $product['currency_symbol'] = config('constant.CURRENCY_SYMBOL');
        $product['currency'] = config('constant.DEFAULT_CURRENCY');
        $product['color_code_list'] = config('constant.COLOR_CODE');
        $product['color_list'] = config('constant.COLOR');

        $stonePrice = 0;
        $product['is_stone'] = 'no';
        if (isset($product['stone'])) {
            if (isset($product['stone'][0]['price'])) {
                $stonePrice = $product['stone'][0]['price'];
                $product['is_stone'] = 'yes';
            }
        }

        if ($product['category_id'] == 1 || $product['category_id'] == 2 || $product['category_id'] == 5 || $product['category_id'] == 6) {
            $product['default_base_price'] = $goldPriceList[$product['default_gold_quality']]["$defaultSize"] + $diamondPriceList[$product['default_diamond_quality']]['diamond_base_price'] + $stonePrice + $makingChargesList[$product['default_gold_quality']]["$defaultSize"];
            $product['default_buy_price'] = $goldPriceList[$product['default_gold_quality']]["$defaultSize"] + $diamondPriceList[$product['default_diamond_quality']]['diamond_buy_price'] + $stonePrice + $makingChargesList[$product['default_gold_quality']]["$defaultSize"];
        } else {
            $product['default_base_price'] = $goldPriceList[$product['default_gold_quality']] + $diamondPriceList[$product['default_diamond_quality']]['diamond_base_price'] + $stonePrice + $makingChargesList[$product['default_gold_quality']];
            $product['default_buy_price'] = $goldPriceList[$product['default_gold_quality']] + $diamondPriceList[$product['default_diamond_quality']]['diamond_buy_price'] + $stonePrice + $makingChargesList[$product['default_gold_quality']];
        }

        $product['solitaire_price_list'] = null;
        $product['solitaire_quality_list'] = null;
        $product['solitaire_carat_list'] = null;
        $product['solitaire_default_price'] = 0;
        $product['solitaire_default_quality'] = 'IJ_SI';

        $product['solitaire_quantity'] = 0;
        if ($product['is_solitaire'] == 'yes') {
            $product['solitaire_price_list'] = \App\Models\Admin\SolitairePrice::solitairePriceChart($product['category_id']);
            $product['solitaire_quality_list'] = ['IJ_SI', 'GH_SI', 'GH_VS', 'EF_VVS'];
            if ($product['category_id'] == 1 || $product['category_id'] == 4) {
                $product['solitaire_quantity'] = 1;
                $product['solitaire_default_carat'] = '0.30';
                $product['solitaire_carat_list'] = ['0.30', '0.50', '0.70', '1.00'];
                $product['solitaire_default_price'] = $product['solitaire_price_list']['IJ_SI']['0.30'];
            } elseif ($product['category_id'] == 3) {
                $product['solitaire_quantity'] = 2;
                $product['solitaire_default_carat'] = '0.60';
                $product['solitaire_carat_list'] = ['0.60', '1.00', '2.00'];
                $product['solitaire_default_price'] = $product['solitaire_price_list']['IJ_SI']['0.60'];
            }
            if ($settingPrice == null) {
                $product['default_base_price'] =  round($product['default_base_price'] + $product['solitaire_default_price']);
                $product['default_buy_price'] =  round($product['default_buy_price'] + $product['solitaire_default_price']);
            }
        } else {
            $product['solitaire_default_quality'] = null;  // phase2
        }
        $gst = round(($product['default_buy_price'] * 3) / 100);
        $product['default_buy_price'] = $product['default_buy_price'] + $gst;
        $product['default_gst'] = $gst;
        // dd($product);
        if ($returnType == 'product') {
            return $product;
        } else {
            return array(
                'base_price' =>  $product['default_base_price'],
                'buy_price' =>  $product['default_buy_price']
            );
        }
    }

    public static function currency_format($number = 0)
    {
        $num = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $number);
        return '₹ ' . $num . '/-';
    }
    public static function currency_format_pdf($number = 0)
    {
        $num = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $number);
        return $num . '/-';
    }

    public static function validateDiamondJson($jsonString)
    {
        // Decode the JSON string
        $data = json_decode($jsonString, true);

        // Check if JSON is valid
        if (json_last_error() !== JSON_ERROR_NONE) {
            return self::error_res("Invalid JSON format");
        }

        // Check if the input is an array
        if (!is_array($data)) {
            return self::error_res("JSON must be an array");
        }

        foreach ($data as $diamond) {
            // Check for required fields
            if (!isset($diamond['carat']) || !isset($diamond['quantity']) || !isset($diamond['shape'])) {
                return self::error_res("Missing required fields: carat, quantity, shape");
            }

            // Validate carat
            if (!is_numeric($diamond['carat']) || $diamond['carat'] <= 0) {
                return self::error_res("Invalid carat value");
            }

            // Validate quantity
            if (!is_int($diamond['quantity']) || $diamond['quantity'] <= 0) {
                return self::error_res("Invalid quantity value");
            }

            // Validate shape
            if (!is_string($diamond['shape']) || empty($diamond['shape'])) {
                return self::error_res("Invalid shape value");
            }

            // Validate optional price fields if they exist
            $priceFields = ['price_IJ_SI', 'price_GH_SI', 'price_GH_VS', 'price_EF_VVS'];
            foreach ($priceFields as $field) {
                if (isset($diamond[$field]) && (!is_numeric($diamond[$field]) || $diamond[$field] < 0)) {
                    return self::error_res("Invalid value for $field");
                }
            }
        }

        return self::success_res('Json Validated');
    }

    public static function checkProductImages($sku, $color)
    {
        $path = public_path('assets/img/product/' . $sku . '/' . $sku . '_' . $color . '4.webp');
        $images = [
            'image1' => '/assets/img/product/' . $sku . '/' . $sku . '_' . $color . '1.webp',
            'image2' => '/assets/img/product/' . $sku . '/' . $sku . '_' . $color . '2.webp',
            'image3' => '/assets/img/product/' . $sku . '/' . $sku . '_' . $color . '3.webp',
            'image4' => '/assets/img/product/' . $sku . '/' . $sku . '_' . $color . '4.webp',
            'model_image' => '/assets/img/product/' . $sku . '/' . $sku . '_Model_' . $color . '.webp',
        ];

        $imageStatus = [];

        foreach ($images as $key => $path) {
            $imageStatus[$key] = file_exists(public_path($path));
        }

        return $imageStatus;
    }

    static function getCartProductPrice($param, $couponData = null)
    {
        if (isset($couponData['up_to_amount'])) {
            if ($couponData['up_to_amount'] < 1) {
                $couponData = null;
            }
        }
        if ($param['product_type'] == 'product' || $param['product_type'] == 'solitaire_setting') {
            // $product = Product::with(['category', 'subcategory'])->where('product_sku', $param['sku'])->where('default_color', $param['color'])->first();
            $product = Product::with(['category', 'subcategory'])->where('product_sku', $param['sku'])->first();
            if ($product) {

                $customProduct = array_diff_key($param, array_flip(['_token']));
                $customProduct['category_id'] = $product['category_id'];
                $customProduct['coupon_code'] = '';
                $customProduct['binded'] = 0;
                if (isset($param['mount_id'])) {
                    if ($param['mount_id'] != '') {
                        $customProduct['mount_id'] = $param['mount_id'];
                    }
                }
                $customProduct['coupon_discount'] = 0;
                if (!isset($param['quantity'])) {
                    $customProduct['quantity'] = 1;
                } else {
                    $customProduct['quantity'] = $param['quantity'];
                }

                // added to check show browse chain option
                $checkChainInPendant = $product['subcategory']->toArray();
                $checkChainInPendant = collect($checkChainInPendant);
                $found = $checkChainInPendant->contains('subcategory_id', 12);
                $customProduct['with_chains'] = 'not pendant';
                if ($product['category_id'] == 4) {
                    if ($found) {
                        $customProduct['with_chains'] = 'no';
                    } else {
                        $customProduct['with_chains'] = 'yes';
                    }
                }

                $product = \App\Lib\General::getProductPrice($product);
                $customProduct['cart_id'] = $param['sku'] . $product['color_code_list'][$param['color']] . $param['goldCarat'];
                if ($param['diamond'] != '') {
                    $customProduct['cart_id'] .= $param['diamond'];
                }
                if ($param['size'] != '') {
                    $customProduct['cart_id'] .= $param['size'];
                }
                if ($param['solitaire'] != '') {
                    $customProduct['cart_id'] .= $param['solitaire'] . $param['solitaireCarat'];
                }

                $customProduct['name'] = $product['name'];
                // diamond price
                $customProduct['diamond_price'] = 0;
                $customProduct['diamond_discount_amount'] = 0;
                $customProduct['making_discount_per'] = 0;
                $customProduct['making_discount_amount'] = 0;
                if (isset($param['size'])) {
                    if ($param['size'] != '') {
                        $customProduct['making_discount_per'] = $product['making_charge_discount_list'][$param['goldCarat']][$param['size']]['discount'];
                        $customProduct['making_discount_amount'] = $product['making_charge_discount_list'][$param['goldCarat']][$param['size']]['discount_amount'];
                    }
                } else {
                    $customProduct['making_discount_per'] = $product['making_charge_discount_list'][$param['goldCarat']]['discount'];
                    $customProduct['making_discount_amount'] = $product['making_charge_discount_list'][$param['goldCarat']]['discount_amount'];
                }
                $customProduct['diamond_discount_per'] = 0;
                $customProduct['diamond_buy_price'] = 0;
                $customProduct['diamond_quantity'] = 0;
                $customProduct['diamond_shape'] = null;
                $customProduct['diamond_carat'] = null;

                if (isset($product['diamond'][0])) {
                    if (isset($product['diamond'][0]['quantity'])) {
                        if ($product['diamond'][0]['quantity'] > 0) {
                            $customProduct['diamond_price'] = round($product['diamond_price_list'][$param['diamond']]['diamond_base_price']) * $customProduct['quantity'];
                            $customProduct['diamond_discount_amount'] = round($product['diamond_price_list'][$param['diamond']]['diamond_discount_amount']);
                            $customProduct['diamond_discount_per'] = round($product['diamond_price_list'][$param['diamond']]['diamond_discount']);
                            $customProduct['diamond_buy_price'] = round($product['diamond_price_list'][$param['diamond']]['diamond_buy_price']);
                            $customProduct['diamond_quantity'] = $product['diamond'][0]['quantity'];
                            $customProduct['diamond_shape'] = $product['diamond'][0]['shape'];
                            $customProduct['diamond_carat'] = $product['diamond'][0]['carat'];
                        }
                    }
                }

                if ($param['size'] != '') {
                    $customProduct['gold_weight'] = $product['gold_weight_list'][$param['goldCarat']][$param['size']];
                    $customProduct['gold_price'] = $product['gold_price_list'][$param['goldCarat']][$param['size']];
                    $customProduct['product_making_charge'] = $product['making_charge_list'][$param['goldCarat']][$param['size']];
                } else {
                    $customProduct['gold_weight'] = $product['gold_weight_list'][$param['goldCarat']];
                    $customProduct['gold_price'] = $product['gold_price_list'][$param['goldCarat']];
                    $customProduct['product_making_charge'] = $product['making_charge_list'][$param['goldCarat']];
                }

                if ($product['is_solitaire'] == 'yes' && $param['solitaire'] != '') {
                    $customProduct['preset_solitaire_price'] = $product['solitaire_price_list'][$param['solitaire']][$param['solitaireCarat']];
                } else {
                    $customProduct['preset_solitaire_price'] = 0;
                }

                if ($product['stone'] != null) {
                    $customProduct['stone_price'] = $product['stone_price'];
                    $customProduct['stone_detail'] = $product['stone'][0];
                } else {
                    $customProduct['stone_price'] = 0;
                }

                if ($couponData != false) {
                    $customProduct['coupon_code'] = $couponData['couponCode'];

                    if ($couponData['discountType'] == 0) {
                        $customProduct['coupon_discount'] = $couponData['discountAmount'];
                    }

                    if ($couponData['couponType'] == 1 && $customProduct['diamond_quantity'] > 0) {
                        if ($couponData['discountType'] == 1) {
                            $customProduct['coupon_discount'] = round((($customProduct['diamond_buy_price'] * $customProduct['quantity']) * $couponData['discountAmount']) / 100);
                            // $customProduct['diamond_price'] -= $customProduct['coupon_discount'];
                        } else {

                            if ($couponData['discountAmount'] > ($customProduct['diamond_buy_price'] * $customProduct['quantity'])) {
                                $customProduct['coupon_discount'] = ($customProduct['diamond_buy_price'] * $customProduct['quantity']);
                            } else {
                                $customProduct['coupon_discount'] = round($couponData['discountAmount']);
                            }
                            // $customProduct['diamond_price'] -= round($couponData['discountAmount']);
                        }
                        $customProduct['product_price_taxable'] = round($customProduct['diamond_buy_price']
                            + $customProduct['preset_solitaire_price']
                            + $customProduct['gold_price']
                            + $customProduct['stone_price']
                            + $customProduct['product_making_charge']);
                    } else if ($couponData['couponType'] == 2) {
                        if ($couponData['discountType'] == 1) {
                            $customProduct['coupon_discount'] = round((($customProduct['product_making_charge'] * $customProduct['quantity']) * $couponData['discountAmount']) / 100);
                            // $customProduct['product_making_charge'] -= $customProduct['coupon_discount'];
                        } else {
                            if ($couponData['discountAmount'] > ($customProduct['product_making_charge'] * $customProduct['quantity'])) {
                                $customProduct['coupon_discount'] = ($customProduct['product_making_charge'] * $customProduct['quantity']);
                            } else {
                                $customProduct['coupon_discount'] = round($couponData['discountAmount']);
                            }
                            // $customProduct['product_making_charge'] -= round($couponData['discountAmount']);
                        }

                        $customProduct['product_price_taxable'] = round($customProduct['diamond_buy_price']
                            + $customProduct['preset_solitaire_price']
                            + $customProduct['gold_price']
                            + $customProduct['stone_price']
                            + $customProduct['product_making_charge']);
                    } else if ($couponData['couponType'] == 0) {

                        $customProduct['product_price_taxable'] = round($customProduct['diamond_buy_price']
                            + $customProduct['preset_solitaire_price']
                            + $customProduct['gold_price']
                            + $customProduct['stone_price']
                            + $customProduct['product_making_charge']);

                        if ($couponData['discountType'] == 1) {
                            $customProduct['coupon_discount'] = round((($customProduct['product_price_taxable'] * $customProduct['quantity']) * $couponData['discountAmount']) / 100);
                            // $customProduct['product_price_taxable'] -= $customProduct['coupon_discount'];
                        } else {
                            $productPriceTemp = $customProduct['product_price_taxable'] + (round(($customProduct['product_price_taxable'] * 3) / 100));


                            // $customProduct['product_price_taxable'] -= round($couponData['discountAmount']);
                            if ($couponData['discountAmount'] > ($productPriceTemp * $customProduct['quantity'])) {
                                $customProduct['coupon_discount'] = ($productPriceTemp * $customProduct['quantity']);
                            } else {
                                $customProduct['coupon_discount'] = round($couponData['discountAmount']);
                            }
                        }
                    }
                } else {
                    $customProduct['product_price_taxable'] = round($customProduct['diamond_buy_price']
                        + $customProduct['preset_solitaire_price']
                        + $customProduct['gold_price']
                        + $customProduct['stone_price']
                        + $customProduct['product_making_charge']);
                }
                if ($couponData != null) {
                    if ($couponData['up_to_amount'] != null) {
                        if ($param['sku'] != 'DSRI237') {
                            // dd($couponData);
                        }
                        if ($customProduct['coupon_discount'] < $couponData['up_to_amount']) {
                            $couponData['up_to_amount'] -= $customProduct['coupon_discount'];
                        } else {
                            $customProduct['coupon_discount'] = $couponData['up_to_amount'];
                            $couponData['up_to_amount'] -= $customProduct['coupon_discount'];
                        }
                    }
                }


                // $customProduct['product_price_taxable'] -= $customProduct['coupon_discount'];

                // calculating prdocut price before discount start
                $price_taxable_temp = $customProduct['product_price_taxable'] + $customProduct['coupon_discount'];
                $product_gst_temp = round(($price_taxable_temp * 3) / 100);
                $customProduct['product_price_without_discount'] = $price_taxable_temp + $product_gst_temp;

                $customProduct['product_mrp'] = round($customProduct['diamond_price']
                    + $customProduct['preset_solitaire_price']
                    + $customProduct['gold_price']
                    + $customProduct['stone_price']
                    + $customProduct['product_making_charge']);


                $customProduct['product_mrp_with_gst'] = round($customProduct['product_mrp'] + (($customProduct['product_mrp'] * 3) / 100));

                $customProduct['product_gst'] = round(($customProduct['product_price_taxable'] * 3) / 100);

                $customProduct['product_buy_price_with_gst'] = $customProduct['product_price_taxable'] + $customProduct['product_gst'];

                $customProduct['product_mrp'] = ($customProduct['product_mrp'] * $customProduct['quantity']);
                $customProduct['product_mrp_with_gst'] = ($customProduct['product_mrp_with_gst'] * $customProduct['quantity']);
                $customProduct['product_price_taxable'] = ($customProduct['product_price_taxable'] * $customProduct['quantity']);
                $customProduct['product_gst'] = ($customProduct['product_gst'] * $customProduct['quantity']);
                $customProduct['product_buy_price_with_gst'] = ($customProduct['product_buy_price_with_gst'] * $customProduct['quantity']);

                $imageList = array();
                foreach ($product['color_code_list'] as $key => $val) {
                    $imageList[$key] = url('public/assets/img/product/') . '/' . $product['product_sku'] . '/' . $product['product_sku'] . '_' . $val . '1.webp';
                }

                $productPriceChart = array(
                    'color_list' => $product['color_list'],
                    'color_code_list' => $product['color_code_list'],
                    'image_list' => $imageList,

                );

                $customProduct['chart'] = $productPriceChart;
                $res = \General::success_res();
                $res['data'] = $customProduct;
                $res['couponData'] = $couponData;
                return $res;
            } else {
                return \General::error_res('Something went wrong!!');
            }
        } elseif (
            $param['product_type'] == 'loose_solitaire' ||
            $param['product_type'] == 'loose_solitaire_pair' ||
            $param['product_type'] == 'solitaire' ||
            $param['product_type'] == 'solitaire_pair'
        ) {
            // dd($param);


            // $diamond = \Cache::get('api_data');
            $diamond = SolitaireData::where('CertNo', $param['cert_no'])->get()->toArray();
            // dd($diamond);
            if ($diamond == null) abort('404');
            $orderSolitaire = \App\Models\User\DSOrderDetails::with('order')
            ->where('solitaire_cert_no', '!=', '')
            ->whereHas('order', function ($query) {
                $query->where('payment_status', 1);
            })->get()->pluck('solitaire_cert_no')->toArray();
            $diamond = array_values(array_filter($diamond, function ($item) use ($param, $orderSolitaire) {
                return ($item['CertNo'] == $param['cert_no'] &&
                    !in_array($item['CertNo'], $orderSolitaire));
            }));
            if ($diamond) {
                $res = \General::success_res();
                if (isset($param['mount_id'])) {
                    if ($param['mount_id'] != '') {
                        $diamond[0]['mount_id'] = $param['mount_id'];
                    }
                }
                if (isset($param['sort_index'])) {
                    $diamond[0]['sort_index'] = $param['sort_index'];
                }
                $diamond[0]['quantity'] = 1;
                $diamond[0]['product_mrp'] = $diamond[0]['Price'];
                $diamond[0]['product_mrp_with_gst'] = round($diamond[0]['Price'] + (($diamond[0]['Price'] * 3) / 100));
                $diamond[0]['coupon_code'] = '';
                $diamond[0]['coupon_discount'] = 0;
                if ($couponData != null) {
                    if ($couponData['couponType'] == 0) {
                        $diamond[0]['coupon_code'] = $couponData['couponCode'];
                        if ($couponData['discountType'] == 1) {
                            $diamond[0]['coupon_discount'] = round(($diamond[0]['Price'] * $couponData['discountAmount']) / 100);

                            if ($couponData['up_to_amount'] != null) {
                                if ($diamond[0]['coupon_discount'] < $couponData['up_to_amount']) {
                                    $couponData['up_to_amount'] -= $diamond[0]['coupon_discount'];
                                } else {
                                    $diamond[0]['coupon_discount'] = $couponData['up_to_amount'];
                                    $couponData['up_to_amount'] -= $diamond[0]['coupon_discount'];
                                }
                            }
                            // $diamond[0]['Price'] -= $diamond[0]['coupon_discount'];
                        } else {
                            $diamond[0]['coupon_discount'] = round($couponData['discountAmount']);
                            // $diamond[0]['Price'] -= round($couponData['discountAmount']);
                        }
                    }
                }

                $diamond[0]['product_price_taxable'] = $diamond[0]['Price'];

                // calculating prdocut price before discount start
                $price_taxable_temp = $diamond[0]['product_price_taxable'] + $diamond[0]['coupon_discount'];
                $diamondBuyPriceTemp = $diamond[0]['Price'] + (round(($diamond[0]['Price'] * 3) / 100));
                if ($diamond[0]['coupon_discount'] > $diamondBuyPriceTemp) {
                    $diamond[0]['coupon_discount'] = $diamondBuyPriceTemp;
                }
                $product_gst_temp = round(($price_taxable_temp * 3) / 100);
                $diamond[0]['product_price_without_discount'] = $price_taxable_temp + $product_gst_temp;


                $diamond[0]['product_gst'] = round(($diamond[0]['Price'] * 3) / 100);
                $diamond[0]['product_buy_price_with_gst'] = $diamond[0]['Price'] + $diamond[0]['product_gst'];
                $diamond[0]['product_type'] = 'loose_solitaire';
                $diamond[0]['item_type'] = 'primary';
                $diamond[0]['cart_id'] = $diamond[0]['RefNo'];
                $diamond[0]['name'] = $diamond[0]['Weight'] . ' Carat ' . $diamond[0]['DisplayShape'] . ' Diamond';
                $diamond[0]['ref_no'] = $param['ref_no'];
                $diamond[0]['cert_no'] = $param['cert_no'];
                $diamond[0]['product_type'] = $param['product_type'];
                $diamond[0]['binded'] = 0;
                $diamond[0]['making_discount_per'] = 0;
                $diamond[0]['diamond_discount_amount'] = 0;
                $diamond[0]['making_discount_amount'] = 0;
                if (isset($param['binded'])) {
                    if ($param['binded'] > 0) {
                        $diamond[0]['binded'] = $param['binded'];
                    }
                }
                $res['data'] = $diamond[0];
                $res['couponData'] = $couponData;

                return $res;
            } else {
                return \General::error_res('Opps! Look like Selected diamond not available');
            }
        }
        return \General::success_res();
    }

    static function updateCartProductPrices($cart, $coupon = null)
    {
        $cartData = array();
        // if ($coupon != null) {
        //     if ($coupon['discountType'] == 0 && $coupon['couponType'] == 0) {
        //         $coupon['discountAmount'] = ($coupon['discountAmount'] / count($cart));
        //     }
        // }

        if (isset($coupon['min_amount'])) {
            $order_total = 0;
            foreach ($cart as $product) {
                $order_total += $product['product_mrp_with_gst'];
            }
            if ($order_total < $coupon['min_amount']) $coupon = null;
        }
        $couponData = $coupon;
        foreach ($cart as $product) {

            $res = self::getCartProductPrice($product, $coupon);

            if ($res['flag'] == 1) {
                $cartData[$res['data']['cart_id']] = $res['data'];
                $coupon = $res['couponData'];
            } else {
                return $res;
            }
        }
        $cartSummery = self::calculateCouponDiscount($cartData, $couponData);

        $res = self::success_res('Success.');
        if ($coupon == null) $res = self::success_res('Success.');
        $res['data']['cartData'] = $cartData;
        $res['data']['cartSummery'] = null;

        if ($cartSummery['flag'] == 1) {
            $res['data']['cartSummery'] = $cartSummery['data'];
        }
        return $res;
    }

    static function calculateCouponDiscount($cartItems, $couponDetails)
    {
        try {
            $itemCount = 0;
            $diamondTotal = 0;
            $itemTotal = 0;
            $orderTotal = 0;
            $makingTotal = 0;
            $discountAmount = 0;

            foreach ($cartItems as $product) {
                $itemCount++;
                // Ensure product_quantity is set and is a positive integer
                $quantity = isset($product['quantity']) ? (int) $product['quantity'] : 1; // Default to 1 if not set
                if (isset($product['diamond_buy_price']) && $product['diamond_buy_price'] != 0) {
                    $diamondTotal += $product['diamond_buy_price'] * $quantity;
                }
                if (isset($product['product_making_charge']) && $product['product_making_charge'] != 0) {
                    $makingTotal += $product['product_making_charge'] * $quantity;
                }
                $itemTotal += $product['product_buy_price_with_gst'];
            }

            if ($couponDetails) {
                if ($couponDetails['discountType'] == config('constant.DISCOUNT.FLAT')) {
                    // Apply flat discount based on coupon type
                    if ($couponDetails['couponType'] == config('constant.COUPON_TYPE.DIAMOND')) {
                        $discountAmount = min($diamondTotal, $couponDetails['discountAmount']);
                    } elseif ($couponDetails['couponType'] == config('constant.COUPON_TYPE.MAKING')) {
                        $discountAmount = min($makingTotal, $couponDetails['discountAmount']);
                    } elseif ($couponDetails['couponType'] == config('constant.COUPON_TYPE.TOTAL')) {
                        $discountAmount = min($itemTotal, $couponDetails['discountAmount']);
                    }
                } elseif ($couponDetails['discountType'] == config('constant.DISCOUNT.PERCENTAGE')) {
                    // Apply percentage discount based on coupon type
                    if ($couponDetails['couponType'] == config('constant.COUPON_TYPE.DIAMOND')) {
                        $discountAmount = ($diamondTotal * $couponDetails['discountAmount']) / 100;
                        if($couponDetails['up_to_amount'] != null){
                            $discountAmount = min($couponDetails['up_to_amount'],($diamondTotal * $couponDetails['discountAmount']) / 100);
                        }
                    } elseif ($couponDetails['couponType'] == config('constant.COUPON_TYPE.MAKING')) {
                        $discountAmount = ($makingTotal * $couponDetails['discountAmount']) / 100;
                        if($couponDetails['up_to_amount'] != null){
                            $discountAmount = min($couponDetails['up_to_amount'],($makingTotal * $couponDetails['discountAmount']) / 100);
                        }
                    } elseif ($couponDetails['couponType'] == config('constant.COUPON_TYPE.TOTAL')) {
                        $discountAmount = ($itemTotal * $couponDetails['discountAmount']) / 100;
                        if($couponDetails['up_to_amount']){
                            $discountAmount = min($couponDetails['up_to_amount'],($itemTotal * $couponDetails['discountAmount']) / 100);
                        }
                    }
                }
            }
            $orderTotal = $itemTotal - $discountAmount;
            $res = General::success_res();
            $res['data'] = [
                'itemCount' => $itemCount,
                'itemTotal' => round($itemTotal),
                'discountAmount' => (int)round($discountAmount),
                'orderTotal' => round($orderTotal)
            ];

            return $res;
        } catch (\Exception $e) {
            return General::error_res('Something went wrong!');
        }
    }

    static function sendSchedularEmail($schedularName, $errorMessage, $successMail = false){
        $user_detail['name'] =  "Ketan Prajapati";
        $user_detail['mail_subject'] = 'Diamondsutra Testing Email ';
        $user_detail['mail_from_email'] = env('SYSTEM_MAIL');
        $user_detail['mail_from_name'] = 'Diamondsutra';
        $user_detail['to_email'] = config('constant.SCHEDULAR_NOTIFY_EMAIL');
        $user_detail['mail_blade'] = 'email.schedular-failed-email';
        if($successMail){
            $user_detail['mail_blade'] = 'email.schedular-success-email';
        }
        $user_detail['schedular_name'] = $schedularName;
        $user_detail['error_message'] = $errorMessage;
        try {
            $res = \Mail::send($user_detail['mail_blade'], $user_detail, function ($message) use ($user_detail) {
                $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
            });
            return General::success_res('sucecss');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
