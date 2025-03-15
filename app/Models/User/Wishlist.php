<?php 
 
namespace App\Models\User;    
use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;
use PhpParser\Node\Expr\FuncCall;

class Wishlist extends Eloquent {
    
    public $table = 'wishlist';
    protected $hidden = [];
    protected $fillable = array();

    public static function update_wishlist($product_id){
        $userId = \Auth::guard('user')->id();
        $check = self::where('user_id', $userId)->where('product_id', $product_id)->first();
        $res = \General::success_res();
        if($check != null){
            $check->delete();
            $res['data'] = 'removed';
            $res['msg'] = 'Item removed from wishlist.';
        }  else {
            $add = new self;
            $add->user_id = $userId;
            $add->product_id = $product_id;
            $add->save();
            $res['data'] = 'added';
            $res['msg'] = 'Item added in wislist.!';
        }
        return $res;

    }
    
    public static function get_user_wishlist(){
        $userId = \Auth::guard('user')->id();
        $data = self::where('user_id',$userId)->get()->pluck('product_id')->toArray();
        return $data;
    }

}