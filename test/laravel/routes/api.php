<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Auth\AuthController@login')->name('api.login');

    Route::group([
        'middleware' => 'custom_auth_api'
    ], function () {
        Route::post('logout', 'Auth\AuthController@logout')->name('api.logout');
        Route::get('user', 'Auth\AuthController@user')->name('api.user');
        Route::get('userlist','User\UserController@show')->name('api.userlist');
        Route::post('createuserconfirm','User\UserController@createconfirm')->name('api.createconfirm');
        Route::post('createuser','User\UserController@store')->name('api.createuser');
        Route::post('editconfirm/{id}','User\UserController@editconfirm')->name('api.editconfirm');
        Route::post('update/{id}','User\UserController@update')->name('api.update');
        Route::delete('deleteuser/{id}','User\UserController@destroy')->name('api.deleteuser');
        Route::post('changepassword','User\UserController@changepassword')->name('api.changepassword');

        Route::post('createpostconfirm','Post\PostController@postconfirm')->name('api.createpostcomfirm');
        Route::post('createpost','Post\PostController@store')->name('api.createpost');
        Route::get('postlist','Post\PostController@show')->name('api.postlist');
        Route::delete('deletepost/{id}','Post\PostController@destroy')->name('api.deletepost');
        // Route::get('updatepost/{id}','Post\PostController@edit')->name('api.updatepost');
        Route::post('editpost/{id}','Post\PostController@editconfirm')->name('api.editpost');
        Route::post('updatepost/{id}','Post\PostController@update')->name('api.updatepost');
        Route::get('export','Post\PostController@downloadpost')->name('api.export');
        Route::post('import','Post\PostController@uploadFile')->name('api.import');

    });
});
