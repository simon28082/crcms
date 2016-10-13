<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/5
 * Time: 15:05
 */

namespace Simon\Acl\Models\Acl;


use Simon\Acl\Models\AclRole;
use Simon\Acl\Models\Permission;

trait UserTrait
{

    public function hasBelongsToManyPermission()
    {
        return $this->belongsToMany(Permission::class,'user_permissions','user_id','permission_id');
    }

    public function hasBelongsToManyAclRole()
    {
        return $this->belongsToMany(AclRole::class,'acl_user_roles','user_id','role_id');
    }
}