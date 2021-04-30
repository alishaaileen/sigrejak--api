<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// use App\Http\Controllers\Auth\AdminAuthController;
// use App\Http\Controllers\Auth\UserAuthController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::group(['prefix' => 'api'], function () use ($router) {
    // **************************
    // KELUARGA
    // **************************
    Route::post('login', 'KeluargaAuthController@login');
    Route::group(['prefix' => 'keluarga'], function () use ($router) {
        Route::get('/trash', 'KeluargaController@trash');
        Route::get('/profile', 'KeluargaController@profile');
        Route::get('/', 'KeluargaController@index');
        Route::get('/{id}', 'KeluargaController@show');
        Route::post('register', 'KeluargaController@store');
        Route::put('/{id}', 'KeluargaController@update');
        Route::delete('/{id}', 'KeluargaController@destroy');
        Route::get('/anggota/{idKeluarga}', 'KeluargaController@getAllFamilyMember');
    });

    // **************************
    // ADMIN
    // **************************
    Route::post('login-admin', 'AdminAuthController@login');
    Route::group(['prefix' => 'admin',], function () use ($router) {
        Route::get('/sendEmail', 'AdminController@sendEmail');
        $router->get('/', 'AdminController@index');
        $router->get('/sekretariat', 'AdminController@getSekretariat');
        $router->get('/romo', 'AdminController@getRomo');
        Route::get('/profile', 'AdminController@profile');
        // Route::get('/', 'AdminController@index')->middleware(['role.auth:admin','jwt.auth']);
        Route::get('/{id}', 'AdminController@show');
        // Route::post('register', ['middleware' => 'admin', 'jwt.auth'], 'AdminController@store');
        Route::post('register', 'AdminController@store');
        Route::put('/{id}', 'AdminController@update');
        Route::delete('/{id}', 'AdminController@destroy');
    });

    // **************************
    // PAROKI
    // **************************
    Route::group(['prefix' => 'paroki'], function () use ($router) {
        Route::get('/', 'ParokiController@index');
        Route::get('/{id}', 'ParokiController@show');
        Route::post('store', 'ParokiController@store');
        Route::put('/{id}', 'ParokiController@update');
        Route::delete('/{id}', 'ParokiController@destroy');
    });

    // **************************
    // LINGKUNGAN
    // **************************
    Route::group(['prefix' => 'lingkungan'], function () use ($router) {
        Route::get('/', 'LingkunganController@index');
        Route::get('/{id}', 'LingkunganController@show');
        Route::post('store', 'LingkunganController@store');
        Route::put('/{id}', 'LingkunganController@update');
        Route::delete('/{id}', 'LingkunganController@destroy');
    });

    // **************************
    // UMAT
    // **************************
    Route::group(['prefix' => 'umat'], function () use ($router) {
        Route::get('/', 'UmatController@index');
        Route::get('/{id}', 'UmatController@show');
        Route::post('store', 'UmatController@store');
        Route::put('/{id}', 'UmatController@update');
        Route::delete('/{id}', 'UmatController@destroy');
    });

    // **************************
    // DETAIL UMAT
    // **************************
    Route::group(['prefix' => 'detail-umat'], function () use ($router) {
        // Route::get('/', 'UmatController@index');
        Route::get('/{id}', 'DetailUmatController@show');
        Route::post('store', 'DetailUmatController@store');
        Route::put('/{id}', 'DetailUmatController@update');
        // Route::delete('/{id}', 'UmatController@destroy');
    });
});