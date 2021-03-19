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
use App\Http\Controllers\Auth\UserAuthController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::group(['prefix' => 'api'], function () use ($router) {
    // **************************
    // KELUARGA
    // **************************
    Route::post('login', [UserAuthController::class,'login']);
    Route::group(['prefix' => 'keluarga'], function () use ($router) {
        Route::get('/trash', 'KeluargaController@trash');
        Route::get('/profile', 'KeluargaController@profile');
        Route::get('/', 'KeluargaController@index');
        Route::get('/{id}', 'KeluargaController@show');
        Route::post('register', 'KeluargaController@store');
        Route::put('/{id}', 'KeluargaController@update');
        Route::delete('/{id}', 'KeluargaController@destroy');
    });

    // **************************
    // ADMIN
    // **************************
    Route::post('login-admin', 'AdminAuthController@login');
    Route::group(['prefix' => 'admin',], function () use ($router) {
        $router->get('/', 'AdminController@index');
        // Route::get('/profile', 'AdminController@profile')->middleware(['assign.guard:superAdmin, romo, sekretariat','jwt.auth']);
        // Route::get('/', 'AdminController@index')->middleware(['assign.guard:superAdmin, romo, sekretariat','jwt.auth']);
        Route::get('/{id}', 'AdminController@show');
        Route::post('register', ['middleware' => 'admin', 'jwt.auth'], 'AdminController@store');
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
});