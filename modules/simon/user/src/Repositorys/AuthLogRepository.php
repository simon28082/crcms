<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/24
 * Time: 21:42
 */

namespace Simon\User\Repositorys;


use Simon\Kernel\Repositorys\AbstraceRepository;
use Simon\User\Models\AuthLog;
use Simon\User\Models\User;
use Simon\User\Repositorys\Interfaces\AuthLogRepositoryInterface;

class AuthLogRepository extends AbstraceRepository implements AuthLogRepositoryInterface
{

    const TYPE_REGISTER = 1;

    const TYPE_LOGIN = 2;

    public function __construct(AuthLog $Model)
    {
        parent::__construct($Model);
    }

    public function typeRegister()
    {
        return static::TYPE_REGISTER;
    }

    public function typeLogin()
    {
        return static::TYPE_LOGIN;
    }

    public function type()
    {

    }

    public function logByAuth(User $User,int $type, int $ip, string $browser = '')
    {
        // TODO: Implement logByAuth() method.
        $this->create([
            'user_id'=>$User->id,
           'name'=>$User->name,
            'type'=>$type,
            'client_ip'=>$ip,
            'browser'=>$browser,
        ]);
    }


}