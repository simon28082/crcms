<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/25
 * Time: 14:13
 */

namespace Simon\User\Http\Controllers;


use Simon\Kernel\Http\Controllers\Controller;
use Simon\User\Facades\User;
use Simon\User\Http\Requests\BasicInformationRequest;
use Simon\User\Http\Requests\UpdatePasswordRequest;
use Simon\User\Repositorys\Interfaces\UserInfoRepositoryInterface;
use Simon\User\Repositorys\Interfaces\UserMailCodeRepositoryInterface;
use Simon\User\Repositorys\Interfaces\UserRepositoryInterface;
use Simon\User\Mails\VerifyUserMail;

class UserController extends Controller
{

    protected $view = 'user::default.user.';

    public function __construct(UserRepositoryInterface $UserRepository)
    {
        parent::__construct();
        $this->repository = $UserRepository;
    }


    public function getIndex()
    {
        return $this->view('index');
    }

    public function postBasicInformation(BasicInformationRequest $BasicInformationRequest,UserInfoRepositoryInterface $UserInfo)
    {
        $userId = User::id();

        $UserInfo->findById($userId)
            ?
            $UserInfo->update($this->input,$userId)
            :
            $UserInfo->create($this->input);

        return $this->response(['kernel::app.success']);
    }

    public function getBasicInformation(UserInfoRepositoryInterface $UserInfoRepository)
    {
        $userInfo = $UserInfoRepository->findUserInfo(User::id());

        return $this->view('basic-information',compact('userInfo'));
    }

    public function getUpdatePassword()
    {
        return $this->view('update-password');
    }

    public function postUpdatePassword(UpdatePasswordRequest $UpdatePasswordRequest)
    {

        $this->repository->comparePassword($this->input['old_password'],User::user());

        $password = $this->repository->generatePassword($this->input['password'],User::user()->secret_key);

        $this->repository->updatePassword($password,User::user());

        return $this->response(['kernel::app.success']);
    }

    public function getVerifyEmail()
    {
        return $this->view('verify-email');
    }

    public function postSendMail(UserMailCodeRepositoryInterface $userMailCode)
    {
        $hash = $userMailCode->generate(User::user()->id,VerifyUserMail::class);

        mailer(User::user()->email,new VerifyUserMail(User::user(),$hash));

        return $this->response(['kernel::app.success']);
    }

    public function getCheckVerifyEmail(UserMailCodeRepositoryInterface $userMailCode,$userId,$hash)
    {
        try {
            if ($userMailCode->verify($userId,$hash))
            {
                //修改mail验证状态
                $userMailCode->updateStatus($userMailCode->statusVerifySuccess());

                //修改用户验证状态
                $this->repository->updateMailStatus($userId,$this->repository->mailStatusVerify());
            }
        } catch (AppException $e) {
            //修改mail验证状态
            $userMailCode->updateStatus($userMailCode->statusVerifyFail());

            //throw
            abort($e::HTTP_CODE,$e->getMessage());
        }

        return $this->redirectRoute('user');
    }

}