<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolitairePrice extends Model
{
    use HasFactory;
    protected $table = 'ds_solitaire_prices';
    protected $fillable = [];
    public $timestamps = false;
    protected $hidden = [];

    public static function solitairePriceChart($category){
        $data = self::get()->toArray();
        $priceChart = array(
            'IJ_SI' => array(),
            'GH_SI' => array(),
            'GH_VS' => array(),
            'EF_VVS' => array()
        );
        $earringPriceChart = array(
            'IJ_SI' => array(),
            'GH_SI' => array(),
            'GH_VS' => array(),
            'EF_VVS' => array()
        );
        foreach($data as $r){
            if(!isset($priceChart[$r['clarity']]['carat'])){
                $priceChart[$r['clarity']][$r['carat']] = $r['price'];
            }
        }
        if($category == 3){
            $earring_carat_sizes = ['0.60', '1.00','2.00'];
            foreach($priceChart as $key => $chart){
                foreach($earring_carat_sizes as $size){
                    if(!isset($earringPriceChart[$key][$size])){
                        $halfSize = $size/2;
                        if($halfSize == 1) $halfSize = (string)$halfSize . '.00';
                        else $halfSize = (string)$halfSize . '0';
                        $earringPriceChart[$key][$size] = ($priceChart[$key][$halfSize] * 2);
                    }
                }
            }
            return $earringPriceChart;
        }
        return $priceChart;
    }

    public static function dumpSolitairePrice(){
        $types = ['IJ_SI','GH_SI','GH_VS','EF_VVS'];
        $carat = ['0.30','0.50','0.70','1.00'];
        $cnt = 10;
        foreach($types as $type){
            foreach($carat as $crt){
                $new = new self;
                $new->clarity = $type;
                $new->carat = $crt;
                $new->price = 1000 * $cnt;
                if($new->save()){
                    $cnt++;
                }
            }
        }
    }

    public static function filter($param)
    {
        $obj = self::orderBy('id');
        
        $count = $obj->count();
        // $len = $param['itemPerPage'];
        $len = 20;
        $start = ($param['currentPage'] - 1) * $len;
        $data = $obj->skip($start)->take($len)->get()->toArray();
        $res = \General::success_res();
        $res['data'] = $data;
        $res['start'] = $start;
        $res['total_record'] = $count;
        return $res;
    }

    public static function updateSolitairePrice($param)
    {
        $obj = self::where('id',$param['update_id'])->first();
        $obj->price=$param['price'];
        $obj->save();
        return \General::success_res('Solitaire price update successfully.');
    }

}