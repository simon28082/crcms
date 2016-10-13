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
use Simon\Kernel\Services\Visited;

class UpdatePasswordRequest extends KernelRequest implements VerifyCodeInterface
{

    //这里还要判断其它的，如：一小时内连续注册两次则关闭



    public function put_rules()
    {
        return [
            'old_password'=>['required','max:16','min:6'],
            'password'=>['required','max:16','min:6'],
        ];
    }

    public function isOpenVerifyCode() : bool
    {
        // TODO: Implement isOpenVerifyCode() method.
        $visited = app(Visited::class)->get();
        return time() - $visited['time'] < 60;
    }


}
