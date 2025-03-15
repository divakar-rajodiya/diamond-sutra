<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = [];
    protected $hidden = [];

    public function sub_category(){
        return $this->hasMany('\App\Models\Admin\SubCategory','category_id','id');
    }

    public static function getCategory(){
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
    
    public static function getAllCategory(){
        return self::where('status',1)->get()->toArray();
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
    
    public static function addCategory($param)
    {
        $obj = new self;
        $obj->name=$param['name'];
        if(isset($param['status'])){
            $obj->status=1;
        }else{
            $obj->status=0;
        }
        $obj->save();
        return \General::success_res('Category add successfully.');
    }
   
    public static function updateCategory($param)
    {
        $obj = self::where('id',$param['update_id'])->first();
        $obj->name=$param['name'];
        if(isset($param['status'])){
            $obj->status=1;
        }else{
            $obj->status=0;
        }
        $obj->save();
        return \General::success_res('Category update successfully.');
    }

}
