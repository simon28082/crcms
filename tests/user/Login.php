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
        $data = ['name'=>'4DKTM1wG06MkHpvy', 'password'=>'123456'];
        $user = app(\Simon\User\Services\LoginService::class);

        $User = app(\Simon\User\Repositorys\UserRepository::class);
        $user = $User->login($data,ip_long(app('request')->ip()));

        return $user;
    }

    /**
     * @depends testLogin
     * @param \Simon\User\Models\User $user
     */
    public function testAuthLog(\Simon\User\Models\User $user)
    {
        auth_logger(2,$user);
    }

}