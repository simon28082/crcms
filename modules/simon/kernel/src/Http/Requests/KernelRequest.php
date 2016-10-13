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

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
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

}