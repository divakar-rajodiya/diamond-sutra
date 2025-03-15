<?php 
 
namespace App\Models\User;    
use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;

class UserAddress extends Eloquent {
    
    public $table = 'user_address';
    protected $hidden = [];
    protected $fillable = array();

    public function scopeActive($query) {
        return $query->where('status',1);
    }
    
    public function userInfo(){
        return $this->hasOne('App\Models\Users','id','user_id');
    }

    public static function saveUserAddress($param){
        $res = \General::error_res('Something went wrong!');
        $address = new self;
        $address->user_id = $param['user_id'];
        $address->first_name = $param['fname'];
        $address->last_name = $param['lname'];
        $address->mobile_no = $param['phone_number'];
        $address->email = $param['email'];
        $address->address = $param['address'];
        $address->landmark = $param['landmark'];
        $address->city = $param['city'];
        $address->state = $param['state'];
        $address->country = $param['country'];
        $address->pincode = $param['pincode'];
        $address->address_type = $param['address_type'];

        if($address->save()) {
            $res = \General::success_res(); 
            $res['data']['id'] = $address->id;
        }
        return $res;
    }

}