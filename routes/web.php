<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Route::middleware(['api','web'])->version('v1')->group(function () {
//    Route::name('abc')->get('/', function (Request $request) {
//        return app(\CrCms\Foundation\App\Services\ResponseFactory::class)->array(['data'=>'Welcome to CRCMS']);
//    });
//});
Route::get('login2',function(){
    return '<a href="http://passport.local/login?_redirect='.urlencode('http://crcms.local/test').'">Login</a>';
});

Route::get('test',function(){
   echo 123;
});



Route::get('test2',function(\CrCms\Foundation\Rpc\Contracts\RpcContract $rpcContract){
    try {
        $rpcContract->call('test3');
    } catch (\Exception $exception) {
        dd($exception);
    }

});

//Route::get('test2',function(CrCms\Foundation\Client\Client $client){
//    //return $contract->call('test3');
//    $x = $client->connection('user')->setHeaders([
//        'Content-Type' => 'application/json',
//        'Accept' => 'application/json',
//    ])->setMethod('get')->send('test3')->getContent();
//    dd($x);
//});

Route::get('test3',function(){
   return json_encode(['a'=>1]);
});