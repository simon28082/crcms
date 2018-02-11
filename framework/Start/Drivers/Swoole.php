<?php

namespace CrCms\Foundation\Start\Drivers;

use CrCms\Foundation\StartContract;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Http\Kernel;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Config\Repository;

/**
 * Class Swoole
 * @package CrCms\Foundation\Start\Drivers
 */
class Swoole implements StartContract
{
    protected $server;

    protected $app;

    protected $config;

    public function __construct()
    {

    }

    protected function setConfig()
    {
        $this->config = require_once $this->app->configPath('swoole.php');
    }

    protected function setApp(Container $app)
    {
        $this->app = $app;
    }

    protected function initialization()
    {
        $this->server = new Server($this->config['host'], $this->config['port']);
    }

    public function start(Container $app): void
    {
        $this->setApp($app);

        $this->setConfig();

        $this->initialization();

        $this->server->on('request', [$this, 'onRequest']);
        $this->server->on('close', [$this, 'onClose']);

        $this->server->start();
    }

    public function onClose(Server $server, $fd, int $reactorId)
    {
        return (
        new \CrCms\Foundation\Swoole\Events\CloseEvent($fd, $reactorId)
        )->handle($this->server);
    }

    public function onRequest(Request $request, Response $response)
    {
        return (
        new \CrCms\Foundation\Swoole\Events\RequestEvent($request, $response)
        )->handle($this->server);
    }


}