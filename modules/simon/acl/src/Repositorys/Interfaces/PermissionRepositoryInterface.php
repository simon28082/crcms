<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 11:17
 */

namespace Simon\Acl\Repositorys\Interfaces;


use Simon\Kernel\Repositorys\RepositoryInterface;

interface PermissionRepositoryInterface extends RepositoryInterface
{

    public function status() : array;

    public function statusOpen() : int;

    public function statusClose() : int;

}