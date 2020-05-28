<?php
Route::group([
    'middleware' => 'api',
], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');
    Route::get('trading', 'Api\TradingController@getAllTradingData');

    Route::group([
        'middleware' => 'auth:api',
    ], function() {
        Route::post('trading', 'Api\TradingController@addEntryList');
        Route::get('trading/{date}', 'Api\TradingController@getTradingData');
    });
});