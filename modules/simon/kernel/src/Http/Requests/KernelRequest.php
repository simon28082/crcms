<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/27
 * Time: 18:14
 */

namespace Simon\Kernel\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Simon\Kernel\Exceptions\ValidateException;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Simon\Kernel\Facades\Visited;

abstract class KernelRequest extends FormRequest
{

    public function authorize()
    {
        //
        //增加访问次数记录
//        if ($this->method() !== 'GET') app(Visited::class)->put();



        return true;
    }

    public function validate()
    {
        if ($this->method() === 'GET')
        {
            return ;
        }

        parent::validate();
    }

    /**
     *
     * @param Validator $validator
     * @throws ValidateException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidateException($validator);
    }

    public function isOpenVerifyCode() : bool
    {
        return false;
        // TODO: Implement isOpenVerifyCode() method.
        $visited = Visited::get();

        if ($visited)
        {
            return time() - $visited['time'] < 20;
        }

        return false;
    }

}