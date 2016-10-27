<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/10/26
 * Time: 16:42
 */

namespace CrCms\Manage\Http\Requests;


use Simon\Kernel\Http\Requests\KernelRequest;

class AdminRequest extends KernelRequest
{

    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'name'=>['required','max:12'],
            'password'=>['required','max:16'],
            'status'=>['integer'],
        ];
    }


    /**
     * @return array
     */
    public function attributes() : array
    {
        return [

        ];
    }

}