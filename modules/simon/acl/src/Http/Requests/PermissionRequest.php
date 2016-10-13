<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 11:22
 */

namespace Simon\Acl\Http\Requests;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Simon\Acl\Models\Permission;
use Simon\Kernel\Exceptions\AppException;
use Simon\Kernel\Exceptions\ValidateException;
use Simon\Kernel\Http\Requests\KernelRequest;

class PermissionRequest extends KernelRequest
{

    public function validator($factory)
    {
        if ($this->method() === 'GET')
        {
            return ;
        }

        $rules = [
            'name'=>['required','min:1','max:50'],
            'node'=>['required','max:150'],
            'app_id'=>['required','integer'],
            'status'=>['required','integer'],
            'remark'=>['max:255'],
        ];

        $validator = $factory->make($this->validationData(),$rules);

        if($validator->fails())
        {
            return $validator;
        }

        //判断app_id是否惟一
        $query = Permission::where('app_id',$this->input('app_id'));

        if ($this->method() === 'PUT')
        {
            $query->where('id','<>',$this->segment(4));
        }

        $node = $query->where('node',$this->input('node'))->first();

        if($node)
        {
            throw new AppException(trans('acl::acl.node_not_exists'));
        }

        return $validator;
    }

}