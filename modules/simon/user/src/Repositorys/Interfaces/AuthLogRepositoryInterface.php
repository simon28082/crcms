<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/24
 * Time: 21:42
 */

namespace Simon\User\Repositorys\Interfaces;


use Simon\Kernel\Repositorys\RepositoryInterface;
use Simon\User\Models\User;

interface AuthLogRepositoryInterface extends RepositoryInterface
{


    public function logByAuth(User $User,int $type,int $ip,string $browser = '');

    public function typeRegister();

    public function typeLogin();

    public function type();
}