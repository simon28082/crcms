<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/20
 * Time: 20:01
 */
namespace Simon\Mail\Providers;
use Simon\Kernel\Providers\PackageServiceProvider;
use Illuminate\Support\ServiceProvider;
use Simon\Mail\Repositorys\Interfaces\MailRepositoryInterface;
use Simon\Mail\Repositorys\MailRepository;
use Simon\Mail\Services\Interfaces\MailInterface;
use Simon\Mail\Services\MailService;


class MailServiceProvider extends PackageServiceProvider
{

    protected $defer = false;

    /**
     *
     * @var string
     * @author simon
     */
    protected $namespaceName = 'mail';

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

        $this->app->bind(MailInterface::class,MailService::class);
        $this->app->bind(MailRepositoryInterface::class,MailRepository::class);
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