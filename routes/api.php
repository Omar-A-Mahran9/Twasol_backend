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


    Route::post('news-letter', 'HomeController@newsLetter');
    Route::get('sliders', 'HomeController@getSliders');
    Route::get('services', 'HomeController@getservices');
    Route::get('whyus', 'HomeController@getwhyus');
    Route::get('questions', 'HomeController@getQuestions');
    Route::get('how-make-order', 'HomeController@getMakeOrder');
    Route::get('cities', 'HomeController@getcities');

    Route::post('order/{step}', 'OrderController@createOrder');

    Route::get('general', 'GeneralInvokableController');
    Route::post('contact_us', 'ContactUsController@store');
    

});
