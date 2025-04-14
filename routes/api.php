<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['cors', 'json.response']], function () {

 
    Route::get('categories', 'HomeController@getCategories');
    Route::get('subcategories', 'HomeController@getSubcategories');
    Route::get('products', 'HomeController@getProducts');
    Route::get('product-sections', 'HomeController@getProductSections');
    Route::get('tags', 'HomeController@getTags');
    Route::get('ads', 'HomeController@getAds');
    Route::middleware('oto.token')->post("orders-checkout/{step?}", "OrderController@checkout");
    Route::post("order-cities", "OrderController@cities");
    Route::get('products', 'ProductController@index');
    Route::get('products/{product}', 'ProductController@show');
    Route::get('products/{product}/rates', 'ProductController@rates');
     Route::get('about-vendor/{product}', 'ProductController@aboutVendor');
    Route::get('vendors', 'VendorController@index');
    Route::get('vendors/{vendor}', 'VendorController@show');
    Route::get('vendors-products/{vendor}', 'VendorController@vendorProducts');
    Route::post('vendors', 'VendorController@store');

    Route::get('categories-products/{category}', 'CategoryController@categoryProducts');
    Route::get('categories-search', 'HomeController@categoriesSearch');
    Route::post('news-letter', 'HomeController@newsLetter');
    Route::get('sliders', 'HomeController@getSliders');
    Route::get('offers', 'HomeController@getOffers');
    Route::post('order/{step}', 'OrderController@createOrder');



//--------------------------------------------------------------------------

    Route::get('general', 'GeneralInvokableController');
    Route::post('contact_us', 'ContactUsController@store');
    Route::get('blogs', 'HomeController@getblogs');
    Route::get('blog/{id}', 'HomeController@getblog');

    Route::get('questions', 'HomeController@getQuestions');
    Route::post('bepartener/{step}', 'BepartenerController@store');

    Route::get('booking',[BookingController::class,'index']);
    Route::post('booking',[BookingController::class,'store']);

    Route::post('filter_car_prices',[BookingController::class,'filterPertrip']);
    Route::post('filter_Packages',[BookingController::class,'filterPackages']);



});
