<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/10/21
 * Time: 17:12
 */

namespace Simon\User\Models;


use Simon\Kernel\Models\Model;
use Simon\Kernel\Models\Traits\SoftDeletes;

class Secret extends Model
{

    use SoftDeletes;

}