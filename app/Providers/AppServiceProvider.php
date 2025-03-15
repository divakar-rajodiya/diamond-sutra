<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('settings', function($app)
        {
            $settings = \App\Models\Admin\Settings::where("autoload",1)->get();
            $set = [];
            foreach ($settings as $val)
            {
                $set[$val['name']] = $val['val'];
            }
            return $set;
        });

        $this->app->singleton('platform', function($app)
        {
            // $ua = \Request::server("HTTP_USER_AGENT");
            $ua =\Request::header('UserAgent');
            if(strpos($ua, "android") !== FALSE)
            {
                return \Config::get("constant.ANDROID_APP_DEVICE");
            }
            else if(strpos($ua, "iPhone") !== FALSE)
            {
                return \Config::get("constant.IPHONE_APP_DEVICE");
            }
            else
            {
                if (env('APP_ENV','local') == 'local' && strpos($ua, "Postman") !== FALSE) {
                    $url = request()->path();
                    $segment = request()->segment(1);
                    if ($segment == 'api') {
                        return \Config::get("constant.ANDROID_APP_DEVICE");   
                    }    
                }
                return \Config::get("constant.WEB_DEVICE");
            }
        });

        $this->app->singleton('login_user', function($app)
        {
            $user = \Auth::guard('user')->user();
            return $user;
            
        });
        $this->app->singleton('total_user', function($app){
            return \App\Models\User\User::count();
        });
        $this->app->singleton('total_product', function($app){
            return \App\Models\Admin\Product::count();
        });
        $this->app->singleton('banner', function($app){
            return \App\Models\Admin\Banner::orderBy('sort_order','asc')->get()->toArray();
        });
        $this->app->singleton('category', function($app)
        {
            return \App\Models\Admin\Category::with('sub_category')->get()->toArray();
            
        });
        $this->app->singleton('carousel_image', function($app)
        {
            return \App\Models\Admin\Product::with('category')->where('is_recommended',1)->where('solitaire_setting','!=','yes')->limit(5)->get()->toArray();
        });
        $this->app->singleton('ip', function($app)
        {
            return $ip = md5(
                $_SERVER['REMOTE_ADDR'] .
                $_SERVER['HTTP_USER_AGENT']
            );            
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
