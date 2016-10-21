<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/10/13
 * Time: 14:45
 */
use Illuminate\Support\Facades\Route;

Route::resource('discusses','DiscussController',[
    'only'=>['index','store','show'],
]);

//$api = app('Dingo\Api\Routing\Router');
//
//$api->version('v1', function ($api) {
//    $api->get('/abc','Simon\Discuss\Http\Controllers\Api\DiscussController@index');
//});