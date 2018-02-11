<?php

namespace CrCms\Foundation\Swoole\Events;

use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use Illuminate\Http\Request as IlluminateRequest;
use Illuminate\Contracts\Http\Kernel;
use Swoole\Server;

/**
 * Class RequestEvent
 * @package CrCms\Foundation\Swoole\Events
 */
class RequestEvent implements EventContract
{
    /**
     * @var SwooleRequest
     */
    protected $request;

    /**
     * @var SwooleResponse
     */
    protected $response;

    /**
     * Request constructor.
     * @param SwooleRequest $request
     * @param SwooleResponse $response
     */
    public function __construct(SwooleRequest $request, SwooleResponse $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return void
     */
    public function handle(Server $server): void
    {
        $kernel = app()->make(Kernel::class);

        $SymfonyRequest = IlluminateRequest::capture();

        $SymfonyRequest->initialize(
            $this->request->get ?? [],
            $this->request->post ?? [],
            [],
            $this->request->cookie ?? [],
            $this->request->files ?? [],
            $this->createServer($this->request->server)
        );

        $illuminateResponse = $kernel->handle($SymfonyRequest);

        $this->response->end($illuminateResponse->getContent());

        $kernel->terminate($SymfonyRequest, $illuminateResponse);
    }

    /**
     * @param array $requestServer
     * @return array
     */
    protected function createServer(array $requestServer): array
    {
        $server = $_SERVER;
        if ('cli-server' === PHP_SAPI) {
            if (array_key_exists('HTTP_CONTENT_LENGTH', $_SERVER)) {
                $server['CONTENT_LENGTH'] = $_SERVER['HTTP_CONTENT_LENGTH'];
            }
            if (array_key_exists('HTTP_CONTENT_TYPE', $_SERVER)) {
                $server['CONTENT_TYPE'] = $_SERVER['HTTP_CONTENT_TYPE'];
            }
        }

        $server = array_merge($server,$requestServer);

        return array_change_key_case($server,CASE_UPPER);
    }
}