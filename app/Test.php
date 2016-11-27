<?php

namespace App;


use CrCms\Kernel\Models\MysqlModel;
use Illuminate\Database\Eloquent\Model;

class Test extends MysqlModel
{
    /**
     * 不允许写入的字段，默认解除禁止
     * @var array
     */
    protected $guarded = [];

    protected $table = 'users';

}