<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/11
 * Time: 15:25
 */

namespace Simon\User\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Simon\Kernel\Exceptions\AppException;
use Simon\User\Models\User;
use Simon\User\Models\UserMailCode;
use Simon\User\Repositorys\Interfaces\UserMailCodeRepositoryInterface;
use Simon\User\Repositorys\Interfaces\UserRepositoryInterface;
use Simon\User\Services\Interfaces\UserMailVerifyInterface;

class UserMailVerify implements UserMailVerifyInterface
{
    protected $userRepository = null;

    protected $mailCodeRepository = null;

    protected $mailCodeModel = null;

    protected $userModel = null;

    public function __construct(UserRepositoryInterface $userRepository,UserMailCodeRepositoryInterface $mailCodeRepository)
    {
        $this->userRepository = $userRepository;

        $this->mailCodeRepository = $mailCodeRepository;
    }

    /**
     * @return bool
     * @throws AppException
     */
    protected function checkMailCodeVerifyStatus() : bool
    {
        $status = $this->mailCodeModel->status === $this->mailCodeRepository->statusVerifyNotVerify();
        if (!$status)
        {
            throw new AppException(trans('user::user.mail_verify_verified'));
        }

        return $status;
    }


    /**
     * @return bool
     * @throws AppException
     */
    protected function checkVerifyUser() : bool
    {
        if ($this->mailCodeModel->user_id !== $this->userModel->id)
        {

            $this->updateStatus(false);

            //error Exception
            throw new AppException(trans('user::user.mail_verify_fail'));
        }

        return true;
    }

    /**
     * @return bool
     * @throws AppException
     */
    protected function checkTimeout() : bool
    {
        //验证时间，
        if (time() - $this->mailCodeModel->created_at->getTimestamp() > 24*3600)
        {
            throw new AppException(trans('user::user.mail_verify_timeout'));
        }

        return true;
    }

    /**
     * @param bool $status
     */
    protected function updateStatus(bool $status = true)
    {

        if ($status)
        {
            $mailStatus = $this->mailCodeRepository->statusVerifySuccess();
            $userStatus = $this->userRepository->mailStatusVerify();
        }
        else
        {
            $mailStatus = $this->mailCodeRepository->statusVerifyFail();
            $userStatus = $this->userRepository->mailStatusVerifyFail();
        }

        $this->mailCodeRepository->update(['status'=>$mailStatus],$this->mailCodeModel->id);
        $this->userRepository->update(['mail_status'=>$userStatus],$this->userModel->id);
    }

    /**
     * @param User $user
     * @param UserMailCode $userMailCode
     * @return bool
     * @throws AppException
     */
    public function verify(User $user,UserMailCode $userMailCode) : bool
    {

        $this->userModel = $user;

        $this->mailCodeModel = $userMailCode;

        try {

            $this->checkMailCodeVerifyStatus();

            $this->checkTimeout();

            $this->checkVerifyUser();


        } catch (AppException $e)
        {
            throw $e;
        }


        $this->updateStatus(true);

        return true;
    }

}