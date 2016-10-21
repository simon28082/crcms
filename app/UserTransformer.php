<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/10/20
 * Time: 13:54
 */
namespace App;
use Dingo\Api\Contract\Transformer\Adapter;
use Dingo\Api\Http\Request;
use Dingo\Api\Transformer\Binding;
use League\Fractal\TransformerAbstract;
use Simon\User\Models\User;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        // TODO: Implement transform() method.

        $user->name = 'abc';
        return $user;

    }


}