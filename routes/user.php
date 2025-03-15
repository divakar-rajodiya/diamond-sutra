<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 
//get route
Route::get('/profile',[UserController::class,'getProfile']);
Route::get('/logout',[UserController::class,'getLogout']);
Route::get('/orders',[UserController::class,'getOrders']);

// Route::get('/order-detail/{order_id}',[UserController::class,'getOrderDetail']);
Route::get('/order-detail/{order_id}',[UserController::class,'getOrderDetailNew']);


// //post route
Route::post('/orders-list',[UserController::class,'postOrderList']);
Route::post('/change-password',[UserController::class,"postChangePassword"]);
Route::post('/update-profile',[UserController::class,"postUpdateProfile"]);
Route::post('/add-wishlist',[UserController::class,"postAddWishlist"]);

Route::post('/cancel-order',[UserController::class,"postCancelOrder"]);
Route::post('/return-order',[UserController::class,"postReturnOrder"]);


Route::post('/add-review',[UserController::class,"postAddReview"]);
