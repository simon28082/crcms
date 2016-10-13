<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/18
 * Time: 20:01
 */

namespace Simon\Discuss\Http\Requests;


use Simon\Kernel\Http\Requests\KernelRequest;

class DiscussRequest extends KernelRequest
{

    public function rules()
    {
        return [
            'title'=>['required','max:255'],
            'content'=>['required'],
        ];
    }

}