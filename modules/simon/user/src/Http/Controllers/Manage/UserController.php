<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/25
 * Time: 6:36
 */

namespace Simon\User\Http\Controllers\Manage;


use Simon\Kernel\Http\Controllers\Controller;
use Simon\User\Models\User;
use Simon\User\Repositorys\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{

    protected $view = 'user::manage.user.';

    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index()
    {

        $models = $this->repository->allPaginateBySearch($this->input)->findAllPaginate();

        $mailStatus = $this->repository->mailStatus();

        $mobileStatus = $this->repository->mobileStatus();

        return $this->view('index',compact('models','mailStatus','mobileStatus'));

    }

    public function destroy($id)
    {
        foreach (explode(',',$id) as $val)
        {
            $this->repository->delete($val);
        }

        return $this->response(['app.success']);
    }

}