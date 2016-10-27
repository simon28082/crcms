<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/10/26
 * Time: 15:01
 */
use Illuminate\Support\Facades\Route;

//路由命名
//模块.controller.function.post|get

Route::group(['prefix'=>'manage'],function ($router){
    $router->get('/index','IndexController@getIndex')->name('manage.index.index.get');
    $router->get('/description','IndexController@getDescription')->name('manage.index.description.get');
});