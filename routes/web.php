<?php

use Illuminate\Support\Facades\Route;

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

Route::get('test-email', function () {
    return view('emails.user-status-change');
});

Route::group(['namespace' => 'Dashboard\Auth', 'middleware' => 'set_locale'], function () {

    // admin login routes
    Route::get('/', 'AdminAuthController@showLoginForm');

    Route::get('admin/login', 'AdminAuthController@showLoginForm')->name('admin.login-form');
    Route::post('admin/login', 'AdminAuthController@login')->name('admin.login');
    Route::post('admin/logout', 'AdminAuthController@logout')->name('admin.logout');
});

Route::group(['namespace' => 'Vendor\Auth', 'middleware' => 'set_locale'], function () {

    // vendor login routes
    Route::get('vendor/login', 'VendorAuthController@showLoginForm')->name('vendor.login-form');
    Route::post('vendor/login', 'VendorAuthController@login')->name('vendor.login');
    Route::post('vendor/logout', 'VendorAuthController@logout')->name('vendor.logout');
    Route::get('vendor/password/reset/{token}', 'VendorAuthController@showResetForm')->name('new.password');
    Route::post('vendor/password/reset', 'VendorAuthController@reset')->name('reset.password');
});
