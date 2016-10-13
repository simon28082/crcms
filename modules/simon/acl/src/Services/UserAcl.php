<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/5
 * Time: 9:13
 */

namespace Simon\Acl\Services;


use Illuminate\Database\Eloquent\Collection;
use Simon\Acl\Services\Interfaces\RoleAclInterface;
use Simon\Acl\Services\Interfaces\UserAclInterface;
use Simon\User\Models\User;

class UserAcl extends Acl implements UserAclInterface,RoleAclInterface
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getUser()
    {
        // TODO: Implement getUser() method.
        return $this->model;
    }

    public function getUserPermission()
    {
        $userPermission = $this->model->hasBelongsToManyPermission()->get();

        if ($userPermission->isEmpty())
        {
            $userPermission = config('acl.acl_user_permission');
        }

        return $userPermission;
    }

    /**
     * @return Collection|mixed
     */
    public function getRole()
    {
        // TODO: Implement getRole() method.

        $roles = $this->getUserRole($this->model);

        //未设置则设置默认组
        if ($roles->isEmpty())
        {
            $roles = config('acl.acl_role');
        }

        return $roles;
    }

}