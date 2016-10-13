<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 15:58
 */

namespace Simon\Acl\Models;


use Simon\Kernel\Models\Model;
use Simon\Kernel\Models\Traits\SoftDeletes;

class AclRole extends Model
{

    use SoftDeletes;


//    public function a()
//    {
//        $this->belongsToMany()->attach()
//    }

    public function hasBelongsToManyPermission()
    {
        return $this->belongsToMany(Permission::class,'acl_role_permissions','role_id','permission_id');
    }

}