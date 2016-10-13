<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 9:51
 */

namespace Simon\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Simon\Kernel\Http\Requests\KernelRequest;
use Simon\Kernel\Services\Interfaces\VerifyCodeInterface;

class LoginRequest extends KernelRequest implements VerifyCodeInterface
{

    //这里还要判断其它的，如：一小时内连续注册两次则关闭


//    public function authorize()
//    {
//        return true;
//    }

    public function rules()
    {
        return [
            'name'=>['required','regex:/^[\w]{3,16}$/i'],
            'password'=>['required','max:16','min:6'],
            'verify_code'=>$this->isOpenVerifyCode() ? ['required','captcha'] : [],
        ];
    }

}
