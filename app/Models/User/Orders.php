<?php

namespace App\Models\User;

use App\Lib\General;
use App\Models\Admin\Coupon;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;


class Orders extends Eloquent
{

    public $table = 'orders';
    protected $hidden = [];
    protected $fillable = array();

    public function scopeActive($query)
    {
        return $query->where('expire_time', '>', Carbon::now()->timestamp);
    }

    public function productInfo()
    {
        return $this->hasOne('App\Models\Admin\Product', 'product_sku', 'product_sku');
    }
    public function billingAddress()
    {
        return $this->hasOne('App\Models\User\UserAddress', 'id', 'billing_address_id');
    }
    public function shippingAddress()
    {
        return $this->hasOne('App\Models\User\UserAddress', 'id', 'shipping_address_id');
    }
    public function review()
    {
        return $this->hasOne('App\Models\User\Review', 'order_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public static function generate_order_id()
    {
        static $call_cnt = 0;
        if ($call_cnt > 10)
            return "";
        ++$call_cnt;
        $order_id = \General::rand_otp(10);
        $order = self::where('order_id', $order_id)->first();
        if (isset($order->order_id)) {
            return self::generate_order_id();
        }
        return $order_id;
    }

    public static function getOrdersByUser($param)
    {
        $obj = self::where('user_id', $param['user_id'])->orderBy('id', 'desc');

        if (isset($param['user_order_status'])) {
            $obj->where('order_status', $param['user_order_status']);
        }
        if (isset($param['order_id'])) {
            $obj->where('order_id', $param['order_id']);
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
    public static function checkOrderId($order_id)
    {
        $order = self::where('order_id', $order_id)->first();
        if (isset($order->id)) return \General::success_res('order id found');
        return \General::error_res('Invalid order id');
    }

    public static function createOrder($param)
    {

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

        $order = new self;
        $order->order_id = self::generate_order_id(); // create a functionality to generate random and unique order id;
        $order->user_id = $param['user_id'];
        $order->mobile_no = $param['b_phone_number'];
        $order->billing_address_id = $billingAddress['data']['id'];
        if (!isset($param['same_shipping']))
            $order->shipping_address_id = $shipppingAddress['data']['id'];
        else
            $order->shipping_address_id = $billingAddress['data']['id'];

        $order->product_sku = $param['product_sku'];
        $order->product_color = config('constant.COLOR.' . $param['color']);
        $order->product_size = $param['size'] ? $param['size'] : null;
        $order->product_diamond_quality = $param['diamond_quality'];
        $order->product_gold_quality = $param['gold_carat'];
        $order->product_gold_weight = $param['gold_weight'];
        $order->order_type = $param['order_type'];
        if ($param['order_type'] == 'preset') {
            $order->solitaire_preset_quality = $param['selected_solitaire_preset'];
            $order->solitaire_preset_carat = $param['selected_solitaire_carat'];
            $order->product_solitaire_price = $param['sessionData']['selected_solitaire_price'];
            $order->solitaire_preset_qty = $param['selected_solitaire_quantity'];
        }

        $session = Session::get('checkoutProduct');
        $discountAmount = 0;
        $coupanCode = null;
        if (isset($param['sessionData']['coupon_discount_amount'])) {
            $discountAmount = $param['sessionData']['coupon_discount_amount'];
            $coupanCode = $param['sessionData']['coupon_code'];
        }
        $gstAmount = $param['sessionData']['gst_amount'];
        // $gstAmount = intval(($param['final_amount'] * 3)/100);
        // if(isset($session['coupon_code'])){
        //     $coupon = Coupon::where('coupon',$session['coupon_code'])->where('status',1)->where('expiry_date','>=',date('Y-m-d'))->first();
        //     if(is_null($coupon)) return General::error_res('Invalid coupon code.');
        //     $coupon = $coupon->toArray();
        //     // dd($coupon);
        //     if($coupon['discount_type'] == config('constant.DISCOUNT.PERCENTAGE')){
        //         $discountAmount = intval(($param['final_amount'] * $coupon['amount']) / 100);
        //         $gstAmount = intval((($param['final_amount'] - $discountAmount) * 3)/100);
        //     }else{
        //         $discountAmount = $coupon['amount'];
        //         $gstAmount = intval((($param['final_amount'] -  $discountAmount) * 3)/100);
        //     }
        // }
        if (isset($param['sessionData']['stone_price'])) {
            if ($param['sessionData']['stone_price'] != '') {
                $order->product_stone_amount = $param['sessionData']['stone_price'];
            }
        }

        $order->product_diamond_price = $param['sessionData']['selected_diamond_price'];
        $order->product_gold_price = $param['sessionData']['selected_gold_price'];
        $order->product_making_charges = $param['sessionData']['selected_making_charge'];
        $gstAmount = $param['sessionData']['gst_amount'];
        $order->product_gst_amount = $gstAmount;
        $order->product_net_amount = $param['final_amount'] + $discountAmount;
        $order->product_final_amount = $param['final_amount'] - $discountAmount;
        $order->order_status = 0;
        $order->payment_status = 0;
        $order->discount_amount = $discountAmount;
        $order->coupon_code = $coupanCode;
        if ($param['is_chain'] == 'yes') {
            $order->is_chain = 1;
            $order->chain = $param['sessionData']['chain'];
        }
        if (isset($param['solitaire'])) {
            $order->solitaire = $param['solitaire'];
            $sol = json_decode($param['solitaire'], true);
            if (isset($sol[0])) {
                $order->solitaire_cert_no = $sol[0]['CertNo'];
                $order->solitaire_cert_no2 = $sol[1]['CertNo'];
            } else {
                $order->solitaire_cert_no = $sol['CertNo'];
            }
        } else {
            $order->solitaire = null;
        }
        $order->transaction_id = null;
        $order->expected_delivery_date = $param['expected_delivery_date'];
        $order->pan_no = $param['pannumber'] ?? null;
        if ($order->save()) {
            $res = \General::success_res('Order creating');
            $res['data']['order_id'] = $order->order_id;
        }
        Session::forget('checkoutProduct');
        Session::put('order_id',  $order->order_id);
        Session::put('user_id',  $param['user_id']);
        return $res;
    }

    public static function verifyProduct($param) {}

    public static function getOrderDetail($order_id)
    {
        $res = \General::error_res('Order not found');
        $orderDetail = self::with('billingAddress', 'shippingAddress', 'productInfo', 'review')->where('order_id', $order_id)->first();
        if (isset($orderDetail->id)) {
            $res = \General::success_res();
            $res['data']['orderDetail'] = $orderDetail->toArray();
        }
        return $res;
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
        if (isset($param['admin_product_name'])) {
            $obj->where('product_sku', $param['admin_product_name']);
        }
        // Apply filter by order creation date range
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

    public static function updateOrderStatus($param)
    {
        $obj = self::where('id', $param['update_id'])->first();
        $obj->order_status = $param['order_status'];
        $obj->save();
        return \General::success_res('Order status update successfully.');
    }
}
