<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/24
 * Time: 13:20
 */

use Illuminate\Support\Facades\Route;


$router->get('/register/{id?}','AuthController@getRegister')->name('register');
$router->post('/register','AuthController@postRegister')->name('register');

$router->get('/login','AuthController@getLogin')->name('login');
$router->post('/login','AuthController@postLogin')->name('login');

$router->get('/logout','AuthController@getLogout')->name('logout');

$router->post('/forget-password','AuthController@postForgetPassword')->name('forget_password');

$router->get('/verify-mail/{userId}/{hash}','AuthController@getVerifyMailCode')
        ->where('userId','[1-9][\d]*')->name('verify-mail');


$router->get('/auth/geetest','AuthController@getGeetest')->name('geetest');


Route::group(['prefix'=>'user','middleware'=>[Simon\User\Http\Middleware\Authentication::class]],function($router){//,'middleware'=>['user']

    $router->get('/','UserController@getIndex')->name('user');

    $router->get('/basic-information','UserController@getBasicInformation')->name('basic_information');
    $router->post('/basic-information','UserController@postBasicInformation')->name('basic_information');

    $router->get('/update-password','UserController@getUpdatePassword')->name('update_password');
    $router->post('/update-password','UserController@postUpdatePassword')->name('update_password');

    $router->get('/verify-email','UserController@getVerifyEmail')->name('verify_email');
    $router->post('/verify-send-email','UserController@postSendMail')->name('verify_send_email');
    $router->get('/verify-check-email/{userId}/{hash}','UserController@getCheckVerifyEmail')
        ->where('userId','[1-9][\d]*')
        ->name('verify-check-email');
});

//user manage
Route::group(['prefix'=>'manage'],function($router){

    $router->resource('users','Manage\UserController');


});
