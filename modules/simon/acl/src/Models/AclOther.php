<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 15:59
 */

namespace Simon\Acl\Models;


use Simon\Kernel\Models\Model;
use Simon\Kernel\Models\Traits\SoftDeletes;

class AclOther extends Model
{

    use SoftDeletes;

    public function hasBelongsToManyPermission()
    {
        return $this->belongsToMany(Permission::class,'acl_other_permissions','other_id','permission_id');
    }


}