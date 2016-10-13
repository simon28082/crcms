<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/5
 * Time: 9:21
 */

namespace Simon\Acl\Services\Interfaces;


interface OtherAclInterface
{
    /**
     * 第三方用户或组
     * @return mixed
     */
    public function getOther();

    /**
     * 第三方权限
     * @return mixed
     */
    public function getOtherPermission();
}