<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/4
 * Time: 7:44
 */

namespace Simon\Kernel\Facades;


use Illuminate\Support\Facades\Facade;

class Visited extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'visited';
    }
}