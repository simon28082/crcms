<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/24
 * Time: 13:51
 */

namespace App\Http\Requests;


use App\Exceptions\ValidateException;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{

    /**
     * 开放接口，只作phpunit使用
     */
    public function getValidatorInstance()
    {
        parent::getValidatorInstance();
    }



    public function authorize()
    {
        return true;
    }

    /**
     * 验证异常重写
     * @param Validator $validator
     * @throws ValidateException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidateException($validator);
    }

}