<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', 'ApiController@version');

// AUTH
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/create', 'Auth\ResetPasswordController@create');
    Route::get('password/find/{token}', 'Auth\ResetPasswordController@find');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('login/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('login/{driver}/callback', 'Auth\OAuthController@handleProviderCallback');
});

Route::middleware('auth:api')->group(function() {
    Route::get('auth/logout', 'Auth\LoginController@logout');

    Route::get('/user', 'UserController@show');

    // Email verification
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::post('email/resend', 'Auth\VerificationController@resend');
});
