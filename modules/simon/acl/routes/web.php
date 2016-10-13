<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 13:49
 */
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'manage/acl'],function($router){

    $router->resource('permissions','Manage\PermissionController');
    $router->resource('authorizes','Manage\AuthorizeController');
    $router->resource('roles','Manage\RoleController');
    $router->resource('others','Manage\OtherController');

    $router->resource('tests','Manage\TestController');

});
