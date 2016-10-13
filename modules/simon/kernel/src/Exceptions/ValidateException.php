<?php
namespace Simon\Kernel\Exceptions;
use Illuminate\Http\JsonResponse;
class ValidateException extends AppException
{

    const  APP_CODE  = 1001;

    const  HTTP_CODE = 200;

    public function __construct($validator,$response = null)
    {
        parent::__construct($validator->errors()->first(),$response);
    }

}