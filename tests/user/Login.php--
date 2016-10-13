<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/25
 * Time: 12:28
 */
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Login extends TestCase
{

//    public function userDataProvider()
//    {
//        return [
//          'name'=>'fdasfsdfada',
//            'password'=>'123456',
//        ];
//    }

    /**
     *
     */
    public function testLogin()
    {
        $data = ['name'=>'dGh2nbs9NJK6VUJi', 'password'=>'123456'];
        $user = app(\Simon\User\Services\LoginService::class);

        $user = $user->login($data)->getUser();

        return $user;
    }

    /**
     * @depends testLogin
     * @param \Simon\User\Models\User $user
     */
    public function testAuthLog(\Simon\User\Models\User $user)
    {
        auth_loger(\Simon\User\Repositorys\AuthLogRepository::TYPE_LOGIN,$user);
    }

}