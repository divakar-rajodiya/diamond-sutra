<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

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

// get routes
Route::get('/',[WelcomeController::class,"getHome"]);
Route::get('/login',[WelcomeController::class,"getLogin"]);
Route::get('/sign-up',[WelcomeController::class,"getSignUp"]);
Route::get('/forget-password',[WelcomeController::class,"getForgetPassword"]);
Route::get('/reset-password',[WelcomeController::class,"getResetPassword"]);
Route::get('/verify-otp/{id}',[WelcomeController::class,"getVerifyOtp"]);

Route::get('/wishlist',[WelcomeController::class,"getWishlist"]);
Route::get('/chain/{sku}/{color}-gold/{productName}', [WelcomeController::class, "getChainDetail"]);
Route::get('/product-detail',[WelcomeController::class,"getProductDetail"]);
Route::get('/{categoryName}/{sku}/{color}-gold/{productName}',[WelcomeController::class,"getProductDetail"]);
Route::get('/view-chain',[WelcomeController::class,"getChainDetail"]);
Route::get('/about',[WelcomeController::class,"getAbout"]);
Route::get('/contact-us',[WelcomeController::class,"getContact"]);
Route::get('/faqs',[WelcomeController::class,"getFaqs"]);
Route::get('/privacy-policy',[WelcomeController::class,"getPrivacyPolicy"]);
Route::get('/returns-policy',[WelcomeController::class,"getReturnsPolicy"]);
Route::get('/terms-conditions',[WelcomeController::class,"getTermsConditions"]);
Route::get('/lifetime-exchange-buy-back-policy',[WelcomeController::class,"getLifetimeExchangeBuyBackPolicy"]);
Route::get('/why-buy-from-us',[WelcomeController::class,"getWhyBuyFromUs"]);
Route::get('/our-certifications',[WelcomeController::class,"getOurCertifications"]);
Route::get('/testimonials',[WelcomeController::class,"getTestimonials"]);
Route::get('/corporate-gifting',[WelcomeController::class,"getCorporateGifting"]);
Route::get('/certification-guide',[WelcomeController::class,"getCertificationGuide"]);
Route::get('/ring-size-guide',[WelcomeController::class,"getRingSizeGuide"]);
Route::get('/solitaire-buying-guide',[WelcomeController::class,"getSolitaireBuyingGuide"]);
Route::get('/top-jewellery-trends', [WelcomeController::class,"getJewelleryTrends"]);

Route::get('/jewellery',[WelcomeController::class,"getProducts"]);
Route::get('/jewellery/{category}',[WelcomeController::class,"getProducts"]);
Route::get('/jewellery/{category}/{subcategory}',[WelcomeController::class,"getProducts"]);

// Define custom routes for SEO-friendly URLs
Route::get('/solitaire-rings', function() {
    return app(WelcomeController::class)->getProducts('Rings', 'sol');
});
Route::get('/solitaire-pendants', function() {
    return app(WelcomeController::class)->getProducts('Pendants', 'sol');
});
Route::get('/solitaire-earrings', function() {
    return app(WelcomeController::class)->getProducts('Earrings', 'sol');
});

// Route::get('/loose-solitaires',[WelcomeController::class,"getLooseSolitaires"]);
// db test 
Route::get('/loose-solitaires',[WelcomeController::class,"getLooseSolitaires"]);
Route::post('/solitaire-filter',[WelcomeController::class,"postSolitaireFilter"]);

// for loose solitaire
Route::get('/solitaire-details',[WelcomeController::class,"getSolitaireDetailLoose"]);
// db test
// Route::get('/solitaire-details/{ref_no}',[WelcomeController::class,"getSolitaireDetailLoose"]);


Route::get('/solitaire-pair-details',[WelcomeController::class,"getSolitairePairDetailLoose"]);
Route::get('/loose-solitaire-pair',[WelcomeController::class,"getLooseSolitairePairs"]);

// db test
Route::post('/solitaire-pair-filter',[WelcomeController::class,"postSolitairePairFilter"]);

Route::get('/products',[WelcomeController::class,"getProducts"]);
Route::post('/product-filter',[WelcomeController::class,"postProductFilter"]);

Route::get('select-solitaire-diamond', [WelcomeController::class,'getSelectSolitaire']);

// custom routs for SEO
Route::get('design-your-own-solitaire-rings', [WelcomeController::class,'getSelectSolitaire']);
Route::get('design-your-own-solitaire-pendants', [WelcomeController::class,'getSelectSolitaire']);


Route::get('/checkout',[WelcomeController::class,"getCheckout"]);
Route::get('/confirm-checkout',[WelcomeController::class,"getCheckoutNew"]);

Route::get('/checkout-method',[WelcomeController::class,"getCheckoutMethod"]);
Route::get('/order-success/{order_id}',[WelcomeController::class,"getOrderSuccess"]);
Route::get('/order-detail/{order_id}',[WelcomeController::class,'getOrderDetail']);
// Route::get('/thank-you/{order_id}',[WelcomeController::class,'getThankyou']);
Route::get('/thank-you/{order_id}',[WelcomeController::class,'getThankyouNew']);
Route::get('/order-faild',[WelcomeController::class,'getOrderFaild']);


Route::get('/matching/diamond-pair',[WelcomeController::class,'getMatchingDiamondPair']);
Route::get('design-your-own-solitaire-earrings', [WelcomeController::class,'getMatchingDiamondPair']);

Route::get('/solitaire-p',[WelcomeController::class,"getParishiSolitaireData"]);
Route::get('/solitaire-r',[WelcomeController::class,"getRanwakaSolitaireData"]);
Route::get('/solitaire-a',[WelcomeController::class,"getAsianStarsSolitaireData"]);
Route::get('/solitaire-s',[WelcomeController::class,"getSanghaviSolitaireData"]);


