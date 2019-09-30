<?php
Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function(){
    Route::get('/login', 'AdminAuthController@login');
    Route::post('/login', 'AdminAuthController@toLogin');
    Route::get('/forgot/password', 'AdminAuthController@forgotPassword');
    Route::post('/forgot/password', 'AdminAuthController@forgotPasswordPost');
    Route::get('/reset/password/{token}', 'AdminAuthController@resetPassword');
    Route::post('/reset/password/{token}', 'AdminAuthController@resetPasswordPost');
    Route::group(['middleware' => 'admin:admin'], function() {
        
        Route::get('/', function() {
            return view('admin.home');
        })->name('adminHome');
        
        Route::get('/logout', 'AdminAuthController@logout');
        Route::get('/lang/{lang}', function($lang) {
            return changeLanguage($lang);
        })->where('lang', '[a-z]+');
        
        Route::resource('control', 'AdminController');
        Route::delete('control/delete/selected', 'AdminController@deleteSelected');

        Route::resource('users/control', 'UsersController');
        Route::delete('users/control/delete/selected', 'UsersController@deleteSelected');
    });

});