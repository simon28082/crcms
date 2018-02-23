<?php

namespace CrCms\Foundation\Start\Drivers;

use CrCms\Foundation\StartContract;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Str;
use InvalidArgumentException;

/**
 * Class Swoole
 * @package CrCms\Foundation\Start\Drivers
 */
class Swoole implements StartContract
{
    /**
     * @var
     */
    protected $server;

    /**
     * @var
     */
    protected $app;

    /**
     * @var
     */
    protected $config;

    /**
     *
     */
    protected function setConfig()
    {
        $this->config = require_once $this->app->configPath('swoole.php');
    }

    /**
     * @param Container $app
     */
    protected function setApp(Container $app)
    {
        $this->app = $app;
    }

    /**
     *
     */
    protected function initialization()
    {
        $serverDrive = $this->config['servers'][$this->config['server_type']]['drive'];
        $serverParams = array_merge([$this->config['host'], $this->config['port']], $this->config['servers'][$this->config['server_type']]['params']);
        $this->server = new $serverDrive(...$serverParams);
        $this->server->set($this->config['settings']);
    }

    /**
     * @param Container $app
     */
    public function start(Container $app): void
    {
        $this->setApp($app);

        $this->setConfig();

        $this->initialization();

        $this->resolveEvents();

        $this->server->start();
    }

    /**
     * @param string $name
     * @param string $event
     */
    protected function eventsCallback(string $name, string $event)
    {
        if (!class_exists($event)) {
            return;
        }

        $this->server->on(Str::camel($name), function () use ($name, $event) {
            $this->setEvents(Str::camel($name), $event, $this->filterServerParams(func_get_args()));
            $this->server->{Str::camel($name)}->handle($this->server);
        });
    }

    /**
     *
     */
    protected function resolveEvents()
    {
        foreach ($this->config['events'] as $name => $event) {
            if (is_array($event)) {
                if ($name === $this->config['server_type']) {
                    foreach ($event as $subName => $subEvent) {
                        $this->eventsCallback($subName, $subEvent);
                    }
                }
            } else {
                $this->eventsCallback($name, $event);
            }
        }
    }

    /**
     * @param array $args
     * @return array
     */
    protected function filterServerParams(array $args): array
    {
        return collect($args)->filter(function ($item) {
            return !($item instanceof \Swoole\Server);
        })->toArray();
    }

    /**
     * @param string $name
     * @param string $event
     * @param array $args
     * @return void
     */
    protected function setEvents(string $name, string $event, array $args): void
    {
        $this->server->{$name} = new $event(...$args);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        if (in_array(
            Str::snake($name),
            array_keys($this->config['events']), true
        )) {
            return $this->{Str::snake($name)};
        }

        throw new InvalidArgumentException('The attributes is not exists');
    }
}