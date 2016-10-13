<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 12:11
 */

namespace Simon\Acl\Models;


use Illuminate\Database\Eloquent\Builder;
use Simon\Kernel\Models\Model;
use Simon\Kernel\Models\Traits\SoftDeletes;

class AclAppAuthorize extends Model
{

    use SoftDeletes;


    public function scopeStatus(Builder $query,$status)
    {
        return $query->where('status',$status);
    }

}