<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 16:30
 */

namespace Simon\Acl\Http\Controllers\Manage;


use Simon\Acl\Repositorys\Interfaces\OtherRepositoryInterface;

class OtherController extends AbstractRoleController
{

    public function __construct(OtherRepositoryInterface $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

}