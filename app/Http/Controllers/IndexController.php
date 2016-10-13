<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/30
 * Time: 16:27
 */

namespace App\Http\Controllers;


use App\Notifications\TestNotify;
use Illuminate\Support\Facades\Notification;
use Simon\User\Models\User;

class IndexController
{


    public function getIndex()
    {
        $user = User::find(1);
        $user->email = '28737164@qq.com';
        Notification::send($user,new TestNotify());
    }

}