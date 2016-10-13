<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 19:48
 */

namespace Simon\User\Repositorys;


use Illuminate\Pagination\Paginator;
use Simon\Kernel\Exceptions\AppException;
use Simon\Kernel\Exceptions\ValidateException;
use Simon\Kernel\Repositorys\AbstraceRepository;
use Simon\User\Models\UserMailCode;
use Simon\User\Repositorys\Interfaces\UserMailCodeRepositoryInterface;

class UserMailCodeRepository extends AbstraceRepository implements UserMailCodeRepositoryInterface
{

    protected $mailVerify = null;

    public function __construct(UserMailCode $Model)
    {
        parent::__construct($Model);
    }


    /**
     * 验证成功
     */
    const STATUS_VERIFY_SUCCESS = 1;

    /**
     * 未验证
     */
    const STATUS_NOT_VERIFY = 2;

    /**
     * 验证失败
     */
    const STATUS_VERIFY_FAIL = 3;



    public function statusVerifySuccess()
    {
        return static::STATUS_VERIFY_SUCCESS;
    }

    public function statusVerifyFail()
    {
        return static::STATUS_VERIFY_FAIL;
    }

    public function statusVerifyNotVerify()
    {
        return static::STATUS_NOT_VERIFY;
    }

    public function findByHash(string $hash) : UserMailCode
    {
        return $this->model->where('hash',$hash)->orderBy('id','desc')->firstOrFail();
    }

//    protected function updateStatus(int $status) : bool
//    {
//        // TODO: Implement updateStatus() method.
//
//        //未验证的情况下
//        $this->mailVerify->status = $status;
//        $this->mailVerify->save();
//
//        return true;
//    }

    /**
     * @param User $user
     * @return string
     */
    public function generate(int $userId,string $type) : string
    {
        // TODO: Implement generate() method.

        $hash = sha1(uniqid().str_random(10).time().$userId.str_random(10));

        $this->create([
            'user_id'=>$userId,
            'type'=>$type,
            'hash'=>$hash,
            'status'=>static::STATUS_NOT_VERIFY,
        ]);

        return $hash;
    }

    /**
     * @param int $userId
     * @param string $hash
     * @return bool
     * @throws ValidateException
     */
//    public function verify(User $user,string $hash) : bool
//    {

//        $this->mailVerify = $this->model->where('hash',$hash)->orderBy($this->model->getKeyName(),'desc')->firstOrFail();
//        //判断是否是未验证状态
//        if ($this->mailVerify->status !== static::STATUS_NOT_VERIFY)
//        {
//            return true;
////            throw new ValidateException(trans('user::user.mail_verify_verified'));
//        }
//
//        //验证user_id是否一致
//        if ($this->mailVerify->user_id !== $user->id)
//        {
//            //error Exception
//
//            $this->updateStatus($this->statusVerifyFail());
//
//            throw new AppException(trans('user::user.mail_verify_fail'));
//        }
//
//        //验证时间，
//        if (time() - $this->mailVerify->created_at->getTimestamp() > 24*3600)
//        {
//            $this->updateStatus($this->statusVerifyFail());
//
//            throw new AppException(trans('user::user.mail_verify_timeout'));
//        }
//
//
//        //验证mailCode
//        $user->mail_status =
//
//        try {
//            if ($MailCode->verify($userId,$hash))
//            {
//                //修改mail验证状态
//                $MailCode->updateStatus($MailCode->statusVerifySuccess());
//
//                //修改用户验证状态
//                $this->repository->updateMailStatus($userId,$this->repository->mailStatusVerify());
//            }
//        } catch (AppException $e) {
//            //修改mail验证状态
//            $MailCode->updateStatus($MailCode->statusVerifyFail());
//
//            //throw
//            abort($e::HTTP_CODE,$e->getMessage());
//        }
//
//
//        // TODO: Implement verify() method.
//        $this->
//
//
//
//        //验证user_id是否一致
//        if ($this->mailVerify->user_id !== $userId)
//        {
//            //error Exception
//            throw new AppException(trans('user::user.mail_verify_fail'));
//        }
//
//        //验证时间，
//        if (time() - $this->mailVerify->created_at->getTimestamp() > 24*3600)
//        {
//            throw new AppException(trans('user::user.mail_verify_timeout'));
//        }
//
//        return true;
//    }

}