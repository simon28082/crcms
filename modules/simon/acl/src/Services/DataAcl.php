<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/2
 * Time: 15:39
 */

namespace Simon\Acl\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Simon\Acl\Services\Interfaces\OtherAclInterface;
use Simon\Acl\Services\Interfaces\RoleAclInterface;
use Simon\Acl\Services\Interfaces\UserAclInterface;

class DataAcl extends Acl implements UserAclInterface,OtherAclInterface,RoleAclInterface
{


    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function getUser()
    {
        $user = $this->model->hasOneUser;

        if (empty($user))
        {
            $user = config('acl.acl_user');
        }

        return $user;
    }

    /**
     * 这里的用户权限是获取此条数据的用户的权限
     * !!!非当前在线用户!!!
     * @return mixed
     */
    public function getUserPermission()
    {
        // TODO: Implement getUserPermission() method.
        $userPermission = $this->getUser()->hasBelongsToManyPermission()->get();

        if ($userPermission->isEmpty())
        {
            $userPermission = config('acl.acl_user_permission');
        }

        return $userPermission;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getRole()
    {
        $roles = $this->model->hasBelongsToManyRole()->get();

        //如果当前data为空那么则是user组
        if ($roles->isEmpty())
        {
            //如果用户组也不存在，那么则默认组
            $roles = $this->getUserRole($this->getUser());

            if ($roles->isEmpty())
            {
                $roles = config('acl.acl_role');
            }
        }

        return $roles;
    }


    public function getOther()
    {

        $others = $this->model->hasBelongsToManyOther()->get();

        //未设置则设置默认组
        if ($others->isEmpty())
        {
            $others = config('acl.acl_other');
        }

        return $others;
    }

    public function getOtherPermission()
    {

        $otherPermissions = collect();

        foreach ($this->getOther() as $other)
        {
            $permission = $other->hasBelongsToManyPermission()->get();

            if ($permission->isEmpty())
            {
                $permission = config('acl.acl_other_permission');
            }

            $otherPermissions = $otherPermissions->merge($permission);
        }

        return $otherPermissions;
    }







}