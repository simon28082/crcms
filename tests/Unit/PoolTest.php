<?php

namespace Tests\Unit;

use CrCms\Foundation\Rpc\Client\ConnectionFactory;
use CrCms\Foundation\Rpc\Client\ConnectionPool;
use CrCms\Foundation\Rpc\Client\Connections\SocketConnection;
use CrCms\Foundation\Rpc\Client\Connectors\SocketConnector;
use CrCms\Foundation\Rpc\Client\Selectors\RandSelector;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PoolTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function testExample()
    {
        $this->assertTrue(true);
    }*/

    protected $pool;

    /**
     * @var ConnectionFactory
     */
    protected $factory;

    protected $config;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->pool = $this->makeConnectionPool();
        $this->factory = $this->app->make(ConnectionFactory::class);
        $this->config = $this->app->make('config')->get('rpc');
    }

    public function makeConnectionPool()
    {
        return new ConnectionPool(new RandSelector());
    }

    protected function makeConnections()
    {
        $newConnection = [];

        $connections = $this->config['connections'][$this->config['default']];

        foreach ($connections as $connection) {
            $newConnection[] = $this->factory->make($this->config['default'],$connection);
        }

        return $newConnection;
    }

    public function testSetConnections()
    {

        $this->pool->setConnections($this->config['default'],$this->makeConnections());

        $this->assertEquals(count($this->pool->getAllConnections()),count($this->config['connections'][$this->config['default']]));
    }

    public function testAddConnection()
    {
        $this->pool->addConnection($this->config['default'],$this->makeConnections()[0]);
        $this->assertEquals(count($this->pool->getAllConnections()),count($this->config['connections'][$this->config['default']])+1);
    }

    public function testDisconnect()
    {
        $connection = $this->pool->nextConnection($this->config['default']);
        $connection->markDead();

        $this->pool->deathConnection($this->config['default']);

        $this->assertEquals(count($this->pool->getAllConnections()),count($this->config['connections'][$this->config['default']]));
    }
}
