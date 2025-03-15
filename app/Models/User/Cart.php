<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $fillable = [];
    protected $hidden = [];

    public static function getHeaderCart()
    {
        $user = app('login_user');
        $cartData['data'] = self::where('user_id', $user['id'])->get()->toArray();
        $res = \General::success_res();
        $res['blade'] = view("user.cart_list", $cartData)->render();
        return $res;
    }

    
}
