<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 19:47
 */

namespace Simon\User\Repositorys\Interfaces;


use Simon\Kernel\Repositorys\RepositoryInterface;
use Simon\User\Models\User;
use Simon\User\Models\UserMailCode;

interface UserMailCodeRepositoryInterface extends RepositoryInterface
{

    /**
     * @return mixed
     */
    public function statusVerifySuccess();

    /**
     * @return mixed
     */
    public function statusVerifyFail();

    /**
     * @return mixed
     */
    public function statusVerifyNotVerify();

    /**
     * @param int $userId
     * @return string
     */
    public function generate(int $userId,string $type) : string;

    /**
     * @param User $user
     * @param string $hash
     * @return bool
     */
//    public function verify(User $user,string $hash) : bool ;

    /**
     * @param string $hash
     * @return UserMailCode
     */
    public function findByHash(string $hash) : UserMailCode;

    /**
     * @param int $status
     * @return bool
     */
//    public function updateStatus(int $status) : bool;

}