<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/21
 * Time: 19:17
 */

namespace Simon\User\Models;


use Simon\Acl\Models\Acl\UserTrait;
use Simon\Acl\Models\AclRole;
use Simon\Acl\Models\Permission;
use Simon\Kernel\Models\Model;
use Simon\Kernel\Models\Traits\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class User extends Model
{

    use SoftDeletes,UserTrait;

    public function scopeName(Builder $query,string $name,string $operator = '=')
    {
        return $query->where('name',$operator,$name);
    }

    public function scopeEmail(Builder $query,string $email,string $operator = '=')
    {
        return $query->where('email',$operator,$email);
    }

    public function scopeMobile(Builder $query,string $mobile,string $operator = '=')
    {
        return $query->where('mobile',$mobile,$operator);
    }

    public function scopeMailStatus(Builder $query,int $status)
    {
        return $query->where('mail_status',$status);
    }

    public function scopeMobileStatus(Builder $query,int $status)
    {
        return $query->where('mobile_status',$status);
    }

}