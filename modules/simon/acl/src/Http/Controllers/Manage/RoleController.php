<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 16:25
 */

namespace Simon\Acl\Http\Controllers\Manage;


use Simon\Acl\Repositorys\Interfaces\RoleRepositoryInterface;

class RoleController extends AbstractRoleController
{

    public function __construct(RoleRepositoryInterface $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

}