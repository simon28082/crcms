<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/20
 * Time: 20:01
 */
namespace Simon\User\Providers;
use Simon\Kernel\Providers\PackageServiceProvider;
use Illuminate\Support\ServiceProvider;
use Simon\User\Repositorys\AuthLogRepository;
use Simon\User\Repositorys\Interfaces\AuthLogRepositoryInterface;
use Simon\User\Repositorys\Interfaces\UserInfoRepositoryInterface;
use Simon\User\Repositorys\Interfaces\UserMailCodeRepositoryInterface;
use Simon\User\Repositorys\Interfaces\UserRepositoryInterface;
use Simon\User\Repositorys\UserInfoRepository;
use Simon\User\Repositorys\UserMailCodeRepository;
use Simon\User\Repositorys\UserRepository;
use Simon\User\Services\AuthLogService;
use Simon\User\Services\Interfaces\AuthLogInterface;
use Simon\User\Services\Interfaces\MailCodeInterface;
use Simon\User\Services\Interfaces\RegisterInterface;
use Simon\User\Services\Interfaces\UserAuthInterface;
use Simon\User\Services\Interfaces\UserMailCodeInterface;
use Simon\User\Services\Interfaces\UserMailVerifyInterface;
use Simon\User\Services\MailCodeService;
use Simon\User\Services\RegisterService;
use Simon\User\Services\UserAuthService;
use Simon\User\Services\UserMailCodeService;
use Simon\User\Services\UserMailVerify;


class UserServiceProvider extends PackageServiceProvider
{

    protected $defer = false;

    /**
     *
     * @var string
     * @author simon
     */
    protected $namespaceName = 'user';

    /**
     *
     * @var string
     * @author simon
     */
    protected $packagePath = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;


    /**
     *
     */
    public function register()
    {
        parent::register();

        $this->app->bind(RegisterInterface::class,RegisterService::class);

        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);

        $this->app->bind(UserMailCodeRepositoryInterface::class,UserMailCodeRepository::class);
        $this->app->bind(UserMailCodeInterface::class,UserMailCodeService::class);

        $this->app->bind(AuthLogRepositoryInterface::class,AuthLogRepository::class);
        $this->app->bind(AuthLogInterface::class,AuthLogService::class);

        $this->app->bind(UserInfoRepositoryInterface::class,UserInfoRepository::class);

        $this->app->bind(UserMailVerifyInterface::class,UserMailVerify::class);

        //UserAuth
        $this->app->singleton([
            UserAuthInterface::class=>'user'
        ],UserAuthService::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
//        return [RegisterInterface::class,UserRepositoryInterface::class];
    }



}