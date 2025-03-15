<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
Route::get('/login/{sec_token}',[AdminController::class,"getLogin"]);
Route::get('/dashboard',[AdminController::class,'getDashboard']);
Route::get('/profile',[AdminController::class,'getProfile']);
Route::get('/settings',[AdminController::class,'getSettings']);
Route::get('/product',[AdminController::class,'getProduct']);
Route::get('/product/detail/{id}',[AdminController::class,'getProductDetail']);
Route::post('/product/update',[AdminController::class,'postUpdateProduct']);
Route::get('/pincode',[AdminController::class,'getPincode']);
Route::get('/coupon',[AdminController::class,'getCoupon']);
Route::get('/category',[AdminController::class,'getCategory']);
Route::get('/subcategory',[AdminController::class,'getSubCategory']);
Route::get('/user',[AdminController::class,'getUser']);
Route::get('/banner',[AdminController::class,'getBanner']);
Route::get('logout',[AdminController::class,'getLogout']);
Route::get('/contact-us',[AdminController::class,'getContactUs']);
Route::get('/subscribe-us',[AdminController::class,'getSubscribeUs']);
Route::get('/testimonial', [AdminController::class,'getTestimonial']);
Route::get('/product-review', [AdminController::class,'getProductReview']);
Route::get('/solitaire-price',[AdminController::class,'getSolitairePrice']);
Route::get('/order',[AdminController::class,'getOrder']);
Route::get('/subscribe-export',[AdminController::class,'getSubscribeExport']);
Route::get('/contact-export',[AdminController::class,'getContactUsExport']);

Route::get('update-product-prices', [AdminController::class, 'getUpdatePrice']);

// //post route
Route::post('/login',[AdminController::class,"postLogin"]);
Route::post('/save-settings',[AdminController::class,'postSaveSettings']);
Route::post('/change-password',[AdminController::class,"postChangePassword"]);
Route::post('/update-profile',[AdminController::class,"postUpdateProfile"]);
Route::post('/upload-product-data',[AdminController::class,"postUploadProductData"]);
Route::post('/change-maintenance-mode',[AdminController::class,'postChangeMaintenanceMode']);


Route::post('/user/list',[AdminController::class,'postUserList']);
Route::post('/contactus-filter',[AdminController::class,'postContactusFilter']);
Route::post('/contactus/delete',[AdminController::class,'postContactUsDelete']);

Route::post('/subscribe-filter',[AdminController::class,'postSubscribeFilter']);

Route::post('/filter-testimonial', [AdminController::class,'postTestimonialFilter']);
Route::post('/add-testimonial', [AdminController::class,'postAddTestimonial']);
Route::post('/update-testimonial', [AdminController::class,'postUpdateTestimonial']);
Route::post('/delete-testimonial', [AdminController::class,'postDeleteTestimonial']);

Route::post('/filter-product-review', [AdminController::class,'postProductReview']);
Route::post('/add-product-review', [AdminController::class,'postAddProductReview']);
Route::post('/update-product-review', [AdminController::class,'postUpdateProductReview']);
Route::post('/delete-product-review', [AdminController::class,'postDeleteProductReview']);
Route::post('/product-review-status', [AdminController::class,'postStatusChangeProductReview']);

Route::post('/product/list',[AdminController::class,'postProductList']);
Route::post('/product/delete',[AdminController::class,'postProductDelete']);

Route::post('/subcategory/get',[AdminController::class,'postGetSubCategory']);
Route::post('/category/get',[AdminController::class,'postGetCategory']);

Route::post('/category/list',[AdminController::class,'postCategoryList']);
Route::post('/category/add',[AdminController::class,'postCategoryAdd']);
Route::post('/category/update',[AdminController::class,'postCategoryUpdate']);
Route::post('/category/delete',[AdminController::class,'postCategoryDelete']);

Route::post('/coupon/validate',[AdminController::class,'postValidateCoupon']);
Route::post('/coupon/list',[AdminController::class,'postCouponList']);
Route::post('/coupon/add',[AdminController::class,'postCouponAdd']);
Route::post('/coupon/update',[AdminController::class,'postCouponUpdate']);
Route::post('/coupon/delete',[AdminController::class,'postCouponDelete']);

Route::post('/subcategory/list',[AdminController::class,'postSubCategoryList']);
Route::post('/subcategory/add',[AdminController::class,'postSubCategoryAdd']);
Route::post('/subcategory/update',[AdminController::class,'postSubCategoryUpdate']);
Route::post('/subcategory/delete',[AdminController::class,'postSubCategoryDelete']);
Route::post('/subcategory/delete',[AdminController::class,'postSubCategoryDelete']);

Route::post('/banner/list',[AdminController::class,'postBannerList']);
Route::post('/banner/add',[AdminController::class,'postBannerAdd']);
Route::post('/banner/update',[AdminController::class,'postBannerUpdate']);
Route::post('/banner/delete',[AdminController::class,'postBannerDelete']);

Route::post('/pincode/upload',[AdminController::class,'postUploadPincodeData']);
Route::post('/pincode/list',[AdminController::class,'postPincodeList']);
Route::post('/pincode/delete',[AdminController::class,'postPincodeDelete']);

Route::post('/solitaire-price/list',[AdminController::class,'postSolitairePriceList']);
Route::post('/solitaire-price/update',[AdminController::class,'postSolitairePriceUpdate']);

Route::post('/order/list',[AdminController::class,'postOrderList']);
Route::get('/order/detail/{id}',[AdminController::class,'getOrderDetail']);
Route::post('/order-status/update',[AdminController::class,'postOrderStatusUpdate']);

Route::get('/migrate-order-data',[AdminController::class,'getMigrateOldOrders']);



Route::get('/seo-script',[AdminController::class,'getSeoScript']);
Route::post('/upload-product-seo-data',[AdminController::class,"postUploadProductSeoData"]);
Route::post('/upload-product-desc-data',[AdminController::class,"postUploadProductDescData"]);
Route::get('/clear-cache',[AdminController::class,'getFlushCache']);
