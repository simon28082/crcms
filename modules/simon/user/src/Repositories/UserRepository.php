<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/10/21
 * Time: 16:28
 */

namespace Simon\User\Repositories;


use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Simon\Kernel\Repositories\AbstractRepository;
use Simon\User\Models\Secret;
use Simon\User\Models\User;
use Simon\User\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    /**
     * 邮件验证
     */
    const MAIL_STATUS_VERIFY = 1;


    /**
     * 邮件未验证
     */
    const MAIL_STATUS_NOT_VERIFY = 0;


    /**
     * 邮件验证失败
     */
    const MAIL_STATUS_VERIFY_FAIL = 2;


    /**
     *
     */
    const MAIL_STATUS = [
        self::MAIL_STATUS_VERIFY=>'已验证',
        self::MAIL_STATUS_NOT_VERIFY=>'未验证',
        self::MAIL_STATUS_VERIFY_FAIL=>'验证失败',
    ];


    /**
     *
     */
    const MOBILE_STATUS_VERIFY = 1;


    /**
     *
     */
    const MOBILE_STATUS_NOT_VERIFY = 0;


    /**
     *
     */
    const MOBILE_STATUS_VERIFY_FAIL = 2;


    /**
     *
     */
    const MOBILE_STATUS = [
        self::MOBILE_STATUS_VERIFY=>'已验证',
        self::MOBILE_STATUS_NOT_VERIFY=>'未验证',
        self::MOBILE_STATUS_VERIFY_FAIL=>'验证失败',
    ];


    /**
     * 加密后的密码
     * @var null
     */
    protected $secretPassword = null;


    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    /**
     * @return int
     */
    public function mobileStatusVerify() : int
    {
        return static::MOBILE_STATUS_VERIFY_FAIL;
    }


    /**
     * @return int
     */
    public function mobileStatusNotVerify() : int
    {
        return static::MOBILE_STATUS_NOT_VERIFY;
    }


    /**
     * @return int
     */
    public function mobileStatusVerifyFail() : int
    {
        return static::MOBILE_STATUS_VERIFY_FAIL;
    }


    /**
     * @return array
     */
    public function mobileStatus() : array
    {
        return static::MOBILE_STATUS;
    }


    /**
     * @return int
     */
    public function mailStatusVerify() : int
    {
        return static::MAIL_STATUS_VERIFY;
    }


    /**
     * @return int
     */
    public function mailStatusNotVerify() : int
    {
        return static::MAIL_STATUS_NOT_VERIFY;
    }


    /**
     * @return int
     */
    public function mailStatusVerifyFail() : int
    {
        return static::MAIL_STATUS_VERIFY_FAIL;
    }


    /**
     * @return array
     */
    public function mailStatus() : array
    {
        return static::MAIL_STATUS;
    }


    /**
     * @param Request $request
     * @param Agent $agent
     * @param string $secretKey
     * @param array $data
     * @return User
     */
    public function register(Request $request,Agent $agent,Secret $secret,array $data) : User
    {
        return $this->create([
            'name'=>$data['name'],
            'password'=>$this->generatePasswordHash($this->secretPassword($secret->secret_key,$data['password'])),
            'secret_id'=>$secret->id,
            'mail_status'=>static::MAIL_STATUS_NOT_VERIFY,
            'mobile_status'=>static::MOBILE_STATUS_NOT_VERIFY,
            'register_ip'=>ip_long($request->ip()),
            'client'=>$agent->device(),
            'browser'=>$agent->browser(),
        ]);
    }


    /**
     * @param string $secretKey
     * @param string $password
     * @return string
     */
    protected function secretPassword(string $secretKey,string $password) : string
    {
        return $secretKey.$password.$secretKey;
    }


    /**
     * @param string $password
     * @return string
     */
    protected function generatePasswordHash(string $password) : string
    {
        return bcrypt($password);
    }

}