<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/27
 * Time: 20:39
 */

namespace Simon\User\Http\Requests;


use Simon\Kernel\Http\Requests\KernelRequest;

class BasicInformationRequest extends KernelRequest
{

    public function rules()
    {
        return [
            'birthday'=>['date_format:Y-m-d'],
            'website'=>['max:100','url'],
            'introduction'=>['max:255'],
            'real_name'=>['max:30'],
        ];
    }

}