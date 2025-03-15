<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CronController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('update-metal-rate', [CronController::class, 'getUpdateMetalRate']);
Route::get('update-fiat-rate', [CronController::class, 'getUpdateGoldRate']);

Route::get('update-usd-rate', [CronController::class, 'getUpdateUsdRate']);

Route::get('api/data/store', [CronController::class, 'storeApiData']);

Route::get('update-product-prices', [CronController::class, 'getUpdatePrice']);


Route::get('api/solitaire/parishi', [CronController::class, 'getParishiDiamond']);
Route::get('api/solitaire/starrays', [CronController::class, 'getStarraysDiamond']);
Route::get('api/solitaire/sanghvi', [CronController::class, 'getSanghviDiamond']);
Route::get('api/solitaire/asianstars', [CronController::class, 'getAsianStarsDiamond']);
Route::get('api/solitaire/dharam', [CronController::class, 'getDharamDiamond']);

Route::get('api/solitaire/update', [CronController::class, 'mergeDiamondData']);

// Route::get('api/solitaire/make-pair', [CronController::class, 'getMakePair']);
