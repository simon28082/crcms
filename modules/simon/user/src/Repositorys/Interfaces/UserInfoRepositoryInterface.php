<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/27
 * Time: 20:34
 */

namespace Simon\User\Repositorys\Interfaces;


use Simon\Kernel\Repositorys\RepositoryInterface;
use Simon\User\Models\UserInfo;

interface UserInfoRepositoryInterface extends RepositoryInterface
{

    public function findUserInfo(int $id);

}