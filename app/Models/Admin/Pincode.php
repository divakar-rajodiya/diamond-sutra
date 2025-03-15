<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    use HasFactory;
    protected $table = 'pincode';
    protected $fillable = [];
    public $timestamps = false;
    protected $hidden = [];


    public static function filter($param)
    {
        $obj = self::orderBy('id', 'desc');
        
        if (isset($param['pincode']) && $param['pincode'] != '') {
            $obj->where('pincode', $param['pincode']);
        }
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
}