Route::get('/solitaire',[WelcomeController::class,"getSolitaireApiData"]);
// Route::get('/diamond-pair',[WelcomeController::class,'postPairingDiamonds']);
Route::get('/diamond-pair',[WelcomeController::class,'getDiamondPair']);

Route::get('/solitaire-detail',[WelcomeController::class,"getSolitaireDetail"]);
Route::post('/show-solitaire-detail',[WelcomeController::class,"postShowSolitaire"]);

Route::get('/solitaire-pair-detail',[WelcomeController::class,"getSolitairePairDetail"]);
Route::post('/show-solitaire-pair-detail',[WelcomeController::class,"postShowSolitairePair"]);

Route::get('/update-wishlist/{product_id}',[WelcomeController::class,"getUpdateWishlist"]);

// Route::get('/chains',[WelcomeController::class,"getChains"]);

// post routes
Route::post('/login',[WelcomeController::class,"postLogin"]);
Route::post('/mobile-login',[WelcomeController::class,"postMobileLogin"]);
Route::post('/signup',[WelcomeController::class,"postSignup"]);


Route::post('/verify-user-otp',[WelcomeController::class,"postVerifyOtp"]);
Route::post('/resend-otp',[WelcomeController::class,"postResendOtp"]);

// Route::post('/start-checkout',[WelcomeController::class,"postStartCheckout"]);
Route::post('/start-checkout',[WelcomeController::class,"postStartCheckoutNew"]);

Route::post('/make-checkout',[WelcomeController::class,"postMakeCheckout"]);

// cart checkout
Route::post('confirm-and-pay',[WelcomeController::class,'postConfirmAndPay']);

Route::post('/create-order',[WelcomeController::class,"postCreateOrder"]);
// Route::post('/payment-success',[WelcomeController::class,"postPaymentSuccess"]);
Route::any('/cashfree/payments/success',[WelcomeController::class,"postPaymentSuccess"]);


Route::post('/select-chain',[WelcomeController::class,"postSelectChain"]);

Route::post('/pincode/check',[WelcomeController::class,"postCheckPincode"]);
Route::get('/check-estimated-delivery/{pincode}',[WelcomeController::class,"check_estimated_delivery"]);

Route::post('/solitaire/select',[WelcomeController::class,"postSelectSolitaire"]);
Route::post('/product/select',[WelcomeController::class,"postSelectProduct"]);
Route::post('/setting/reset',[WelcomeController::class,"postSettingReset"]);
Route::post('/diamond/reset',[WelcomeController::class,"postDiamondReset"]);

Route::post('/solitaire/pair/select',[WelcomeController::class,"postSelectSolitairePair"]);
Route::post('/product/pair/select',[WelcomeController::class,"postSelectProductPair"]);
Route::post('/setting/pair/reset',[WelcomeController::class,"postSettingResetPair"]);
Route::post('/diamond/pair/reset',[WelcomeController::class,"postDiamondPairReset"]);

Route::post('/coupon/apply',[WelcomeController::class,"postApplyCoupon"]);
Route::post('/apply-coupon',[WelcomeController::class,"postApplyCouponNew"]);
Route::post('/remove-coupon',[WelcomeController::class,"postRemoveCouponNew"]);
Route::post('/check-coupon',[WelcomeController::class,"postCheckCouponNew"]);
Route::get('/dump-sol-price',[WelcomeController::class,'dumpSolPrice']);
Route::get('/send-email',[WelcomeController::class,'postSendEmail']);

// mail test
Route::get('/test',[WelcomeController::class,'test']);
Route::get('/order-email',[WelcomeController::class,'orderemail']);
Route::get('/cancel-mail',[WelcomeController::class,'cencelEmail']);
Route::get('/delivered-mail',[WelcomeController::class,'deliveredEmail']);
Route::get('/getting-ready-mail',[WelcomeController::class,'gettingReadyMail']);
Route::get('/return-mail',[WelcomeController::class,'returnMail']);
Route::get('/shipped-mail',[WelcomeController::class,'shippedMail']);



Route::post('/contact-us',[WelcomeController::class,"postContactUs"]);
Route::post('/subscribe-us',[WelcomeController::class,"postSubscribeUs"]);

// Route::post('/cancel-order',[WelcomeController::class,"postCancelOrder"]);
// Route::post('/return-order',[WelcomeController::class,"postReturnOrder"]);

Route::post('/forget-password',[WelcomeController::class,"postForgetPassword"]);
Route::get('/reset-password/{token}',[WelcomeController::class,"postResetPassword"]);
Route::post('/change-password',[WelcomeController::class,"postChangePassword"]);
// Route::get('/download-invoice/{order_id}',[WelcomeController::class,"postDownloadInvoice"]);
Route::get('/download-invoice/{order_id}',[WelcomeController::class,"postDownloadInvoiceNew"]);

Route::post('/cashfree/webhook',[WelcomeController::class,"postCashfreeWebhook"]);

Route::get('/cart',[WelcomeController::class,"getCart"]);

Route::post('get-product-custom-price',[WelcomeController::class,'getProductCustomPrice']);

Route::post('get-pair-custom-price',[WelcomeController::class,'getPairCustomPrice']);
Route::post('refresh-cart-data',[WelcomeController::class,'getRefreshCart']);


//test routes

Route::get('/merge-solitaire',[WelcomeController::class,"getMergedSolaitaireData"]);


Route::get('/get-sol-from-db',[WelcomeController::class,"getDbSol"]);

