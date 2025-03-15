<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banner';
    protected $fillable = [];
    protected $hidden = [];

    public function getImageAttribute($value = "")
    {
        // dd($value);
        if ($value == "" || $value == null) {
            return url('public/assets/img/slider-1.png');
        }
        if (filter_var($value, FILTER_VALIDATE_URL) === false) {
            if ($value)
                return url('public/'.config('constant.BANNER_IMAGE_PATH').$value);
            else
                return url('public/assets/img/slider-1.png');
        } else {
            return $value;
        }
    }
    
    
    public function sub_category(){
        return $this->hasMany('\App\Models\Admin\SubCategory', 'category_id', 'id');
    }



    public static function getCategory()
    {
        $category = self::with('sub_category')->where('status', 1)->get()->toArray();
        // dd($category);
        $data = [];
        foreach ($category as $c) {
            $temp[$c['name']] = array();
            foreach ($c['sub_category'] as $sc) {
                $temp2 = [];
                $temp2['name'] = $sc['name'];
                $temp2['id'] = $sc['id'];
                array_push($temp[$c['name']], $temp2);
            }
        }
        array_push($data, $temp);
        // dd($data);
        return $data;
    }

    public static function getAllCategory()
    {
        return self::where('status', 1)->get()->toArray();
    }

    public static function filter($param)
    {
        $obj = self::orderBy('id', 'desc');

        // if (isset($param['sale_type']) && $param['sale_type'] != '') {
        //     $obj->where('sale_type', $param['sale_type']);
        // }
        // if (isset($param['address']) && $param['address'] != '') {
        //     $obj->where('address', $param['address']);
        // }

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

    public static function addBanner($param)
    {
        try {
            $obj = new self;
            
            $dir_path = public_path(config('constant.BANNER_IMAGE_PATH'));
            $images = request()->file('banner_image');
            $images_ext = $images->getClientOriginalExtension();
            $bg_img_name = time() . "." . $images_ext;
            if (!$images->move($dir_path, $bg_img_name)) {
                return \General::error_res("Error In Upload  Image !");
            }
            $obj->image = $bg_img_name;
            $obj->link = $param['link'];
            $obj->sort_order = $param['sort_order'];
            $obj->save();
            return \General::success_res('Banner add successfully.');
        } catch (\Exception $ex) {
            \Log::error('Banner Add error');
            \Log::error($ex);
            return \General::error_res('Something went wrong.');
        }
    }

    public static function updateBanner($param)
    {
        $obj = self::where('id', $param['update_id'])->first();

        if(isset($param['banner_image']) && is_file($param['banner_image'])){
            $dir_path = public_path(config('constant.BANNER_IMAGE_PATH'));

            if (isset($param['banner_image']) && $param['banner_image'] != null) {
                $u_image = public_path(config('constant.BANNER_IMAGE_PATH')) . basename($param['banner_image']);
                unlink($u_image);
            }
            $images = request()->file('banner_image');
            $images_ext = $images->getClientOriginalExtension();
            $bg_img_name = time() . "." . $images_ext;
            if (!$images->move($dir_path, $bg_img_name)) {
                return \General::error_res("Error In Upload  Image !");
            }
            $obj->image = $bg_img_name;
        }
        $obj->link = $param['link'];
        $obj->sort_order = $param['sort_order'];
        
        $obj->save();
        return \General::success_res('Category update successfully.');
    }
}
