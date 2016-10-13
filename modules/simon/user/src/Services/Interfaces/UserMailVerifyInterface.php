<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/11
 * Time: 15:23
 */

namespace Simon\User\Services\Interfaces;


use Simon\User\Models\User;
use Simon\User\Models\UserMailCode;

interface UserMailVerifyInterface
{

    public function verify(User $user,UserMailCode $userMailCode) : bool;

}