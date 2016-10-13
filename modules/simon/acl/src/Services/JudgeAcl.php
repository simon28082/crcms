<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/2
 * Time: 16:36
 */

namespace Simon\Acl\Services;


use Illuminate\Database\Eloquent\Model;
use Simon\User\Models\User;

class JudgeAcl
{

    protected $dataAcl = null;

    protected $userAcl = null;

    protected $permission = '';

    public function __construct(string $permission,Acl $dataAcl,Acl $userAcl)
    {
        $this->permission = $permission;
        $this->dataAcl = $dataAcl;
        $this->userAcl = $userAcl;
    }

    public function judge()
    {
        //如果发布人和登录人相同
        if ($this->dataAcl->getUser()->id === $this->userAcl->getUser()->id)
        {
            if ($this->judgeUserPermission())
            {
                return true;
            }
        }

        //获取组权限
        if ($this->judgeRolePermission())
        {
            return true;
        }

        //其它权限
        if ($this->judgeOtherPermission())
        {
            return true;
        }

        return false;
    }

    /**
     * 判断用户权限
     * @return bool
     */
    protected function judgeUserPermission() : bool
    {
        $search = $this->userAcl->getUserPermission()->search(function($item){
            return $item->node === $this->permission;
        });
        return $search !== false;
    }

    /**
     * 判断角色权限
     * @return bool
     */
    protected function judgeRolePermission() : bool
    {

        $roles = $this->dataAcl->getRole()->intersect($this->userAcl->getRole());

        if ($roles->isEmpty())
        {
            return false;
        }

        return $this->dataAcl->getRolePermission($roles)->search(function($item){
            return $item->node === $this->permission;
        }) !== false;

    }

    protected function judgeOtherPermission() : bool
    {
        return $this->dataAcl->getOtherPermission()->search(function($item){
            return $item->node === $this->permission;
        }) !== false;
    }
}