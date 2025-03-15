<?php

namespace App\Models\User;

use App\Lib\General;
use App\Models\Admin\Coupon;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;


class DSOrders extends Eloquent {

    public $table = 'ds_orders';
    protected $hidden = [];
    protected $fillable = array();

    public function scopeActive($query) {
        return $query->where('expire_time', '>', Carbon::now()->timestamp);
    }

    public function billingAddress(){
        return $this->hasOne('App\Models\User\UserAddress','id','billing_address_id');
    }
    public function shippingAddress(){
        return $this->hasOne('App\Models\User\UserAddress','id','shipping_address_id');
    }
    public function orderDetail(){
        return $this->hasMany('App\Models\User\DSOrderDetails','ds_order_id','id')->with('productInfo','review');
    }
    

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public static function generate_order_id()
    {
        static $call_cnt = 0;
        if($call_cnt > 10)
            return "";
        ++$call_cnt;
        $order_id = \General::rand_otp(10);
        $order = self::where('order_id',$order_id)->first();
        if(isset($order->order_id))
        {
            return self::generate_order_id();
        }
        return $order_id;
    }

    public static function filter($param)
    {
        $obj = self::with('user', 'billingAddress', 'shippingAddress');
        
        if (isset($param['admin_order_status'])) {
            $obj->where('order_status', $param['admin_order_status']);
        }
        if (isset($param['admin_order_id'])) {
            $obj->where('order_id', $param['admin_order_id']);
        }
        // Apply filter by order creation date range
        // dd($param);
        if (isset($param['order_from_date']) && isset($param['order_to_date'])) {
            $obj->whereDate('created_at', '>=', $param['order_from_date'])
                ->whereDate('created_at', '<=', $param['order_to_date']);
        } else if (isset($param['order_from_date'])) {
            $obj->whereDate('created_at', '>=', $param['order_from_date']);
        } else if (isset($param['order_to_date'])) {
            $obj->whereDate('created_at', '<=', $param['order_to_date']);
        }

        $obj->orderBy('id', 'desc');

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

    public static function getOrdersByUser($param){

        $obj = self::with('orderDetail')->where('user_id',$param['user_id'])->orderBy('id','desc');

        if(isset($param['user_order_status'])){
             $obj->where('order_status',$param['user_order_status']);  
        }
        if(isset($param['order_id'])){
             $obj->where('order_id',$param['order_id']);  
        }
        
        $obj->orderBy('id', 'desc');
        
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

    public static function getOrderDetail($order_id){
        $res = \General::error_res('Order not found');
        $orderDetail = self::with('billingAddress','shippingAddress','orderDetail')->where('order_id',$order_id)->first();
        if(isset($orderDetail->id)){
            $orderDetail = $orderDetail->toArray();
            $res = \General::success_res();
            $res['data']['orderDetail'] =  $orderDetail;
        }
        // dd($res);
        return $res;
    }


    public static function checkOrderId($order_id){
        $order = self::where('order_id',$order_id)->first();
        if(isset($order->id)) return \General::success_res('order id found');
        return \General::error_res('Invalid order id');
    }

    public static function createOrder($param)
    {
        $settings = app('settings');
        
        $res = \General::error_res('Something went wrong!');
        $address['user_id'] = $param['user_id'];
        $address['fname'] = $param['b_fname'];
        $address['lname'] = $param['b_lname'];
        $address['phone_number'] = $param['b_phone_number'];
        $address['email'] = $param['b_email'];
        $address['address'] = $param['b_address'];
        $address['landmark'] = isset($param['b_landmark']) ? $param['b_landmark'] : null;
        $address['city'] = $param['b_city'];
        $address['state'] = $param['b_state'];
        $address['country'] = isset($param['b_country']) ? $param['b_country'] : null;
        $address['pincode'] = $param['b_pincode'];
        $address['address_type'] = 'billing';
        if (isset($param['same_shipping']))
            $address['address_type'] = 'both';

        $billingAddress = UserAddress::saveUserAddress($address);

        if ($billingAddress['flag'] != 1) return $billingAddress;

        if (!isset($param['same_shipping'])) {
            $address['user_id'] = $param['user_id'];
            $address['fname'] = $param['s_fname'];
            $address['lname'] = $param['s_lname'];
            $address['phone_number'] = $param['s_phone_number'];
            $address['email'] = $param['s_email'];
            $address['address'] = $param['s_address'];
            $address['landmark'] = isset($param['s_landmark']) ? $param['s_landmark'] : null;
            $address['city'] = $param['s_city'];
            $address['state'] = $param['s_state'];
            $address['country'] = isset($param['s_country']) ? $param['s_country'] : null;
            $address['pincode'] = $param['s_pincode'];
            $address['address_type'] = 'shipping';

            $shipppingAddress = UserAddress::saveUserAddress($address);

            if ($shipppingAddress['flag'] != 1) return $shipppingAddress;
        }

        $items_quantity = 0;
        foreach ($param['sessionData']['order_items'] as $orderItem) {
            $items_quantity += $orderItem['quantity'];
        }

        $order = new self;
        $order->order_id = self::generate_order_id(); // create a functionality to generate random and unique order id;
        $order->user_id = $param['user_id'];
        $order->mobile_no = $param['b_phone_number'];
        $order->expected_delivery_date = $param['expected_delivery_date'];
        $order->billing_address_id = $billingAddress['data']['id'];
        if (!isset($param['same_shipping']))
            $order->shipping_address_id = $shipppingAddress['data']['id'];
        else
            $order->shipping_address_id = $billingAddress['data']['id'];

        $order->item_quantity = $items_quantity;
        $order->item_total = $param['sessionData']['item_total'];
        $order->order_total = $param['sessionData']['order_total'];
        $order->gst_total = $param['sessionData']['gst_total'];
        $order->discount_total = $param['sessionData']['discount_total'];
        $order->total_saving = $param['sessionData']['discount_total'];
        $order->coupon_code = $param['sessionData']['coupon_code'];
        $order->pan_no = $param['pannumber'] ?? null;

        if ($order->save()) {
            foreach ($param['sessionData']['order_items'] as $orderItem) {

                $orderdetail = new DSOrderDetails();
                $orderdetail->ds_order_id = $order->id;

                if(isset($orderItem['item_type'])){
                    if ($orderItem['item_type'] == 'primary') {
                        $orderdetail->product_type = 0;
                    } else {
                        $orderdetail->product_type = 1;
                    }
                } else {
                    $orderdetail->product_type = 0;
                }

                if (isset($orderItem['mount_id']))
                    $orderdetail->mount_id = $orderItem['mount_id'];

                if (isset($orderItem['binded']))
                    $orderdetail->binded = $orderItem['binded'];
            
                if ($orderItem['product_type'] == 'product')
                    $orderdetail->product_type = 0;
                elseif ($orderItem['product_type'] == 'solitaire_setting')
                    $orderdetail->product_type = 1;
                elseif ($orderItem['product_type'] == 'solitaire')
                    $orderdetail->product_type = 2;
                elseif ($orderItem['product_type'] == 'solitaire_pair')
                    $orderdetail->product_type = 3;
                elseif ($orderItem['product_type'] == 'loose_solitaire')
                    $orderdetail->product_type = 4;
                elseif ($orderItem['product_type'] == 'loose_solitaire_pair')
                    $orderdetail->product_type = 5;

                if ($orderItem['product_type'] == 'product' || $orderItem['product_type'] == 'solitaire_setting') {
                    $orderdetail->product_sku = $orderItem['sku'];
                    $orderdetail->product_color = $orderItem['color'];
                    $orderdetail->product_size = $orderItem['size'] ? $orderItem['size'] : null;
                    $orderdetail->quantity = $orderItem['quantity'];
                    $orderdetail->product_gold_quality = $orderItem['goldCarat'];
                    $orderdetail->product_gold_weight = $orderItem['gold_weight'];

                    if ($orderItem['solitaire'] != null) {
                        $orderdetail->solitaire_preset_quality = $orderItem['solitaire'];
                        $orderdetail->solitaire_preset_qty = 1;
                    }

                    if ($orderItem['solitaireCarat'] != null)
                        $orderdetail->solitaire_preset_carat = $orderItem['solitaireCarat'];

                    if ($orderItem['preset_solitaire_price'] > 0) {
                        $orderdetail->preset_solitaire_price = $orderItem['preset_solitaire_price'];
                    }

                    if ($orderItem['diamond'] != '') {
                        $orderdetail->product_diamond_quality = $orderItem['diamond'];
                    }
                    if ($orderItem['diamond_buy_price'] > 0) {
                        $orderdetail->product_diamond_price = $orderItem['diamond_buy_price'];
                    }

                    if ($orderItem['goldCarat']) {
                        $orderdetail->product_gold_quality = $orderItem['goldCarat'];
                        $orderdetail->product_gold_weight = $orderItem['gold_weight'];
                        $rateKey = 'gold_rate_'.$orderItem['goldCarat'].'k';
                        $orderdetail->gold_rate = $settings[$rateKey];
                    }
                    if ($orderItem['gold_price'] > 0) {
                        $orderdetail->product_gold_price = $orderItem['gold_price'];
                    }
                    $orderdetail->product_making_charges = $orderItem['product_making_charge'];
                    $orderdetail->product_stone_price = $orderItem['stone_price'];
                    $orderdetail->product_gst_amount = $orderItem['product_gst'];
                    $orderdetail->product_price_taxable = $orderItem['product_price_taxable'];
                    $orderdetail->product_buy_price = $orderItem['product_buy_price_with_gst'];
                    $orderdetail->product_diamond_discount = $orderItem['diamond_discount_amount'];
                    $orderdetail->product_making_discount = $orderItem['making_discount_amount'];
                    $orderdetail->product_coupon_discount = $orderItem['coupon_discount'];
                    $orderdetail->total_product_discount = $orderItem['coupon_discount'] + 
                                    $orderItem['making_discount_amount'] + 
                                    $orderItem['diamond_discount_amount'];
                    

                } elseif (
                    $orderItem['product_type'] == 'loose_solitaire' ||
                    $orderItem['product_type'] == 'loose_solitaire_pair' ||
                    $orderItem['product_type'] == 'solitaire' ||
                    $orderItem['product_type'] == 'solitaire_pair'
                ) {
                    $orderdetail->solitaire_cert_no = $orderItem['CertNo'];
                    $orderdetail->solitaire_price_inr = $orderItem['product_price_taxable'];
                    $orderdetail->product_price_taxable = $orderItem['product_price_taxable'];
                    $orderdetail->product_gst_amount = $orderItem['product_gst'];
                    $orderdetail->product_buy_price = $orderItem['product_buy_price_with_gst'];
              
                    $orderdetail->product_coupon_discount = $orderItem['coupon_discount'];
                    $orderdetail->total_product_discount = $orderItem['coupon_discount'];

                    $orderdetail->solitaire_vendor = $orderItem['apiName'];
                    $orderdetail->solitaire = json_encode($orderItem);
                }

                if ($orderdetail->save()) {
                    $res = \General::success_res('Order creating');
                    $res['data']['order_id'] = $order->order_id;
                    $res['data']['order_amount'] = $param['sessionData']['order_total'];
                }
            }
        }

        Session::forget('checkoutProduct');
        Session::put('order_id',  $order->order_id);
        Session::put('user_id',  $param['user_id']);
        return $res;
    }

    public static function migrateNormalOrder($order){
        if($order){
            $newOrder = new self;
            $newOrder->order_id = $order['order_id'];
            $newOrder->user_id = $order['user_id'];
            $newOrder->mobile_no = $order['mobile_no'];
            $newOrder->billing_address_id = $order['billing_address_id'];
            $newOrder->shipping_address_id = $order['shipping_address_id'];
            $newOrder->order_total = $order['product_final_amount'];
            $newOrder->discount_total = $order['discount_amount'];
            $newOrder->gst_total = $order['product_gst_amount'];
            $newOrder->coupon_code = $order['coupon_code'];
            $newOrder->pan_no = $order['pan_no'];
            $newOrder->dispatch_type = 0;
            $newOrder->order_status = $order['order_status'];
            $newOrder->order_tracking = $order['order_tracking'];
            $newOrder->cancel_reason = $order['cancel_reason'];
            $newOrder->return_reason = $order['return_reason'];
            $newOrder->payment_completion_time = $order['payment_completion_time'];
            $newOrder->expected_delivery_date = $order['expected_delivery_date'];
            $newOrder->payment_status = $order['payment_status'];
            $newOrder->transaction_id = $order['transaction_id'];
            $newOrder->created_at = $order['created_at'];

            if($newOrder->save()){
                $newOrderDetails = new DSOrderDetails;
                $newOrderDetails->ds_order_id = $newOrder->id;
                $newOrderDetails->tracking_id = $order['tracking_id'];
                $newOrderDetails->dispatch_status = $order['order_status'];
                $newOrderDetails->product_type = 0;
                $newOrderDetails->item_type = 0;
                $newOrderDetails->product_sku = $order['product_sku'];
                $newOrderDetails->product_color = $order['product_color'];
                $newOrderDetails->product_size = $order['product_size'];
                $newOrderDetails->solitaire_preset_quality = $order['solitaire_preset_quality'];
                $newOrderDetails->solitaire_preset_carat = $order['solitaire_preset_carat'];
                $newOrderDetails->solitaire_preset_qty = $order['solitaire_preset_qty'];
                $newOrderDetails->preset_solitaire_price = $order['product_solitaire_price'];
                $newOrderDetails->product_diamond_quality = $order['product_diamond_quality'];

                $newOrderDetails->product_gold_quality = $order['product_gold_quality'];
                $newOrderDetails->product_gold_weight = $order['product_gold_weight'];
                $newOrderDetails->product_diamond_price = $order['product_diamond_price'];
                $newOrderDetails->product_gold_price = $order['product_gold_price'];
                $newOrderDetails->product_making_charges = $order['product_making_charges'];
                $newOrderDetails->product_stone_price	 = $order['product_stone_amount'];
                $newOrderDetails->product_gst_amount = $order['product_gst_amount'];
                $newOrderDetails->product_price_taxable = $order['product_final_amount'] - $order['product_gst_amount'];
                $newOrderDetails->product_buy_price = $order['product_final_amount'];
                $newOrderDetails->product_diamond_discount = 0;
                $newOrderDetails->product_making_discount = 0;
                $newOrderDetails->product_coupon_discount = 0;
                $newOrderDetails->total_product_discount = $order['discount_amount'];

                if($newOrderDetails->save()){
                    return \General::success_res('Order id : '.$newOrder->order_id.', Order Type : "Product". maigrated success');
                }
                return \General::error_res('Failed to migrate Order id : '.$newOrder->order_id.', Order Type : "Product');
               
            }
        }
    }

    public static function migratePendantWithChainOrder($order){
        if($order){
            $chain = json_decode($order['chain'],true);
            $newOrder = new self;
            $newOrder->order_id = $order['order_id'];
            $newOrder->user_id = $order['user_id'];
            $newOrder->mobile_no = $order['mobile_no'];
            $newOrder->billing_address_id = $order['billing_address_id'];
            $newOrder->shipping_address_id = $order['shipping_address_id'];
            $newOrder->order_total = $order['product_final_amount'];
            $newOrder->discount_total = $order['discount_amount'];
            $newOrder->gst_total = $order['product_gst_amount'];
            $newOrder->coupon_code = $order['coupon_code'];
            $newOrder->pan_no = $order['pan_no'];
            $newOrder->dispatch_type = 0;
            $newOrder->order_status = $order['order_status'];
            $newOrder->order_tracking = $order['order_tracking'];
            $newOrder->cancel_reason = $order['cancel_reason'];
            $newOrder->return_reason = $order['return_reason'];
            $newOrder->payment_completion_time = $order['payment_completion_time'];
            $newOrder->expected_delivery_date = $order['expected_delivery_date'];
            $newOrder->payment_status = $order['payment_status'];
            $newOrder->transaction_id = $order['transaction_id'];
            $newOrder->created_at = $order['created_at'];

            if($newOrder->save()){
                $orderPendantdetails = new DSOrderDetails;
                $orderPendantdetails->ds_order_id = $newOrder->id;
                $orderPendantdetails->tracking_id = $order['tracking_id'];
                $orderPendantdetails->dispatch_status = $order['order_status'];
                $orderPendantdetails->product_type = 0;
                $orderPendantdetails->item_type = 0;
                $orderPendantdetails->product_sku = $order['product_sku'];
                $orderPendantdetails->product_color = $order['product_color'];
                $orderPendantdetails->product_size = $order['product_size'];
                $orderPendantdetails->solitaire_preset_quality = $order['solitaire_preset_quality'];
                $orderPendantdetails->solitaire_preset_carat = $order['solitaire_preset_carat'];
                $orderPendantdetails->solitaire_preset_qty = $order['solitaire_preset_qty'];
                $orderPendantdetails->preset_solitaire_price = $order['product_solitaire_price'];
                $orderPendantdetails->product_diamond_quality = $order['product_diamond_quality'];

                $orderPendantdetails->product_gold_quality = $order['product_gold_quality'];
                $orderPendantdetails->product_gold_weight = $order['product_gold_weight'];
                $orderPendantdetails->product_diamond_price = $order['product_diamond_price'];
                $orderPendantdetails->product_gold_price = $order['product_gold_price'];
                $orderPendantdetails->product_making_charges = $order['product_making_charges'];
                $orderPendantdetails->product_stone_price	 = $order['product_stone_amount'];
                $orderPendantdetails->product_price_taxable = $order['product_final_amount'] - $order['product_gst_amount'] - $chain['selected_buy_price'];
                $orderPendantdetails->product_gst_amount = ($orderPendantdetails->product_price_taxable * 3) / 100;
                $orderPendantdetails->product_buy_price = $order['product_final_amount'] - $chain['selected_buy_price'];
                $orderPendantdetails->product_diamond_discount = 0;
                $orderPendantdetails->product_making_discount = 0;
                $orderPendantdetails->product_coupon_discount = 0;
                $orderPendantdetails->total_product_discount = 0;

                if($orderPendantdetails->save()){
                    $orderChaindetails = new DSOrderDetails;
                    $orderChaindetails->ds_order_id = $newOrder->id;
                    $orderChaindetails->tracking_id = $order['tracking_id'];
                    $orderChaindetails->dispatch_status = $order['order_status'];
                    $orderChaindetails->product_type = 0;
                    $orderChaindetails->item_type = 1;
                    $orderChaindetails->product_sku = $chain['product_sku'];
                    $orderChaindetails->product_color = $chain['selected_color'];
                    $orderChaindetails->product_size = 16;

                    $orderChaindetails->product_gold_quality = $chain['selected_gold_carat'];
                    $orderChaindetails->product_gold_weight = $chain['selected_gold_weight'];
                    $orderChaindetails->product_gold_price = $chain['selected_gold_price'];
                    $orderChaindetails->product_making_charges = $chain['selected_making_charge'];
                    $orderChaindetails->product_price_taxable = $chain['selected_buy_price'];
                    $orderChaindetails->product_gst_amount = $chain['gst_amount'];
                    $orderChaindetails->product_buy_price = $chain['selected_buy_price'] + $chain['gst_amount'];
                    $orderChaindetails->product_diamond_discount = 0;
                    $orderChaindetails->product_making_discount = 0;
                    $orderChaindetails->product_coupon_discount = 0;
                    $orderChaindetails->total_product_discount = 0;

                    if($orderChaindetails->save()){
                        return \General::success_res('Order id : '.$newOrder->order_id.', Order Type : "Pendant with chain". maigrated success');
                    } else {
                        return \General::error_res('Failed chain migration for Order id : '.$newOrder->order_id.', Order Type : "Pendant with chain"');
                    }
                }
                return \General::error_res('Failed to migrate Order id : '.$newOrder->order_id.', Order Type : "Product');
               
            }
        }
    }

    public static function migratePresetOrder($order){
        if($order){
            $newOrder = new self;
            $newOrder->order_id = $order['order_id'];
            $newOrder->user_id = $order['user_id'];
            $newOrder->mobile_no = $order['mobile_no'];
            $newOrder->billing_address_id = $order['billing_address_id'];
            $newOrder->shipping_address_id = $order['shipping_address_id'];
            $newOrder->order_total = $order['product_final_amount'];
            $newOrder->discount_total = $order['discount_amount'];
            $newOrder->gst_total = $order['product_gst_amount'];
            $newOrder->coupon_code = $order['coupon_code'];
            $newOrder->pan_no = $order['pan_no'];
            $newOrder->dispatch_type = 0;
            $newOrder->order_status = $order['order_status'];
            $newOrder->order_tracking = $order['order_tracking'];
            $newOrder->cancel_reason = $order['cancel_reason'];
            $newOrder->return_reason = $order['return_reason'];
            $newOrder->payment_completion_time = $order['payment_completion_time'];
            $newOrder->expected_delivery_date = $order['expected_delivery_date'];
            $newOrder->payment_status = $order['payment_status'];
            $newOrder->transaction_id = $order['transaction_id'];
            $newOrder->created_at = $order['created_at'];

            if($newOrder->save()){
                $newOrderDetails = new DSOrderDetails;
                $newOrderDetails->ds_order_id = $newOrder->id;
                $newOrderDetails->tracking_id = $order['tracking_id'];
                $newOrderDetails->dispatch_status = $order['order_status'];
                $newOrderDetails->product_type = 1;
                $newOrderDetails->item_type = 0;
                $newOrderDetails->product_sku = $order['product_sku'];
                $newOrderDetails->product_color = $order['product_color'];
                $newOrderDetails->product_size = $order['product_size'];
                $newOrderDetails->quantity = 1;
                $newOrderDetails->solitaire_preset_quality = $order['solitaire_preset_quality'];
                $newOrderDetails->solitaire_preset_carat = $order['solitaire_preset_carat'];
                $newOrderDetails->solitaire_preset_qty = $order['solitaire_preset_qty'];
                $newOrderDetails->preset_solitaire_price = $order['product_solitaire_price'];
                $newOrderDetails->product_diamond_quality = $order['product_diamond_quality'];

                $newOrderDetails->product_gold_quality = $order['product_gold_quality'];
                $newOrderDetails->product_gold_weight = $order['product_gold_weight'];
                $newOrderDetails->product_diamond_price = $order['product_diamond_price'];
                $newOrderDetails->product_gold_price = $order['product_gold_price'];
                $newOrderDetails->product_making_charges = $order['product_making_charges'];
                $newOrderDetails->product_stone_price	 = $order['product_stone_amount'];
                $newOrderDetails->product_gst_amount = $order['product_gst_amount'];
                $newOrderDetails->product_price_taxable = $order['product_final_amount'] - $order['product_gst_amount'];
                $newOrderDetails->product_buy_price = $order['product_final_amount'];
                $newOrderDetails->product_diamond_discount = 0;
                $newOrderDetails->product_making_discount = 0;
                $newOrderDetails->product_coupon_discount = 0;
                $newOrderDetails->total_product_discount = $order['discount_amount'];

                if($newOrderDetails->save()){
                    return \General::success_res('Order id : '.$newOrder->order_id.', Order Type : "Preset". maigrated success');
                }
                return \General::error_res('Failed to migrate Order id : '.$newOrder->order_id.', Order Type : "Product');
               
            }
        }
    }

    public static function migrateSolitaireOrder($order){
        if($order){
            $solitaires = json_decode($order['solitaire'], true); 
            $newOrder = new self;
            $newOrder->order_id = $order['order_id'];
            $newOrder->user_id = $order['user_id'];
            $newOrder->mobile_no = $order['mobile_no'];
            $newOrder->billing_address_id = $order['billing_address_id'];
            $newOrder->shipping_address_id = $order['shipping_address_id'];
            $newOrder->order_total = $order['product_final_amount'];
            $newOrder->discount_total = $order['discount_amount'];
            $newOrder->gst_total = $order['product_gst_amount'];
            $newOrder->coupon_code = $order['coupon_code'];
            $newOrder->pan_no = $order['pan_no'];
            $newOrder->dispatch_type = 0;
            $newOrder->order_status = $order['order_status'];
            $newOrder->order_tracking = $order['order_tracking'];
            $newOrder->cancel_reason = $order['cancel_reason'];
            $newOrder->return_reason = $order['return_reason'];
            $newOrder->payment_completion_time = $order['payment_completion_time'];
            $newOrder->expected_delivery_date = $order['expected_delivery_date'];
            $newOrder->payment_status = $order['payment_status'];
            $newOrder->transaction_id = $order['transaction_id'];
            $newOrder->created_at = $order['created_at'];

            $solitaire1 = null;
            $solitaire2 = null;
            if(isset($solitaires['RefNo'])){
                $solitaire1 = $solitaires;
            } elseif(isset($solitaires['0'])) {
                $solitaire1 = $solitaires[0];
                $solitaire2 = $solitaires[1];
            }

            if($solitaire1 == null && $solitaire2 == null){
                return \General::error_res('Failed migration Order id : '.$newOrder->order_id.', Order Type : "Solitaire".');
            }
            if($newOrder->save()){
                $newOrderDetails = new DSOrderDetails;
                $newOrderDetails->ds_order_id = $newOrder->id;
                $newOrderDetails->tracking_id = $order['tracking_id'];
                $newOrderDetails->dispatch_status = $order['order_status'];
                $newOrderDetails->product_type = 2;
                $newOrderDetails->item_type = 0;
                $newOrderDetails->product_sku = $order['product_sku'];
                $newOrderDetails->product_color = $order['product_color'];
                $newOrderDetails->product_size = $order['product_size'];
                $newOrderDetails->quantity = 1;
                $newOrderDetails->solitaire_preset_quality = $order['solitaire_preset_quality'];
                $newOrderDetails->solitaire_preset_carat = $order['solitaire_preset_carat'];
                $newOrderDetails->solitaire_preset_qty = $order['solitaire_preset_qty'];
                $newOrderDetails->preset_solitaire_price = $order['product_solitaire_price'];
                $newOrderDetails->product_diamond_quality = $order['product_diamond_quality'];

                $newOrderDetails->product_gold_quality = $order['product_gold_quality'];
                $newOrderDetails->product_gold_weight = $order['product_gold_weight'];
                $newOrderDetails->product_diamond_price = $order['product_diamond_price'];
                $newOrderDetails->product_gold_price = $order['product_gold_price'];
                $newOrderDetails->product_making_charges = $order['product_making_charges'];
                $newOrderDetails->product_stone_price	 = $order['product_stone_amount'];
                $newOrderDetails->product_gst_amount = $order['product_gst_amount'];
                $newOrderDetails->product_price_taxable = $order['product_gold_price'] + $order['product_diamond_price'] + $order['product_making_charges'] + $order['product_stone_amount'];
                $newOrderDetails->product_buy_price = $newOrderDetails->product_price_taxable + (($newOrderDetails->product_price_taxable * 3) / 100);
                $newOrderDetails->product_diamond_discount = 0;
                $newOrderDetails->product_making_discount = 0;
                $newOrderDetails->product_coupon_discount = 0;
                $newOrderDetails->total_product_discount = $order['discount_amount'];

                if($newOrderDetails->save()){
                   
                    if($solitaire1 != null){
                        $solitaire1Details = new DSOrderDetails;
                        $solitaire1Details->ds_order_id = $newOrder->id;
                        $solitaire1Details->tracking_id = $order['tracking_id'];
                        $solitaire1Details->dispatch_status = $order['order_status'];
                        $solitaire1Details->product_type = 2;
                        $solitaire1Details->item_type = 1;
                        $solitaire1Details->quantity = 1;
                        $solitaire1Details->solitaire = json_encode($solitaire1);
                        $solitaire1Details->solitaire_cert_no = $solitaire1['CertNo'];
                        $solitaire1Details->solitaire_price_inr = $solitaire1['Price'];
                        $solitaire1Details->product_price_taxable = $solitaire1['Price'];
                        
                        if(!isset($solitaire1['solitaire_gst']))
                            $solitaire1['solitaire_gst'] = round(($solitaire1['Price']*3)/100);
                        
                        $solitaire1Details->product_gst_amount = $solitaire1['solitaire_gst'];
                        $solitaire1Details->product_gst_amount = round(($solitaire1['Price']*3)/100);
                        $solitaire1Details->product_buy_price = $solitaire1['Price'] + $solitaire1['solitaire_gst'];
                        $solitaire1Details->solitaire_vendor = $solitaire1['apiName'];
                        $solitaire1Details->save();
                    }

                    if($solitaire2 != null){
                        $solitaire2Details = new DSOrderDetails;
                        $solitaire2Details->ds_order_id = $newOrder->id;
                        $solitaire2Details->tracking_id = $order['tracking_id'];
                        $solitaire2Details->dispatch_status = $order['order_status'];
                        $solitaire2Details->product_type = 2;
                        $solitaire2Details->item_type = 1;
                        $solitaire2Details->quantity = 1;
                        $solitaire2Details->solitaire = json_encode($solitaire2);
                        $solitaire2Details->solitaire_cert_no = $solitaire2['CertNo'];
                        $solitaire2Details->solitaire_price_inr = $solitaire2['Price'];
                        $solitaire2Details->product_price_taxable = $solitaire2['Price'];

                        if(!isset($solitaire2['solitaire_gst']))
                            $solitaire2['solitaire_gst'] = round(($solitaire2['Price']*3)/100);
                    
                        $solitaire2Details->product_gst_amount = $solitaire2['solitaire_gst'];
                        $solitaire2Details->product_buy_price = $solitaire2['Price'] + $solitaire2['solitaire_gst'];
                        $solitaire2Details->solitaire_vendor = $solitaire2['apiName'];
                        $solitaire2Details->save();
                    }

                    return \General::success_res('Order id : '.$newOrder->order_id.', Order Type : "Preset". maigrated success');
                }
                return \General::error_res('Failed to migrate Order id : '.$newOrder->order_id.', Order Type : "Product');
               
            }
        }
    }

}