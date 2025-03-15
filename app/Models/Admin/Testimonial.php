<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Testimonial extends \Eloquent
{
    protected $table = 'testimonial';

    public $timestamps = true;
    protected $hidden = [];

    public function getTestimonialImageAttribute($value = "")
    {
        if ($value == "" || $value == null) {
            return url('public/assets/img/slider-1.png');
        }
        if (filter_var($value, FILTER_VALIDATE_URL) === false) {
            if ($value)
                return url('public/'.config('constant.TESTIMONIAL_IMAGE_PATH').$value);
            else
                return url('public/assets/img/slider-1.png');
        } else {
            return $value;
        }
    }
    public static function addTestimonial($param)
    {
        try {
            $res = \General::success_res('Add Testimonial successfully.');
            $testimonial = new self;
            if (request()->hasFile('testimonial_image')) {
                $image =request()->file('testimonial_image');
                $destinationPath = public_path(config('constant.TESTIMONIAL_IMAGE_PATH'));
                $file_name = time() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $file_name);
                $testimonial->testimonial_image=$file_name;
            }
            $testimonial->client_name=$param['client_name'];
            $testimonial->designation=$param['designation'];
            $testimonial->rating=$param['rating'];
            $testimonial->msg=$param['msg'];
            if ($testimonial->save()) {
                return $res;
            } else {
                return \General::error_res('somethings went wrong.');
            }
        } catch (Exception $e) {
            return \General::error_res('somethings went wrong.');
        }
    }
    public static function filter($param)
    {
        $testimonial = self::latest('id', 'desc');
        $count = $testimonial->count();
        $len = $param['itemPerPage'];
        $start = ($param['currentPage'] - 1) * $len;
        $testimonial = $testimonial->skip($start)->take($len)->get()->toArray();
        $res['data'] = $testimonial;
        $res['total_record'] = $count;
        return $res;
    }
    public static function updateTestimonial($param)
    {
        $testimonial = self::find($param['id']);
        if (request()->hasFile('testimonial_image')) {
            $image =request()->file('testimonial_image');
            $destinationPath = public_path(config('constant.TESTIMONIAL_IMAGE_PATH'));
            $file_name = time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $file_name);
            $testimonial->testimonial_image= $file_name;
        }
        $testimonial->client_name=$param['client_name'];
        $testimonial->designation=$param['designation'];
        $testimonial->rating=$param['rating'];
        $testimonial->msg=$param['msg'];
        $testimonial->save();
        return \General::success_res('update Testimonial successfully.');
    }
    public static function get_all()
    {
        $data = self::orderBy('id','desc')->get();
        if ($data->isEmpty()) {
            $data =  [];
        } else {
            $data =  $data->toArray();
        }
        return $data;
    }
}
