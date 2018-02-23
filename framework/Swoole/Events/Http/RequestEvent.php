<?php

namespace CrCms\Foundation\Swoole\Events\Http;

use Carbon\Carbon;
use CrCms\Foundation\Swoole\Events\AbstractEvent;
use CrCms\Foundation\Swoole\Events\EventContract;
use Illuminate\Http\Response as IlluminateResponse;
use Swoole\Async;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use Illuminate\Http\Request as IlluminateRequest;
use Illuminate\Contracts\Http\Kernel;
use Swoole\Server;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

/**
 * Class RequestEvent
 * @package CrCms\Foundation\Swoole\Events
 */
class RequestEvent extends AbstractEvent implements EventContract
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
     * @var IlluminateRequest
     */
    protected $illuminateRequest;

    /**
     * @var IlluminateResponse
     */
    protected $illuminateResponse;

    /**
     * Request constructor.
     * @param SwooleRequest $request
     * @param SwooleResponse $response
     */
    public function __construct(SwooleRequest $request, SwooleResponse $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->illuminateRequest = $this->createIlluminateRequest();
        $this->illuminateResponse = $this->createIlluminateResponse();
    }

    /**
     * @return void
     */
    public function handle(Server $server): void
    {
        parent::handle($server);

        $this->requestLog();

        $this->setResponse();
    }

    /**
     *
     */
    protected function setResponse()
    {
        $this->response->status($this->illuminateResponse->getStatusCode());

        foreach ($this->illuminateResponse->headers->allPreserveCaseWithoutCookies() as $key => $value) {
            $this->response->header($key, implode(';', $value));
        }

        foreach ($this->illuminateResponse->headers->getCookies() as $cookie) {
            $this->response->cookie(
                $cookie->getName(),
                $cookie->getValue(),
                $cookie->getExpiresTime(),
                $cookie->getPath(),
                $cookie->getDomain(),
                $cookie->isSecure(),
                $cookie->isHttpOnly()
            );
        }

        //$this->response->gzip(1);

        $this->response->end($this->illuminateResponse->getContent());

        $kernel = app()->make(Kernel::class);
        $kernel->terminate($this->illuminateRequest, $this->illuminateResponse);
    }

    /**
     * @return IlluminateResponse
     */
    protected function createIlluminateResponse(): Response
    {
        $kernel = app()->make(Kernel::class);

        return $kernel->handle($this->illuminateRequest);
    }

    protected function createFromGlobals(): SymfonyRequest
    {
        // With the php's bug #66606, the php's built-in web server
        // stores the Content-Type and Content-Length header values in
        // HTTP_CONTENT_TYPE and HTTP_CONTENT_LENGTH fields.
//        $server = $_SERVER;
//        if ('cli-server' === PHP_SAPI) {
//            if (array_key_exists('HTTP_CONTENT_LENGTH', $_SERVER)) {
//                $server['CONTENT_LENGTH'] = $_SERVER['HTTP_CONTENT_LENGTH'];
//            }
//            if (array_key_exists('HTTP_CONTENT_TYPE', $_SERVER)) {
//                $server['CONTENT_TYPE'] = $_SERVER['HTTP_CONTENT_TYPE'];
//            }
//        }

//        $request = ::createRequestFromFactory($_GET, $_POST, array(), $_COOKIE, $_FILES, $server);
        $request = new SymfonyRequest(
            $this->request->get ?? [],
            $this->request->post ?? [],
            [],
            $this->request->cookie ?? [],
            $this->request->files ?? [],
            $this->mergeServerInfo(),
            $this->request->rawContent()
        );

        if (0 === strpos($request->headers->get('CONTENT_TYPE'), 'application/x-www-form-urlencoded')
            && in_array(strtoupper($request->server->get('REQUEST_METHOD', 'GET')), array('PUT', 'DELETE', 'PATCH'))
        ) {
            parse_str($request->getContent(), $data);
            $request->request = new ParameterBag($data);
        }

        return $request;
    }

    /**
     * @return IlluminateRequest
     */
    protected function createIlluminateRequest(): IlluminateRequest
    {
        IlluminateRequest::enableHttpMethodParameterOverride();

        return IlluminateRequest::createFromBase($this->createFromGlobals());


        $illuminateRequest = IlluminateRequest::capture();
        dump($this->request->header, $this->request->rawContent(), $_SERVER, $this->request->server);
//        $illuminateRequest->initialize(
//            $this->request->get ?? [],
//            $this->request->post ?? [],
//            [],
//            $this->request->cookie ?? [],
//            $this->request->files ?? [],
//            $this->mergeServerInfo()
//        );

        return $illuminateRequest;
    }

    /**
     * @return array
     */
    protected function mergeServerInfo(): array
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

        $requestHeader = collect($this->request->header)->mapWithKeys(function ($item, $key) {
//            return in_array(strtolower($key), ['content-length', 'content-type', 'content-md5'], true) ?
//                [str_replace('-', '_', $key) => $item] :
               return ['http_' . str_replace('-', '_', $key) => $item];
        })->toArray();

        dump($this->request->header,$requestHeader);
        $server = array_merge($server, $this->request->server,$requestHeader);//,$requestHeader

        return array_change_key_case($server, CASE_UPPER);
    }

    /**
     *
     */
    protected function requestLog()
    {
        $file = storage_path('logs/' . date('Y-m-d') . '.log');

        $params = http_build_query($this->illuminateRequest->all());
        $currentTime = Carbon::now()->toDateTimeString();
        $header = http_build_query($this->illuminateRequest->headers->all());

        $requestTime = Carbon::createFromTimestamp($this->illuminateRequest->server('REQUEST_TIME'));
        $content = "RecordTime:{$currentTime} RequestTime:{$requestTime} METHOD:{$this->illuminateRequest->method()} IP:{$this->illuminateRequest->ip()} Params:{$params} Header:{$header}" . PHP_EOL;

        Async::writeFile($file, $content, null, FILE_APPEND);
    }
}