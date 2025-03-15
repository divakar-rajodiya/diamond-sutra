<?php

namespace App\Http\Middleware;

use Closure;

class UserAuth
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
        \Config::set('constant.LOGGER', 'A');
        if (\Request::wantsJson()) {
            $token = \Request::header('AuthToken');
            if ($token == "") {
                return \Response::json(\General::session_expire_res(), 401);
            }
            $already_login = \App\Models\Admin\Token::is_active("auth", $token);
            if (!$already_login)
                return \Response::json(\General::session_expire_res("unauthorise"), 401);
        } else {
            // dd(\Auth::guard('user')->check());
            if (!\Auth::guard('user')->check()) {
                $validator = \Validator::make([], []);
                $validator->errors()->add('attempt', \Lang::get('error.session_expired', []));
                return redirect()->to("login")->withErrors($validator, 'login');
            }
            $usr = \Auth::guard('user')->user();
            $ip = md5(
                $_SERVER['REMOTE_ADDR'] .
                    $_SERVER['HTTP_USER_AGENT']
            );
            $ua = \Request::server("HTTP_USER_AGENT");
            if ($usr) {
                $already_login = \App\Models\User\Token::where('type', config("constant.AUTH_TOKEN_STATUS"))
                    ->where('status', 1)
                    ->where('user_id', $usr->id)
                    ->where('ip', $ip)
                    ->where('ua', $ua)
                    ->first();
                if (!$already_login || $usr->status != 1) {
                    \Auth::guard('user')->logout();
                    $validator = \Validator::make([], []);
                    $validator->errors()->add('attempt', \Lang::get('error.session_expired', []));
                    return redirect("login");
                    //return view('merchant.login',$view_data)->withErrors('Session Expired');
                }
            }
        }
        return $next($request);
    }
}
