<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/20
 * Time: 20:01
 */
namespace Simon\Discuss\Providers;
use Simon\Discuss\Repositorys\DiscussRepository;
use Simon\Discuss\Repositorys\Interfaces\DiscussRepositoryInterface;
use Simon\Kernel\Providers\PackageServiceProvider;


class DiscussServiceProvider extends PackageServiceProvider
{

    protected $defer = false;

    /**
     *
     * @var string
     * @author simon
     */
    protected $namespaceName = 'discuss';

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

        $this->app->bind(DiscussRepositoryInterface::class,DiscussRepository::class);
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