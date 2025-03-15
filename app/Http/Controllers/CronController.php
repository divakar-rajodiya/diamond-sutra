<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Lib\General;
use PhpParser\Node\Expr\FuncCall;
use PHPUnit\Framework\Attributes\IgnoreFunctionForCodeCoverage;
use App\Jobs\PairDiamonds;
use App\Models\Admin\SolitaireData;

class CronController extends Controller
{
    public function __construct() {}

    public function getUpdateMetalRate()
    {
        try {
            \Log::info("========================");
            \Log::info("Metal API Start");
            $myHeaders = array(
                'Content-Type: application/json'
            );
    
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://metals-api.com/api/gold-price-india?access_key=' . env('METAL_PRICE_API_KEY') . '&symbols=KOLK-24k',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTPHEADER => $myHeaders
            ));
    
            $response = curl_exec($curl);
            \Log::info("Metal APi Response ========================");
            \Log::info($response);
    
            curl_close($curl);
            $response = json_decode($response, true);
            if (isset($response['success']) && $response['success']) {
                $carate_18_rate = ($response['rates']['KOLK-24k'] + $response['rates']['KOLK-24k'] * 0.04) * 0.76;
                $carate_14_rate = ($response['rates']['KOLK-24k'] + $response['rates']['KOLK-24k'] * 0.04) * 0.60;
    
                // dd($carate_18_rate,$carate_14_rate);
                \Log::info("Metal APi 18k Rate =================");
                \Log::info($carate_18_rate);
    
                \Log::info("Metal APi 4k Rate =================");
                \Log::info($carate_14_rate);
    
                \App\Models\Admin\Settings::where('name', 'gold_rate_14k')->update(['val' => number_format($carate_14_rate, 2, '.', '')]);
                \App\Models\Admin\Settings::where('name', 'gold_rate_18k')->update(['val' => number_format($carate_18_rate, 2, '.', '')]);
            }
            return 'Price updated';
        } catch (\Exception $e) {
            throw $e;
        }
    }
    // public function getUpdateMetalRate()
    // {
    //     $myHeaders = array(
    //         'x-access-token: ' . env('GOLD_PRICE_API_KEY'),
    //         'Content-Type: application/json'
    //     );

    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://www.goldapi.io/api/XAU/INR',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTPHEADER => $myHeaders
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     $response = json_decode($response,true);
    //     $carate_14_rate = $response['price_gram_14k'] ;
    //     $carate_18_rate = $response['price_gram_18k'] ;

    //     \App\Models\Admin\Settings::where('name','gold_rate_14k')->update(['val'=>number_format($carate_14_rate,2,'.','')]);
    //     \App\Models\Admin\Settings::where('name','gold_rate_18k')->update(['val'=>number_format($carate_18_rate,2,'.','')]);
    //     return 'Price updated';
    // }

    public function getUpdatePrice()
    {
        try {
            $products = \App\Models\Admin\Product::get();
            foreach ($products as &$product) {
                $tempObj = $product;
                $tempObj = $tempObj->toArray();
                $productDetails = \App\Lib\General::getProductPrice($tempObj, null, 'price');
                $product->product_base_price = $productDetails['base_price'];
                $product->product_buy_price = $productDetails['buy_price'];
                if($product->save()){
                    echo "$product->product_sku price updated : $product->product_buy_price \n";
                } else {
                    echo "$product->product_sku price update failed \n";
                }
            }
            return General::success_res("Script executed successfully...");
        } catch (\Exception $e) {
            \Log::error("Error while updating product prices ".$e->getMessage());
            throw $e;
        }
    }

    public function storeApiData()
    {

        \Log::info("Store API Cron Start");
        $response = \App\Http\Controllers\WelcomeController::getMergedSolaitaireData();
        \Log::info("Store API Response");
        \Log::info(json_encode($response));
        $res = General::error_res();
        if ($response['flag'] == 1) {
            \Cache::add('api_data', $response['data']);
            \Log::info("Store API Success");
            $res = General::success_res();
        }
        $makePairResponse = \App\Http\Controllers\WelcomeController::postPairingDiamonds();
        if ($makePairResponse['flag'] == 1) {
            \Cache::add('api_data_pair', $makePairResponse['data']);
            $res = General::success_res('Pair success');
            \Log::info('pair cached succss');
        } else {
            $res = General::error_res('pair chache failed');
        }
        \Log::info("Store API Error");
        return $res;
    }

    public function getParishiDiamond()
    {
        $res = \General::error_res();
        $apiData = array();

        try {
            // Second API request (Parishi)
            $response = \Http::timeout(300)->get('https://parishidiamond.com/aspxpages/StkDwnlJason.aspx?uname=adityashah&pwd=Crazyadi5');
            if ($response->successful()) {
                $data = $response->json();
                // db store
                $res = SolitaireData::update_parishi_data($data);
                return $res;

                $apiData = \App\Http\Controllers\WelcomeController::filterAndModifyData($data, 'parishi');


                // cahce store
                \Cache::forget('parishi_api_data');
                \Cache::put('parishi_api_data', $apiData);
                return  General::success_res();
            } else {
                $res['msg'] = $response->body();
            }
        } catch (\Exception $e) {
            \Log::info("error in api parishi $e");
        }

        return $res;
    }
    public function getStarraysDiamond()
    {
        $apiData = array();
        $res = General::error_res();

        try {
            // First API request (Starrays)
            $response = \Http::timeout(300)->post('http://RANWAKA:starrays@api.starrays.com/StarRays/DetailInventory');
            if ($response->successful()) {
                $data = $response->json();
                $res = SolitaireData::update_starrays_data($data);
                return $res;
                $apiData = array_merge($apiData, \App\Http\Controllers\WelcomeController::filterAndModifyData($data, 'starrays'));
                \Cache::forget('starrays_api_data');
                \Cache::put('starrays_api_data', $apiData);
                return  General::success_res();
            } else {
                $res['msg'] = $response->body();
            }
        } catch (\Exception $e) {
            \Log::info("error in api starrays $e");
        }

        return $res;
    }
    public function getSanghviDiamond()
    {
        $apiData = array();
        $res = General::error_res();

        try {
            // third api request (SANGHVI)
            $payload = [
                'username' => 'Diamond_sutra',
                'password' => 'Sanghvi@123'
            ];

            // Send the request as form-encoded data
            $response = \Http::timeout(300)->asForm()->post('https://sanghvisons.com/SanghaviWebApi/diff_four', $payload);
            if ($response->successful()) {
                $data = $response->json();
                $res = SolitaireData::update_sanghvi_data($data['data']);
                return $res;
                $apiData = array_merge($apiData, \App\Http\Controllers\WelcomeController::filterAndModifyData($data['data'], 'sanghvi'));
                \Cache::forget('sanghvi_api_data');
                \Cache::put('sanghvi_api_data', $apiData);
                return  General::success_res();
            } else {
                $res['msg'] = $response->body();
            }
        } catch (\Exception $e) {
            \Log::info("error in api sanghvi $e");
        }

        return $res;
    }
    public function getAsianStarsDiamond()
    {
        $apiData = array();
        $res = General::error_res();

        try {
            // fourth api request (asianstars)
            $payload = [
                'username' => 'diamondsutra',
                'password' => 'sutra@123'
            ];

            // Send the request as form-encoded data
            $response = \Http::timeout(300)->post('http://apiasianstars.com:8000/api/demandlist', $payload);
            if ($response->successful()) {
                $data = $response->json();
                $res = SolitaireData::update_asianstars_data($data);
                return $res;
                $apiDataAsianStars = \App\Http\Controllers\WelcomeController::filterAndModifyData($data, 'asianstars');
                \Cache::forget('asianstars_api_data');
                \Cache::put('asianstars_api_data', $apiDataAsianStars);
                return General::success_res();
            } else {
                $res['msg'] = $response->body();
            }
        } catch (\Exception $e) {
            \Log::info("error in api asianstars $e");
        }
        return $res;
    }

    public function getDharamDiamond()
    {

        $apiData = array();
        $res = General::error_res();

        try {
            $payload = [
                'uniqID' => 24999,
                'company' => "DIAMONDSUTRA",
                'actCode' => "SUT@IN24#99",
                'selectAll' => "",
                'StartIndex' => "",
                'count' => 10,
                'columns' => "",
                'finder' => "",
                'sort' => ""
            ];

            $response = \Http::timeout(300)->post('https://stock.ddpl.com/dharamwebapi/api/StockDispApi/getDiamondData', $payload);

            if ($response->successful()) {
                $data = $response->json();
                $data = json_encode($data['DataList']);
                $data = json_decode($data, true);
                $res = SolitaireData::update_dharam_data($data);
                dd($res);

                $apiData = \App\Http\Controllers\WelcomeController::filterAndModifyData($data['DataList'], 'dharam');

                // db store
                $res = SolitaireData::update_data('dharam',$apiData, 0);
                dd($res);

                // cache store
                // \Cache::forget('dharam_api_data');
                // \Cache::put('dharam_api_data', $apiData);
                return  General::success_res();
            } else {
                $res['msg'] = $response->body();
            }
        } catch (\Exception $e) {
            \Log::info("error in api dharam $e");
        }
        return $res;
    }

    public function mergeDiamondData()
    {
          // Set PHP settings
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        ini_set('memory_limit', '-1');
        set_time_limit(0);
    
        $mergedApiData = [];

        if (\Cache::has('parishi_api_data')) {
            $solitaires = \Cache::get('parishi_api_data');
            if ($solitaires != null) {
                $mergedApiData = array_merge($mergedApiData, $solitaires);
            }
        }
        if (\Cache::has('starrays_api_data')) {
            $solitaires = \Cache::get('starrays_api_data');
            if ($solitaires != null) {
                $mergedApiData = array_merge($mergedApiData, $solitaires);
            }
        }
        if (\Cache::has('sanghvi_api_data')) {
            $solitaires = \Cache::get('sanghvi_api_data');
            if ($solitaires != null) {
                $mergedApiData = array_merge($mergedApiData, $solitaires);
            }
        }
        if (\Cache::has('asianstars_api_data')) {
            $solitaires = \Cache::get('asianstars_api_data');
            foreach ($solitaires as $sol) {
                if (!isset($sol['DisplayCut'])) dd($sol);
            }
            if ($solitaires != null) {
                $mergedApiData = array_merge($mergedApiData, $solitaires);
            }
        }

        if (\Cache::has('dharam_api_data')) {
            $solitaires = \Cache::get('dharam_api_data');
            if ($solitaires != null) {
                $mergedApiData = array_merge($mergedApiData, $solitaires);
            }
        }

        // dd($mergedApiData);

        // Split the large array into chunks
        // $chunks = array_chunk($mergedApiData, 1000); // Adjust chunk size as needed

        // foreach ($chunks as $index => $chunk) {
        //     \Cache::put("api_data_chunk_{$index}", $chunk);
        // }
        // $chunkCount = count($chunks);
        // \Cache::put('api_data_chunk_count', $chunkCount);

        // \Log::info("Store API Success");

        // chunk code end


        \Cache::forget('api_data');
        \Cache::put('api_data', $mergedApiData);
        \Log::info("Store API Success");

        // dd($diamond);

        $makePairResponse = \App\Http\Controllers\WelcomeController::postPairingDiamonds($mergedApiData);

        if ($makePairResponse['flag'] == 1) {
            // Merge the paired data into the final array
            \Cache::forget('api_data_pair');
            \Cache::put('api_data_pair', $makePairResponse['data']);
            
            return General::success_res('Pair success');
        } else {
            \Log::error("Pairing failed.");
            return General::error_res('Pairing process failed.');
        }



        return General::success_res();
    }

    public function getMakePair()
    {
        // PairDiamonds::dispatch();
        // return General::success_res('Pairing process started.');

        // $chunkCount = \Cache::get('api_data_chunk_count', 0); // Default to 0 if not found
        // $mergedApiData = [];

        // for ($index = 0; $index < $chunkCount; $index++) {
        //     $data = \Cache::get("api_data_chunk_{$index}");
        //     if ($data) {
        //         $mergedApiData = array_merge($mergedApiData, $data);
        //     }
        // }

        // $makePairResponse = \App\Http\Controllers\WelcomeController::postPairingDiamonds($mergedApiData);
        // \Cache::forget('api_data_pair');
        // \Cache::put('api_data_pair', $mergedApiData);

        // if ($makePairResponse['flag'] == 1) {
        //     // Split the paired data into chunks
        //     $pairedDataChunks = array_chunk($makePairResponse['data'], 1000); // Adjust chunk size as needed

        //     // Store each chunk in the cache
        //     foreach ($pairedDataChunks as $index => $chunk) {
        //         \Cache::put("api_data_pair_chunk_{$index}", $chunk);
        //     }

        //     // Store the chunk count
        //     \Cache::put('api_data_pair_chunk_count', count($pairedDataChunks));

        //     \Log::info('Pair cached successfully');
        //     $res = General::success_res('Pair success');
        // } else {
        //     \Log::info("Store API Error");
        //     $res = General::error_res('Pair cache failed');
        // }

        // Get the number of chunks
        $chunkCount = \Cache::get('api_data_chunk_count', 0); // Default to 0 if not found
        $mergedApiData = [];

        // Retrieve and merge the data chunks from cache
        for ($index = 0; $index < $chunkCount; $index++) {
            $data = \Cache::get("api_data_chunk_{$index}");
            if ($data) {
                $mergedApiData = array_merge($mergedApiData, $data);
            }
        }

        // Split the merged data into 5000-element chunks
        $chunks = array_chunk($mergedApiData, 5000);
        $pairedData = [];

        // Process each chunk separately
        foreach ($chunks as $chunk) {
            $makePairResponse = \App\Http\Controllers\WelcomeController::postPairingDiamonds($chunk);

            if ($makePairResponse['flag'] == 1) {
                // Merge the paired data into the final array
                $pairedData = array_merge($pairedData, $makePairResponse['data']);
            } else {
                \Log::error("Pairing failed for a chunk.");
                return General::error_res('Pairing process failed for a chunk.');
            }
        }
        \Cache::forget('api_data_pair');
        \Cache::put('api_data_pair', $pairedData);



        // // Split the final paired data into chunks for caching
        // $pairedDataChunks = array_chunk($pairedData, 1000); // Adjust chunk size as needed

        // // Store each chunk in the cache
        // foreach ($pairedDataChunks as $index => $chunk) {
        //     \Cache::put("api_data_pair_chunk_{$index}", $chunk);
        // }

        // // Store the count of paired data chunks in the cache
        // \Cache::put('api_data_pair_chunk_count', count($pairedDataChunks));

        \Log::info('Pairing process completed and cached successfully');
        return General::success_res('Pairing process completed successfully.');
    }


    // public function getUpdateUsdRate(){
    //     $myHeaders = array(
    //         'Content-Type: application/json'
    //     );

    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api.metalpriceapi.com/v1/latest?api_key='.env('METAL_PRICE_API_KEY').'&base=XAU&currencies=INR',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTPHEADER => $myHeaders
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     $response = json_decode($response,true);
    //     dd($response);
    //     if(!isset($response['success'])){
    //         return "somthing went wrong!";
    //     }

    //     $usd_to_inr_rate = $response['rates']['INR'];

    //     \App\Models\Admin\Settings::where('name','usd_to_inr_rate')->update(['val'=>number_format($usd_to_inr_rate,2,'.','')]);
    //     return 'Price updated';
    // }

    public function getUpdateUsdRate()
    {
        try {
            $apiKey = env('USD_RATE_API_KEY');
            $myHeaders = array(
                'Content-Type: application/json'
            );
    
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://v6.exchangerate-api.com/v6/' . $apiKey . '/latest/USD',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTPHEADER => $myHeaders
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
            $response = json_decode($response, true);
            $usd_to_inr_rate = $response['conversion_rates']['INR'];
    
            \App\Models\Admin\Settings::where('name', 'usd_to_inr_rate')->update(['val' => number_format($usd_to_inr_rate, 2, '.', '')]);
            return 'Price updated';
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
