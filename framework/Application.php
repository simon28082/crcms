<?php

namespace CrCms\Foundation;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as BaseApplication;

/**
 * Class Application
 * @package CrCms
 */
class Application extends BaseApplication implements Container
{
    /**
     * @var string
     */
    protected $modulePath;

    /**
     * @return void
     */
    protected function bindPathsInContainer()
    {
        parent::bindPathsInContainer();

        $this->instance('path.module', $this->modulePath());
    }

    /**
     * @return string
     */
    public function modulePath(): string
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'modules';
    }

    /**
     * @param string $path
     * @return $this
     */
    public function useModulePath(string $path)
    {
        $this->modulePath = $path;

        $this->instance('path.module', $path);

        return $this;
    }

    /**
     * Get the path to the cached services.php file.
     *
     * @return string
     */
    public function getCachedServicesPath()
    {
        return $this->storagePath() . '/run-cache/services.php';
    }

    /**
     * Get the path to the cached packages.php file.
     *
     * @return string
     */
    public function getCachedPackagesPath()
    {
        return $this->storagePath() . '/run-cache/packages.php';
    }

    /**
     * Get the path to the configuration cache file.
     *
     * @return string
     */
    public function getCachedConfigPath()
    {
        return $this->storagePath() . '/run-cache/config.php';
    }
}