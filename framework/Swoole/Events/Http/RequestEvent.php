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
use Symfony\Component\HttpFoundation\Response;

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
    public function handle(Server $server) : void
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
    protected function createIlluminateResponse() : Response
    {
        $kernel = app()->make(Kernel::class);

        return $kernel->handle($this->illuminateRequest);
    }

    /**
     * @return IlluminateRequest
     */
    protected function createIlluminateRequest() : IlluminateRequest
    {
        $illuminateRequest = IlluminateRequest::capture();

        $illuminateRequest->initialize(
            $this->request->get ?? [],
            $this->request->post ?? [],
            [],
            $this->request->cookie ?? [],
            $this->request->files ?? [],
            $this->mergeServerInfo()
        );

        return $illuminateRequest;
    }

    /**
     * @return array
     */
    protected function mergeServerInfo() : array
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
            return in_array($key, ['content_length', 'content_type', 'content_md5'], true) ?
                [$key => $item] :
                ['http_' . $key => $item];
        })->toArray();

        $server = array_merge($server, $this->request->server, $requestHeader);

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