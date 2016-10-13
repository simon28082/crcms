<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 13:28
 */

namespace Simon\Acl\Http\Requests;


use Simon\Kernel\Http\Requests\KernelRequest;

class AuthorizeRequest extends KernelRequest
{

    public function rules()
    {
        return [
            'name'=>['required','max:50'],
            'remark'=>['max:255'],
            'status'=>['integer'],
        ];
    }

}