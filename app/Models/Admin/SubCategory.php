<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_category';
    protected $fillable = [];
    public $timestamps = false;
    protected $hidden = [];

    public function category(){
        return $this->hasOne('App\Models\Admin\Category','id','category_id');
    }

    public static function getSubCategory(){
        return self::with('category')->get()->toArray();
    }
    public static function get_subcategory_by_category_id($category_id = false){
        if($category_id)
            $data = self::where('category_id',$category_id)->get()->toArray();
        else    
            $data = self::get()->toArray();
        return $data;
    }

    public static function filter($param)
    {
        $obj = self::with('category')->orderBy('id', 'desc');
        
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

    public static function addSubCategory($param)
    {
        $obj = new self;
        $obj->name=$param['name'];
        $obj->category_id=$param['category_id'];
        $obj->save();
        return \General::success_res('Sub category add successfully.');
    }

    public static function updateSubCategory($param)
    {
        $obj = self::where('id',$param['update_id'])->first();
        $obj->name=$param['name'];
        $obj->category_id=$param['category_id'];
        $obj->save();
        return \General::success_res('SubCategory update successfully.');
    }

}
