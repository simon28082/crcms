<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/23
 * Time: 10:21
 */

namespace Simon\User\Services;


use Simon\User\Models\User;
use Simon\User\Services\Interfaces\AuthInterface;
use Simon\User\Services\Interfaces\UserAuthInterface;

class UserAuthService implements UserAuthInterface
{

    protected $userSessionKey = 'user_session';

    /**
     * @param User $User
     */
    public function login(User $User)
    {
        // TODO: Implement login() method.
        session([$this->userSessionKey=>$User]);
        return $User;
    }


    public function logout()
    {
        // TODO: Implement logout() method.
        session()->forget($this->userSessionKey);
        session()->flush();
    }

    public function id()
    {
        // TODO: Implement id() method.
        return session($this->userSessionKey)->id;
    }

    public function user()
    {
        // TODO: Implement user() method.
        return session($this->userSessionKey);
    }

}