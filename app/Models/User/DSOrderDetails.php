<?php

namespace App\Models\User;

use App\Lib\General;
use App\Models\Admin\Coupon;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;


class DSOrderDetails extends Eloquent {

    public $table = 'ds_order_details';
    protected $hidden = [];
    protected $fillable = array();

    public function order(){
        return $this->hasOne('App\Models\User\DSOrders','id','ds_order_id');
    }
    public function orderWithDetail(){
        return $this->hasOne('App\Models\User\DSOrders','id','ds_order_id')->with('user','billingAddress', 'shippingAddress');;
    }
    public function productInfo(){
        return $this->hasOne('App\Models\Admin\Product','product_sku','product_sku');
    }
    public function review(){
        return $this->hasOne('App\Models\User\Review','order_detail_id','id');
    }


    public static function getOrderItemDetail($order_detail_id){
        $res = \General::error_res('Order not found');
        $orderDetail = self::with('orderWithDetail','productInfo','review')->where('id',$order_detail_id)->first();
        if(isset($orderDetail->id)){
            $orderDetail = $orderDetail->toArray();
            $res = \General::success_res();
            $res['data']['orderDetail'] =  $orderDetail;
        }
        // dd($res);
        return $res;
    }

    public static function getItemsByMountId($mountId){
        $res = \General::error_res('Items not found');
        $items = self::with(['productInfo'])->where('mount_id',$mountId)->get()->toArray();
        if($items){
            $res = \General::success_res();
            $res['data']['order_items'] =  $items;
        }
        // dd($res);
        return $res;
    }


}