<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 9:48
 */
namespace Simon\User\Http\Controllers;
use Germey\Geetest\CaptchaGeetest;
use Illuminate\Support\Facades\Mail;
use Simon\Filter\Drives\XssFilter;
use Simon\Filter\Facades\Input;
use Simon\Kernel\Exceptions\AppException;
use Simon\Kernel\Exceptions\ValidateException;
use Simon\Kernel\Facades\Visited;
use Simon\Kernel\Http\Controllers\Controller;
use Simon\Mail\Repositorys\MailRepository;
use Simon\Safe\Container;
use Simon\Safe\Listeners\VerifyCode;
use Simon\User\Facades\User;
use Simon\User\Http\Requests\LoginRequest;
use Simon\User\Http\Requests\RegisterRequest;
use Simon\User\Mails\RegisterMail;
use Simon\User\Repositorys\AuthLogRepository;
use Simon\User\Repositorys\Interfaces\AuthLogRepositoryInterface;
use Simon\User\Repositorys\Interfaces\UserMailCodeRepositoryInterface;
use Simon\User\Repositorys\Interfaces\UserRepositoryInterface;
use Simon\User\Repositorys\UserMailCodeRepository;
use Simon\User\Repositorys\UserRepository;
use Simon\User\Services\Interfaces\UserMailVerifyInterface;


class AuthController extends Controller
{

    use CaptchaGeetest;

    protected $repository = null;

    protected $view = 'user::default.auth.';

    public function __construct(UserRepositoryInterface $User)
    {
        parent::__construct();
        $this->repository = $User;
    }

    public function getLogout()
    {
        User::logout();
        return $this->redirectRoute('login');
    }

    public function getLogin(LoginRequest $LoginRequest)
    {
//        Input::bind(new XssFilter());

//        dd(Input::instance($this->input)->filter(new XssFilter())->all());
//
//        dd(Input::except('abc')) ;
//
//
//
//
//        exit();

//        $openVerify = $LoginRequest->isOpenVerifyCode();
//        $result = (new Container())->notify();
//        dd($result);

        var_dump(safe()->notify(new VerifyCode()));

        $openVerify  = false;
        return $this->view('login',compact('openVerify'));
    }

    /**
     * @param LoginRequest $LoginRequest
     * @param LoginInterface $Login
     */
    public function postLogin(LoginRequest $LoginRequest)
    {
        Visited::put();

        //verify
        $user = $this->repository->login($this->input,ip_long($this->request->ip()));

        User::login($user);

        return $this->redirectRoute('user');
    }

    public function getRegister(RegisterRequest $RegisterRequest)
    {

//        dd(
//            $this->request->path(),
//            $this->request->url(),$this->request->fullUrl(),$this->request->route(),
//            $this->request->root(),
//
//            $this->request->route()->getName(),
//            $this->request->route()->getAction(),
//            $this->request->route()->getUri(),
//            $this->request->route()->getPrefix(),
//            $this->request->route()->parameters(),
//            $this->request->route()->getActionName()
//        );

        $openVerify = $RegisterRequest->isOpenVerifyCode();

        return $this->view('register',compact('openVerify'));
    }

    public function postRegister(RegisterRequest $RegisterRequest,UserMailCodeRepositoryInterface $UserMailCode,AuthLogRepositoryInterface $AuthLog)
    {

        //Register
//        $user = $Register->register($this->input)->getUser();
        $user = $this->repository->register($this->input,ip_long($this->request->ip()));


        //mailCode
        $hash = $UserMailCode->generate($user->id,RegisterMail::class);

        //mail
        mailer($user->email,new RegisterMail($user,$hash));

        //auth logger
        auth_logger($AuthLog->typeRegister(),$user);

        //session login
        User::login($user);

        return $this->redirectRoute('user');
    }


    public function getVerifyMailCode(UserMailVerifyInterface $userMailVerify,UserMailCodeRepositoryInterface $MailCode,$userId,$hash)
    {

        $mailCode = $MailCode->findByHash($hash);
        $user = $this->repository->findById($userId);

        $userMailVerify->verify($user, $mailCode);

//        return $this->response(['kernel::app.success']);


        return $this->redirectRoute('user');
    }

}
