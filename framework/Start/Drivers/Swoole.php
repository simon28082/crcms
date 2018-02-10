<?php

namespace CrCms\Foundation\Start\Drivers;

use CrCms\Foundation\StartContract;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Http\Kernel;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class Swoole
 * @package CrCms\Foundation\Start\Drivers
 */
class Swoole implements StartContract
{
    protected $server;

    protected $app;

    public function __construct()
    {
        $this->server = new Server("0.0.0.0", 22);
    }


    public function start(Container $app): void
    {
        $this->app = $app;

        $this->server->on('request',[$this,'onRequest']);
        $this->server->on('close',[$this,'onClose']);

        $this->server->start();
    }

    public function onClose(Server $server,$fd,int $reactorId)
    {
        dump($server === $this->server);
        echo "close\n";
    }

    public static function capture(Request $request)
    {
        \Illuminate\Http\Request::enableHttpMethodParameterOverride();

        return \Illuminate\Http\Request::createFromBase(static::createFromGlobals($request));
    }

    public static function createFromGlobals(Request $request)
    {
        // With the php's bug #66606, the php's built-in web server
        // stores the Content-Type and Content-Length header values in
        // HTTP_CONTENT_TYPE and HTTP_CONTENT_LENGTH fields.
        $server = $_SERVER;
        if ('cli-server' === PHP_SAPI) {
            if (array_key_exists('HTTP_CONTENT_LENGTH', $_SERVER)) {
                $server['CONTENT_LENGTH'] = $_SERVER['HTTP_CONTENT_LENGTH'];
            }
            if (array_key_exists('HTTP_CONTENT_TYPE', $_SERVER)) {
                $server['CONTENT_TYPE'] = $_SERVER['HTTP_CONTENT_TYPE'];
            }
        }

        $server = array_merge($server,$request->server);

        $server = array_change_key_case($server,CASE_UPPER);

//        dump( $request->server);
//        dump($_SERVER);
//        $request = \Symfony\Component\HttpFoundation\Request::createRequestFromFactory($request->get ?? [], $request->post ?? [], array(), $_COOKIE, $_FILES, $server);
        $symfonyRequest = new \Symfony\Component\HttpFoundation\Request(
            $request->get ?? [],
            $request->post ?? [],
            [],
            $request->cookie ?? [],
            $request->files ?? [],
            $server
        );

        if (0 === strpos($symfonyRequest->headers->get('CONTENT_TYPE'), 'application/x-www-form-urlencoded')
            && in_array(strtoupper($request->server->get('REQUEST_METHOD', 'GET')), array('PUT', 'DELETE', 'PATCH'))
        ) {
            parse_str($symfonyRequest->getContent(), $data);
            $symfonyRequest->request = new ParameterBag($data);
        }

        return $symfonyRequest;
    }

    public function onRequest(Request $request,Response $response)
    {

        $kernel = $this->app->make(\Illuminate\Contracts\Http\Kernel::class);

        $SymfonyRequest = \Illuminate\Http\Request::capture();

        $SymfonyRequest->initialize(
            $request->get ?? [],
            $request->post ?? [],
            [],
            $request->cookie ?? [],
            $request->files ?? [],
            $request->server ?? []
        );

        $illuminateResponse = $kernel->handle($SymfonyRequest);

logger($illuminateResponse->getContent());
        $response->end($illuminateResponse->getContent());

        $kernel->terminate($SymfonyRequest, $illuminateResponse);

//
//        $illuminateRequest = static::capture($request);
//
//        $kernel = $this->app->make(Kernel::class);
//
//        $illuminateResponse = $kernel->handle($illuminateRequest);
//
//        $response->end($illuminateResponse->getContent());
//
//        $kernel->terminate($illuminateRequest, $illuminateResponse);
    }

}