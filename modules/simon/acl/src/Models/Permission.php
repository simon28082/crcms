<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 11:18
 */
namespace Simon\Acl\Models;

use Simon\Kernel\Models\Model;
use Simon\Kernel\Models\Traits\SoftDeletes;
use Simon\User\Models\User;

class Permission extends Model
{

    use SoftDeletes;

    protected $table = 'acl_permissions';

    public function hasBelongsToManyRole()
    {
        return $this->belongsToMany(AclRole::class,'acl_role_permissions','permission_id','role_id');
    }

    public function hasBelongsToManyUser()
    {
        return $this->belongsToMany(User::class,'user_permissions','permission_id','user_id');
    }

    public function hasOneApp()
    {

    }
}