<?php
namespace Simon\User\Exceptions;
use Simon\Kernel\Exceptions\AppException;
class UserNotExistsException extends AppException
{
	const  APP_CODE = 1008;
	
	const  HTTP_CODE = 404;
}