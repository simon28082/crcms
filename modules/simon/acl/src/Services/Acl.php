<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/5
 * Time: 9:27
 */

namespace Simon\Acl\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Simon\User\Models\User;

abstract class Acl
{

    protected $model = null;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 获取角色权限
     * @return \Illuminate\Support\Collection|static
     */
    public function getRolePermission(Collection $roles = null)
    {
        // TODO: Implement getRolePermission() method.
        $rolePermissions = collect();

        $roles = empty($roles) ? $this->getRole() : $roles;

        foreach ($roles as $role)
        {
            //查询当前组的权限
            $rolePermission = $role->hasBelongsToManyPermission()->get();

            //没有权限则为默认组的权限
            if ($rolePermission->isEmpty())
            {
                $rolePermission = config('acl.acl_role_permission');
            }

            //合并所有集合
            $rolePermissions = $rolePermissions->merge($rolePermission);
        }

        return $rolePermissions;
    }


    /**
     * 获取用户组
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    protected function getUserRole(User $user)
    {

        // TODO: Implement getRole() method.
        $roles = $user->hasBelongsToManyAclRole()->get();

        return $roles;
    }
}