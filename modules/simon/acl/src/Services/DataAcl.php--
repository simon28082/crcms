<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/2
 * Time: 15:39
 */

namespace Simon\Acl\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Simon\Acl\Services\Interfaces\Acl;

class DataAcl implements Acl
{

    protected $model = null;



    protected $roles = null;

    protected $rolePermissions = null;

    protected $others = null;

    protected $otherPermissions = null;


    protected $user = null;

    protected $userPermissions = null;

    protected $userRoles = null;


    protected $permission = '';


    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getUser()
    {
        $this->user = $this->model->hasOneUser ?? null;
        return $this->user;
    }

    public function getUserPermission()
    {
        $this->userPermissions = $this->user->hasBelongsToManyPermission()->get();
        return $this->userPermissions;
    }

    public function getUserRole()
    {
        $this->userRoles = $this->user->hasBelongsToManyAclRole()->get();
    }

    public function getOther()
    {

        $this->others = $this->model->hasBelongsToManyOther($this->type)->get();

        //未设置则设置默认组
        if ($this->others->isEmpty())
        {
            $this->others = collect(config('acl.acl_other'));
        }

        return $this->others;
    }

    public function getOtherPermission()
    {
        $this->otherPermissions = collect();

        foreach ($this->others as $other)
        {
            $permission = $other->hasBelongsToManyPermission()->pluck('node','id');

            if (!$permission->isEmpty())
            {
                $this->otherPermissions->put($other->id,$permission);
            }
        }

        return otherPermissions;
    }

    public function getRole() : Collection
    {
        $this->roles = $this->model->hasBelongsToManyRole($this->type)->get();

        //未设置则设置默认组
        if ($this->roles->isEmpty())
        {
            $this->roles = collect(config('acl.acl_role'));
        }

        return $this->roles;
    }

    public function getRolePermission()
    {
        $this->rolePermissions = collect();

        foreach ($this->roles as $role)
        {
            $permission = $role->hasBelongsToManyPermission()->pluck('node','id');

            if (!$permission->isEmpty())
            {
                $this->rolePermissions->put($role->id,$permission);
            }
        }

        return $this->rolePermissions;
    }
}