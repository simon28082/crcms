<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/5
 * Time: 9:22
 */

namespace Simon\Acl\Services\Interfaces;


use Illuminate\Support\Collection;

interface RoleAclInterface
{

    /**
     * 获取角色
     * @return mixed
     */
    public function getRole();

    /**
     * 获取角色权限
     * @return mixed
     */
    public function getRolePermission(Collection $roles = null);

}