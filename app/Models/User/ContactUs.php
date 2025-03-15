<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    protected $table = 'contact_us';
    protected $fillable = [];
    protected $hidden = [];

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

    public static function StoreData($param)
    {
        $obj = new self;
        $obj->name=$param['name'];
        $obj->email=$param['email'];
        $obj->message=$param['msg'];
        $obj->save();
        return \General::success_res('Thank you for contact us we will reach you soon.');
    }
}
