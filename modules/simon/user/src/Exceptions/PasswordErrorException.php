<?php
namespace Simon\User\Exceptions;
use Simon\Kernel\Exceptions\AppException;
class PasswordErrorException extends AppException
{
	const  APP_CODE = 1020;
	
	const  HTTP_CODE = 403;
}