<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/5
 * Time: 9:21
 */

namespace Simon\Acl\Services\Interfaces;


interface UserAclInterface
{

    /**
     * 获取用户
     * @return mixed
     */
    public function getUser();

    /**
     * 获取用户权限
     * @return mixed
     */
    public function getUserPermission();


}