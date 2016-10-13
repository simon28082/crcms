<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/6
 * Time: 7:16
 */

namespace Simon\User\Http\Requests;


use Simon\Kernel\Http\Requests\KernelRequest;

class VerifyEmailRequest extends KernelRequest
{

    public function rules()
    {
        return [
            'email'=>['required','email','unique:users'],
        ];
    }

}