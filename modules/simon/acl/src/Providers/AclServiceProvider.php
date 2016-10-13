<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/20
 * Time: 20:01
 */
namespace Simon\Acl\Providers;
use Simon\Acl\Repositorys\AuthorizeRepository;
use Simon\Acl\Repositorys\Interfaces\AuthorizeRepositoryInterface;
use Simon\Acl\Repositorys\Interfaces\OtherRepositoryInterface;
use Simon\Acl\Repositorys\Interfaces\PermissionRepositoryInterface;
use Simon\Acl\Repositorys\Interfaces\RoleRepositoryInterface;
use Simon\Acl\Repositorys\OtherRepository;
use Simon\Acl\Repositorys\PermissionRepository;
use Simon\Acl\Repositorys\RoleRepository;
use Simon\Kernel\Providers\PackageServiceProvider;


class AclServiceProvider extends PackageServiceProvider
{

    protected $defer = false;

    /**
     *
     * @var string
     * @author simon
     */
    protected $namespaceName = 'acl';

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

        $this->app->bind(PermissionRepositoryInterface::class,PermissionRepository::class);
        $this->app->bind(AuthorizeRepositoryInterface::class,AuthorizeRepository::class);
        $this->app->bind(OtherRepositoryInterface::class,OtherRepository::class);
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }



}