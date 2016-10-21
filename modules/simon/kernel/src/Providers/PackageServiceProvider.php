<?php
namespace Simon\Kernel\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
abstract class PackageServiceProvider extends ServiceProvider
{
	
	/**
	 * 
	 * @var string
	 * @author simon
	 */
	protected $namespaceName = null;
	
	
	/**
	 * 
	 * @var string
	 * @author simon
	 */
	protected $packagePath = null;
	
	/**
	 *
	 *
	 * @author simon
	 */
	public function boot()
	{
		//加载路由

		$this->setupWebRoutes();
		$this->setupApiRoutes();

		//加载视图
		$this->loadViewsFrom($this->packagePath.'views',$this->namespaceName);
		 
		//加载语言包
		$this->loadTranslationsFrom($this->packagePath.'lang', $this->namespaceName);

        //加载数据迁移
        $this->loadMigrationsFrom($this->packagePath.'migrations');

		//移动目录
		$this->publishes([
//     			$this->packagePath.'config' => config_path(),
//     			$this->packagePath.'views' => base_path('resources/views/vendor/'.$this->namespaceName),
//     			$this->packagePath.'database'=>database_path(),
		]);
	}
	
	/**
	 *
	 * (non-PHPdoc)
	 * @see \Illuminate\Support\ServiceProvider::register()
	 * @author simon
	 */
	public function register()
	{
	    $configFile = $this->packagePath."config/{$this->namespaceName}.php";

        if (file_exists($configFile))
        {
            $this->mergeConfigFrom($configFile, $this->namespaceName);
        }

	}

    /**
     *
     */
	protected function setupWebRoutes()
    {
        if (! $this->app->routesAreCached()) {
            Route::group([
                'middleware' => 'web',
                'namespace' => 'Simon\\' . ucwords($this->namespaceName) . '\Http\Controllers',
            ], function ($router) {
                $file = $this->packagePath . 'routes' . DIRECTORY_SEPARATOR . 'web.php';
                file_exists($file) && require $file;
            });
        }
    }

    /**
     *
     */
    protected function setupApiRoutes()
    {
        if (! $this->app->routesAreCached())
        {
            Route::group([
                'middleware' => ['api'],
                'prefix'=>'api',
                'namespace' => 'Simon\\'.ucwords($this->namespaceName).'\Http\Controllers\Api',
            ], function ($router) {
                $file = $this->packagePath.'routes'.DIRECTORY_SEPARATOR.'api.php';
                file_exists($file) && require $file;
            });
        }
    }
}