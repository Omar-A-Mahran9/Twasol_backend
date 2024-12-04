<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/home', function () {
//     return view('vendor-dashboard.home');
// })->name('home');
Route::get("/home", "DashboardController@index")->name('home');
Route::post('/fetch-data', 'DashboardController@ordersTransaction')->name('fetch.data');

Route::delete("branches/delete-selected", "CityController@deleteSelected");
Route::get("branches/restore-selected", "CityController@restoreSelected");
// Route::get("branches/restore", "CityController@restore");

Route::post("products/{step?}", "ProductController@store")->name('products.store');
Route::put("products/{product}/{step?}", "ProductController@update")->name('products.update');
Route::get("products/{product}/images", "ProductController@images");
Route::resource('products', 'ProductController')->except(['store', 'update']);
Route::resource('orders', 'OrderController')->except(['store', 'update']);
// Route::resource('branches','CityController')->only(['index', 'store', 'update', 'destroy']);
Route::resource('branches', 'CityController');
Route::get("branches/restore", "CityController@restore");

Route::post('change-order-status/{id}', 'OrderController@changeOrderStatus')->name('change-order-status');
Route::get('profile-info', 'VendorController@profileInfo')->name('profile-info');
Route::put('update-profile-info', 'VendorController@updateProfileInfo')->name('update-profile-info');
Route::put('update-profile-email', 'VendorController@updateProfileEmail')->name('update-profile-email');
Route::put('update-profile-password', 'VendorController@updateProfilePassword')->name('update-profile-password');

/** ajax routes **/
Route::post('dropzone/validate-image', 'DropzoneController@validateImage')->name('dropzone.validate-image');
Route::post("select2-ajax/subcategories", "ProductController@getSubcategories")->name('select2-ajax.subcategories');

Route::get('trash/{modelName}/{id}/restore', 'TrashController@restore')->name('trash.restore');
Route::get('/language/{lang}', function (Request $request) {
    session()->put('locale', $request->lang);
    return redirect()->back();
})->name('change-language');

/** notifications routes **/
Route::post('/save-token', 'NotificationController@saveToken')->name('save-token');
Route::post('/send-notification', 'NotificationController@sendNotification')->name('send.notification');
Route::get('notifications/{id}/mark_as_read', 'NotificationController@markAsRead')->name('notifications.mark_as_read');
Route::get('notifications/{type}/load-more/{next}', 'NotificationController@loadMore')->name('notifications.load_more');
Route::get('notifications/mark-all-as-read', 'NotificationController@markAllAsRead')->name('notifications.mark_all_as_read');
