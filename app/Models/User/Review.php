<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;
use \App\Lib\General;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\returnSelf;

class Review extends Eloquent
{

    public $table = 'review';
    protected $hidden = [];
    protected $fillable = array();


    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_sku', 'product_sku');
    }


    public function user()
    {
        return $this->hasOne('App\Models\User\User', 'id', 'user_id');
    }
    public function order()
    {
        return $this->hasOne('App\Models\User\DSOrderDetails', 'id', 'order_detail_id');
    }
    public function propduct()
    {
        return $this->hasOne('App\Models\Admin\Product', 'product_sku', 'product_sku');
    }

    public function getImage1Attribute($value = "")
    {

        if ($value == "" || $value == null) {
            return config('constant.USER_DUMMY_PROFILE_LINK');
        }
        if (filter_var($value, FILTER_VALIDATE_URL) === false) {
            if ($value)
                return url('/public/' . config('constant.PRODUCT_REVIEW_LINK') . '/' . $value . '');
            else
                return config('constant.USER_DUMMY_PROFILE_LINK');
        } else {
            return $value;
        }
    }
    public function getImage2Attribute($value1 = "")
    {

        if ($value1 == "" || $value1 == null) {
            return config('constant.USER_DUMMY_PROFILE_LINK');
        }
        if (filter_var($value1, FILTER_VALIDATE_URL) === false) {
            if ($value1)
                return url('/public/' . config('constant.PRODUCT_REVIEW_LINK') . '/' . $value1 . '');
            else
                return config('constant.USER_DUMMY_PROFILE_LINK');
        } else {
            return $value1;
        }
    }

    public static function filter($param)
    {
        $obj = self::with('propduct', 'order', 'user')->orderBy('id', 'desc');

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

    public static function add_user_review($param)
    {
        $userid = \Auth()->guard('user')->id();
        $review = new self;
        $orderDetail = \App\Models\User\DSOrderDetails::with('order')->where('id', $param['order_id'])->first();

        if (is_null($orderDetail)) return General::error_res('Something went wrong.!');

        if ($orderDetail['order']['user_id'] != $userid) return General::error_res('Something went wrong.!!');

        if (request()->hasFile('image1')) {
            $file = request()->file('image1');
            $ext = $file->getClientOriginalExtension();
            $randomName = substr(md5(mt_rand()), 0, 5);
            $image_name = $randomName . time() . "." . $ext;
            if (!$file->move(public_path(config('constant.PRODUCT_REVIEW_LINK')), $image_name)) {
                return General::error_res('Something wrong with uploading Review image.!');
            }

            $review->image1 = (string)$image_name;
        }

        if (request()->hasFile('image2')) {
            $file2 = request()->file('image2');
            $ext2 = $file2->getClientOriginalExtension();
            $randomName2 = substr(md5(mt_rand()), 0, 5);
            $image_name2 = $randomName2 . time() . "." . $ext2;
            if (!$file2->move(public_path(config('constant.PRODUCT_REVIEW_LINK')), $image_name2)) {
                return General::error_res('Something wrong with uploading Review image.!');
            }
            $review->image2 = (string)$image_name2;
        }
        $review->review = $param['title'];
        $review->user_id = $userid;
        $review->rating = $param['rating'];
        $review->product_sku = $orderDetail['product_sku'];
        $review->description = $param['description'];
        $review->order_detail_id = $param['order_id'];
        $review->status = 0;
        $review->type = 0;

        if ($review->save()) {
            return General::success_res('Review updated successfully');
        }

        return General::error_res('Something went wrong.!!!');
    }

    public static function add_admin_review($param)
    {
        $review = new self;
        if (request()->hasFile('image1')) {
            $file = request()->file('image1');
            $ext = $file->getClientOriginalExtension();
            $randomName = substr(md5(mt_rand()), 0, 5);
            $image_name = $randomName . time() . "." . $ext;
            if (!$file->move(public_path(config('constant.PRODUCT_REVIEW_LINK')), $image_name)) {
                return General::error_res('Something wrong with uploading Review image.!');
            }

            $review->image1 = (string)$image_name;
        }

        if (request()->hasFile('image2')) {
            $file2 = request()->file('image2');
            $ext2 = $file2->getClientOriginalExtension();
            $randomName2 = substr(md5(mt_rand()), 0, 5);
            $image_name2 = $randomName2 . time() . "." . $ext2;
            if (!$file2->move(public_path(config('constant.PRODUCT_REVIEW_LINK')), $image_name2)) {
                return General::error_res('Something wrong with uploading Review image.!');
            }
            $review->image2 = (string)$image_name2;
        }
        $review->review = $param['title'];
        $review->user_id = 1;
        $review->rating = $param['rating'];
        $review->product_sku = $param['product_sku'];
        $review->description = $param['description'];
        $review->order_detail_id = null;
        $review->type = 1;

        if ($review->save()) {
            return General::success_res('Review created successfully');
        }

        return General::error_res('Something went wrong.!');
    }

    public static function updateReview($product_sku)
    {
        $totalReviews = 0;
        $avgRating = 0;
        $reviews = self::where('product_sku', $product_sku)->where('status', 1  )->get();
        $totalReviews = $reviews->count();
        $reviews = $reviews->toArray();
        $total_ratings = 0;

        foreach ($reviews as $review) 
            $total_ratings += $review['rating'];
        if($totalReviews < 1) return \General::error_res('No reviews found');
        $avgRating = $total_ratings / $totalReviews;
        $avgRating = (int)round($avgRating);

        $product = Product::where('product_sku', $product_sku)->update(['total_reviews' => $totalReviews, 'avg_rating' => $avgRating]);
        return \General::success_res('review updated');
    }
}
