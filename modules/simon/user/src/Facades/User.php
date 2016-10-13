<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/25
 * Time: 13:57
 */

namespace Simon\User\Facades;


use Illuminate\Support\Facades\Facade;

class User extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'user';
    }
}