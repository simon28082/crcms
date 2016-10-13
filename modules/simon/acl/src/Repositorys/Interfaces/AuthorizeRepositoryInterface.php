<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 12:24
 */

namespace Simon\Acl\Repositorys\Interfaces;


use Simon\Kernel\Repositorys\RepositoryInterface;

interface AuthorizeRepositoryInterface extends RepositoryInterface
{

    public function status() : array;


    public function statusOpen() : int;


    public function statusClose() : int;

    public function findOpenAll();


}