<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [];
    public $timestamps = false;
    protected $hidden = [];

    function category()
    {
        return $this->hasOne('App\Models\Admin\Category', 'id', 'category_id');
    }
    function subcategory()
    {
        return $this->hasMany('App\Models\Admin\ProductSubcategory', 'product_id', 'id');
    }
    function reviews()
    {
        return $this->hasMany('App\Models\User\Review', 'product_sku', 'product_sku')
            ->join('users', 'review.user_id', '=', 'users.id')
            ->select('review.*', 'users.name', DB::raw('SUBSTRING(users.name, 1, 1) AS name_icon'))
            ->where('review.status', 1)
            ->limit(10);
    }
    public static function filter($param)
    {
        if (isset($param['c'])) {
            $category = \App\Models\Admin\Category::where('name', strtolower($param['c']))->first();
            
            $param['c'] = $category['id'];
        }
        if (isset($param['sc'])) {
            // if ($param['sc'] != 'sol') {
            //     $subcategory = \App\Models\Admin\SubCategory::where('name', strtolower($param['sc']))->first();
            //     $param['sc'] = $subcategory['id'];
            // }
            
            if(isset($param['type'])){
                if($param['type'] != ''){
                    $subcategory = \App\Models\Admin\SubCategory::where('id', strtolower($param['type']))->first();
                    $param['type'] = $subcategory['id'];
                } else {
                    $param['type'] = null;
                }
            } else {
                $param['type'] = null;
            }
        }
        $productsQuery = self::with(['category','subcategory'])->where('status', 1);
        // ->where('category_id', '!=', 6);
        if (isset($param['sc'])) {
            if ($param['sc'] == 'sol') {
                $productsQuery->where('is_solitaire', 'yes');
                if($param['type']){
                    $productsQuery->whereHas('subcategory', function ($query) use ($param) {
                        $query->where('subcategory_id', $param['type']);
                    });
                }
            } else {
                $productsQuery->where('solitaire_setting', '!=', 'yes');
                $productsQuery->whereHas('subcategory', function ($query) use ($param) {
                    $query->where('subcategory_id', $param['sc']);
                });
            }
        } else {
            $productsQuery->where('solitaire_setting', '!=', 'yes');
        }
        if (isset($param['c'])) {
            $productsQuery->where('category_id', $param['c']);
        }
        if (isset($param['search'])) {
            $productsQuery = $productsQuery->where(function ($query) use ($param) {
                $query->where('name', 'LIKE', '%' . $param['search'] . '%')
                    ->orWhere('product_sku', 'LIKE', '%' . $param['search'] . '%')
                    ->orWhere('description', 'LIKE', '%' . $param['search'] . '%');
            });
        }
        if (isset($param['range'])) {
            if($param['range'] != '')
                $productsQuery->where('product_buy_price', '>=', (int)$param['range']);
        }
        if (isset($param['to'])) {
            if($param['to'] != '')
                $productsQuery->where('product_buy_price', '<=', (int)$param['to']);
        }
        if (isset($param['sort'])) {
            if ($param['sort'] == 'date') {
                $productsQuery->orderBy('id', 'DESC');
            } elseif ($param['sort'] == 'price') {
                $productsQuery->orderBy('product_buy_price');
            } elseif ($param['sort'] == 'price-desc') {
                $productsQuery->orderBy('product_buy_price', 'DESC');
            } elseif($param['sort'] == 'popularity') {
                $productsQuery->orderBy('avg_rating', 'DESC');
            }
        }

        $len = $param['itemPerPage'];
        $start = ($param['currentPage'] - 1) * $len;
        $count = $productsQuery->count();
        $products = $productsQuery->skip($start)->take($len)->get()->toArray();
        $filters = array(
            'c' => isset($param['c']) ? $param['c'] : null,
            'sc' => isset($param['sc']) ? $param['sc'] : null,
            'sort' => isset($param['sort']) ? $param['sort'] : null
        );
        $settings = app('settings');
        $wishlist = [];
        if (\Auth::guard('user')->check()) {
            $wishlist = \App\Models\User\Wishlist::get_user_wishlist();
        }
        if (isset($param['c'])) {
            $subcategoryList = SubCategory::get_subcategory_by_category_id($param['c']);
        } else {
            $subcategoryList = SubCategory::get_subcategory_by_category_id();
        }

        foreach ($products as $key => &$product) {
            if (in_array($product['id'], $wishlist)) {
                $product['wishlist'] = 'yes';
            } else {
                $product['wishlist'] = 'no';
            }
        }
        $res = \General::success_res();
        $res['data'] = $products;
        $res['start'] = $start;
        $res['total_record'] = $count;
        return $res;
    }

    public static function admin_filter($param){
        $productsQuery = self::with(['category','subcategory']);
        if (isset($param['search'])) {
            // $productsQuery = $productsQuery->where('product_sku', 'LIKE', '%' . $param['search'] . '%');
            // $productsQuery = $productsQuery->where('product_sku',$param['search']);
            $productsQuery = $productsQuery->where(function ($query) use ($param) {
                $query->where('name', 'LIKE', '%' . $param['search'] . '%')
                    ->orWhere('product_sku', 'LIKE', '%' . $param['search'] . '%');
            });
        }
        $len = $param['itemPerPage'];
        $start = ($param['currentPage'] - 1) * $len;
        $count = $productsQuery->count();
        $products = $productsQuery->skip($start)->take($len)->get()->toArray();
        $res = \General::success_res();
        $res['data'] = $products;
        $res['start'] = $start;
        $res['total_record'] = $count;
        return $res;
    }
    public static function getSolitaireProduct($param)
    {
        return self::with('category')->where('solitaire_setting', 'yes')->whereHas('category', function ($q) use ($param) {
            $q->where('name', $param['cat']);
        })->orderBy('product_buy_price','ASC')->get()->toArray();
    }

    public static function update_product($param)
    {
        // dd($param);
        $product = self::where('id', $param['product_id'])->first();
        if ($product) {
            $product->name = $param['product_name'];
            $product->color = $param['colors'];
            $product->video = $param['videos'];
            isset($param['description']) ? $product->description = $param['description'] : $product->description = null;
            isset($param['gold_weight_18']) ? $product->gold_weight_18k = $param['gold_weight_18'] : $product->gold_weight_18k = null;
            isset($param['gold_weight_14']) ? $product->gold_weight_14k = $param['gold_weight_14'] : $product->gold_weight_14k = null;
            isset($param['is_most_liked']) ? $product->is_most_liked = 1 : $product->is_most_liked = 0;
            isset($param['is_most_selling']) ? $product->is_most_selling = 1 : $product->is_most_selling = 0;
            isset($param['is_recommended']) ? $product->is_recommended = 1 : $product->is_recommended = 0;
            isset($param['is_solitaire']) ? $product->is_solitaire = 'yes' : $product->is_solitaire = 'no';
            isset($param['solitaire_setting']) ? $product->solitaire_setting = 'yes' : $product->solitaire_setting = 'no';
            if (isset($param['related_products'])) {
                if (count($param['related_products']) > 0) {
                    $product->related_items = implode(',', $param['related_products']);
                }
            }
            $product->dimension = '';
            $product->diamond = '[{"carat":0.000,"quantity":0,"shape":"round"}]';
            $product->stone = '';
            if (isset($param['dimension'])){
                if($param['dimension'] != '')
                    $product->dimension = $param['dimension'];

            }
            if (isset($param['diamond'])){
                if($param['diamond'] != '')
                    $product->diamond = $param['diamond'];

            }
            if (isset($param['stone'])){
                if($param['stone'] != '')
                    $product->stone = $param['stone'];

            }
            isset($param['diamond']) ? $product->diamond = $param['diamond'] : $product->diamond = null;
            $param['stone'] ? $product->stone = $param['stone'] : $product->stone = null;
        }

        $testProduct = $product;
        $calculated = \General::getProductPrice($testProduct->toArray());

        $product->product_base_price = $calculated['default_base_price'];
        $product->product_buy_price = $calculated['default_buy_price'];

        if ($product->save()) {
            \App\Models\Admin\ProductSubcategory::where('product_id', $product->id)->delete();
            foreach ($param['sub_category'] as $sc) {
                $obj = new \App\Models\Admin\ProductSubcategory();
                $obj->product_id = $product->id;
                $obj->subcategory_id = $sc;
                $obj->save();
            }
        }
        return \General::success_res('Product updated successfully');
    }
}
