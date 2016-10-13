<?php
namespace Simon\Kernel\Exceptions;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
class AppException extends \Exception
{

    /**
     *
     */
    const  APP_CODE = 1003;

    /**
     *
     */
    const  HTTP_CODE = 200;

    /**
     *
     * @var \Illuminate\Http\Response $response
     */
    protected $response = null;

    /**
     * @var bool
     */
    protected $returnJson = false;

    /**
     *
     * @param string $message
     * @param redirect Url || \Illuminate\Http\Response $response
     * @author simon
     */
    public function __construct($message = null,$response = null)
    {
        if (is_object($message))
        {
            $this->response = $message;
            $message = '';
        }

        $this->returnJson = response_json();

        parent::__construct($message);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     * @author simon
     */
    public function getResponse($request)
    {
        if ($this->response && $this->response instanceof Response)
        {
            return $this->response;
        }
        else
        {
            return responding($request,[$this->getMessage(),static::APP_CODE,static::HTTP_CODE],$this->returnJson);
        }
    }

}