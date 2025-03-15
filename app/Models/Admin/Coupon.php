<?php

namespace App\Models\Admin;

use App\Lib\General;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'ds_coupan';
    protected $fillable = [];
    protected $hidden = [];

    public static function getCoupon(){
        $category = self::with('sub_category')->where('status',1)->get()->toArray();
        // dd($category);
        $data = [];
        foreach ($category as $c) {
            $temp[$c['name']] = array();
            foreach ($c['sub_category'] as $sc) {
                $temp2 = [];
                $temp2['name'] = $sc['name'];
                $temp2['id'] = $sc['id'];
                array_push($temp[$c['name']],$temp2);
            }
        }
        array_push($data,$temp);
        // dd($data);
        return $data;
    }
    
    public static function filter($param)
    {
        $obj = self::orderBy('id', 'desc');
        
        $count = $obj->count();
        $len = $param['itemPerPage'];
        $start = ($param['currentPage'] - 1) * $len;
        $data = $obj->skip($start)->take($len)->get()->toArray();
        $res = \General::success_res();
        $res['data'] = $data;
        $res['start'] = $start;
        $res['total_record'] = $count;
        return $res;
    }
    
    public static function addCoupon($param)
    {
        $obj = new self;
        $obj->coupon_code=$param['coupon_name'];
        $obj->coupon_type=$param['coupon_type'];
        $obj->coupon_for=$param['coupon_for'];
        if($param['coupon_for'] == 1)
            $obj->customer_mobile_no=$param['coupon_for_customer'];
        $obj->discount_type=$param['discount_type'];
        $obj->amount=$param['discount'];
        $obj->order_min_amount=$param['min_amount'];
        $obj->up_to_amount=$param['up_to_amount'];
        $obj->expiry_date=$param['expiry_date'];
        if(isset($param['status'])){
            $obj->status=1;
        }else{
            $obj->status=0;
        }
        $obj->quantity=$param['quantity'];
        $obj->coupon_note=$param['coupon_note'];
        $obj->is_deleted=0;
        $obj->save();
        return \General::success_res('Coupon added successfully.');
    }
   
    public static function updateCoupon($param)
    {
        $obj = self::where('id',$param['update_id'])->first();
        $obj->coupon_type=$param['coupon_type'];
        $obj->coupon_for=$param['coupon_for'];
        if($param['coupon_for'] == 1)
            $obj->customer_mobile_no=$param['coupon_for_customer'];
        $obj->discount_type=$param['discount_type'];
        if($obj->discount_type != 1){
            $param['up_to_amount'] = null;
        }
        $obj->amount=$param['discount'];
        $obj->order_min_amount=$param['min_amount'];
        $obj->up_to_amount=$param['up_to_amount'];
        $obj->expiry_date=$param['expiry_date'];
        if(isset($param['status'])){
            $obj->status=1;
        }else{
            $obj->status=0;
        }
        $obj->quantity=$param['quantity'];
        $obj->coupon_note=$param['coupon_note'];
        $obj->save();
        return \General::success_res('Coupon update successfully.');
    }
    public static function validateCoupon($param){
        $obj = self::where('coupon_code',$param['coupon_code'])->where('is_deleted',0)->first();
        if($obj != null){
            return \General::error_res('Coupon code not valid! Try another.');
        }
        return \General::success_res('Valid');
    }

    public static function checkApplicable($param){
        $coupon = self::where('coupon_code', $param['coupon_code'])
                    ->where('is_deleted',0)->where('status',1)
                    ->where('expiry_date', '>=', date('Y-m-d'))
                    ->where('quantity','>',0)->first();
                    
        if($coupon){
            if($coupon->coupon_used >= $coupon->quantity){
                return General::error_res('Invalid coupon code.');
            }
            if($coupon->coupon_for == 1){
                if (\Auth::guard('user')->check()) {
                    $user_id = \Auth::guard('user')->id();
                    $userDetail = User::where('id',$user_id)->first();
                    if($userDetail){
                        if($coupon->customer_mobile_no != $userDetail->number){
                            return General::error_res('Invalid Coupon code.');
                        }
                    }
        
                }
            }

            if($coupon->order_min_amount != null){
                $total = 0;
                $diamond = 0;
                $making = 0;
                if(isset($param['cartData'])){
                    if($param['cartData'] != '' && !empty($param['cartData'])){
                        foreach($param['cartData'] as $item){
                            if(isset($item['quantity'])){
                                $total += ($item['product_price_without_discount'] * $item['quantity']);
                            } else {
                                $total += ($item['product_price_without_discount']);
                            }
                            if(isset($item['diamond_buy_price'])){
                                if(isset($item['quantity'])){
                                    $diamond += ($item['diamond_buy_price'] * $item['quantity']);
                                } else {
                                    $diamond += ($item['diamond_buy_price']);
                                }
                            }
                            if(isset($item['product_making_charge'])){
                                if(isset($item['quantity'])){
                                    $making += ($item['product_making_charge'] * $item['quantity']);
                                } else {
                                    $making += ($item['product_making_charge']);
                                }
                            }
                        }
                        if($total <= $coupon->order_min_amount){
                            $rs = $coupon->order_min_amount - $total;
                            return General::error_res("Add items worth Rs.$rs more to apply this coupon.");
                        }
                        if($coupon->coupon_type == 1){
                            if($diamond == 0 || $diamond == ''){
                                return General::error_res("Coupon applicable on only diamond products.");
                            }
                        } elseif($coupon->coupon_type == 2){
                            if($diamond == 0 || $diamond == ''){
                                return General::error_res("Coupon applicable on only making charges.");
                            }
                        }
                    } else {
                        return General::error_res('Coupon not applicable.');
                    }
                } else {
                    return General::error_res('Coupon not applicable.');
                }
            }

            $res = General::success_res('Coupon Applied Successfully');
            $res['data'] = array(
                'couponCode' => $coupon->coupon_code,
                'discountAmount' => $coupon->amount,
                'discountType' => $coupon->discount_type,
                'couponType' => $coupon->coupon_type,
                'min_amount' => $coupon->order_min_amount,
                'up_to_amount' => $coupon->up_to_amount,
                'coupon_note' => $coupon->coupon_note
            );
            return $res;

        }
        return General::error_res('Invalid coupon code.');



    }

}
