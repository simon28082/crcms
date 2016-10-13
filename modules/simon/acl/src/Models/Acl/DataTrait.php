<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/5
 * Time: 15:03
 */

namespace Simon\Acl\Models\Acl;


use Simon\Acl\Models\AclOther;
use Simon\Acl\Models\AclRole;
use Simon\User\Models\User;

trait DataTrait
{

    /**
     * @return mixed
     */
    public function hasBelongsToManyRole()
    {
        return $this->belongsToMany(AclRole::class,'acl_data_roles','data_id','role_id')
            ->where('acl_data_roles.type',self::class);
    }

    /**
     * @return mixed
     */
    public function hasBelongsToManyOther()
    {
        return $this->belongsToMany(AclOther::class,'acl_data_others','data_id','other_id')
            ->where('acl_data_others.type',self::class);
    }

    /**
     * @return mixed
     */
    public function hasOneUser()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}