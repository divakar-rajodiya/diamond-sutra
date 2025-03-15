<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Driver\Token;
use Illuminate\Support\Facades\Auth; 

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $version = \Request::header('UserAgent');
        if($version)
        {
            $resdata = Token::checkVersion($version);
            if(!empty($resdata) && $resdata['flag'] == 13)
            {
                return \Response::json($resdata);
            }
        }
        if (\Request::header("AuthToken") === null) {
            $res = \General::error_res("Auth Token Required");
            return \Response::json($res);
        }
        $token = \Request::header('AuthToken');
        $res = Token::is_logged_in($token);
        if ($res['flag'] == 1) {
            $user_id = Token::get_user_by_token($token);

            if ($user_id == "") {
                $res = \General::error_res("Invalid User id");
                return \Response::json($res);
            }
            if (\App\Models\Driver\Driver::check_user_active_or_not($user_id)) {
                $res = \General::session_expire_res('Unauthorized Token');
                return \Response::json($res);
            }
            return $next($request);
        }
        return \Response::json($res);
    }
}
