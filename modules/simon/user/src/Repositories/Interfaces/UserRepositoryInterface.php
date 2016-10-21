<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/10/21
 * Time: 16:26
 */

namespace Simon\User\Repositories\Interfaces;


use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Simon\Kernel\Repositories\RepositoryInterface;
use Simon\User\Models\Secret;
use Simon\User\Models\User;

interface UserRepositoryInterface extends RepositoryInterface
{

    /**
     * @param Request $request
     * @param Agent $agent
     * @param string $secretKey
     * @param array $data
     * @return User
     */
    public function register(Request $request,Agent $agent,Secret $secret,array $data) : User;

}