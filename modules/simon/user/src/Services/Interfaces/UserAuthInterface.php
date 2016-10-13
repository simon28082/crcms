<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/25
 * Time: 13:33
 */

namespace Simon\User\Services\Interfaces;


use Simon\User\Models\User;

interface UserAuthInterface
{

    public function login(User $user);

    public function logout();

    public function id();

    public function user();

}