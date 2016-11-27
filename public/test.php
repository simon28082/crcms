<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 16-11-23
 * Time: 下午9:26
 */
class test
{

    const DELETED_AT = 1;
    public function a()
    {
        var_dump(defined('static::DELETED_AT'));
//        dd( defined('static::DELETED_AT') ? static::DELETED_AT : 'deleted_at');
    }

}

(new Test)->a();
