<?php

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



Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::resource('/country', 'CountryController');
    Route::resource('/state', 'StateController');
    Route::resource('/city', 'CityController');
    Route::resource('/township', 'TownshipController');
    Route::resource('/ward', 'WardController');
    Route::resource('/street', 'StreetController');
    Route::resource('/address', 'AddressController');
    Route::resource('/common', 'CommonController');
    Route::resource('/type', 'TypeController');
    Route::resource('/department', 'DepartmentController');
    Route::resource('/qr_ticket', 'QrTicketController');
    Route::resource('/adhoc', 'AdHocController');
    
});

Route::middleware(['auth:sanctum'])->group(function () {
   Route::post('/logout', 'AuthController@logout')->name('logout');
    Route::resource('/event', 'EventController');
    Route::resource('/venue', 'VenueController');
    Route::resource('/booking', 'BookingController');
    Route::resource('/payment', 'PaymentController');
    Route::resource('/venue_rating', 'VenueRatingController');
    Route::resource('/venue_comment', 'VenueCommentController');
    Route::resource('/platform_user', 'PlatformUserController')->only(['update', 'destroy', 'show']);

});

Route::put('/image/update/{id}', 'ImageUpdateController@update')->name('image.update');
Route::post('/payment', 'PaymentController@create')->name('payment.store');
Route::get('/success', 'PaymentController@success')->name('success');
Route::get('/cancel', 'PaymentController@cancel')->name('cancel');
Route::get('/venue/{imageId}/destroy', 'VenueController@destroyImage');
Route::get('/venue', 'VenueController@index');
Route::get('/qrgenerate/{id}', 'EventController@show');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/login', 'AuthController@login')->name('login');
Route::resource('/platform_user', 'PlatformUserController')->only(['store']);
Route::post('/password/email', 'PasswordResetController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'PasswordResetController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'PasswordResetController@reset')->name('password.update');
Route::get('/email_verify', 'PasswordResetController@verify')->name('verify');
Route::post('/contact_us', 'ContactUsController@submitContactUsForm');




