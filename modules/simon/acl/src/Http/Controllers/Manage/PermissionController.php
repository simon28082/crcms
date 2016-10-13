<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 11:16
 */

namespace Simon\Acl\Http\Controllers\Manage;


use Simon\Acl\Http\Requests\PermissionRequest;
use Simon\Acl\Repositorys\Interfaces\AuthorizeRepositoryInterface;
use Simon\Acl\Repositorys\Interfaces\PermissionRepositoryInterface;
use Simon\Kernel\Http\Controllers\Controller;

class PermissionController extends Controller
{

    protected $view = 'acl::manage.permission.';

    public function __construct(PermissionRepositoryInterface $repository,AuthorizeRepositoryInterface $authorize)
    {
        parent::__construct();
        $this->repository = $repository;


        $status = $this->repository->status();
        $openApp = $authorize->findOpenAll();

        view()->share(compact('status','openApp'));
    }

    public function index()
    {
        $models = $this->repository->allPaginateBySearch([])->findAllPaginate();

        return $this->view('index',compact('models'));
    }

    public function create()
    {
        return $this->view('create');
    }

    public function store(PermissionRequest $permissionRequest)
    {

        $this->repository->create($this->input);

        return $this->response(['kernel::app.success']);
    }

    public function edit($id)
    {
        $model = $this->repository->findById($id);

        if (empty($model))
        {
            abort(404);
        }

        return $this->view('edit',compact('model'));
    }

    public function update($id,PermissionRequest $permissionRequest)
    {
        $this->repository->update($this->input,$id);

        return $this->response(['kernel::app.success']);
    }

    public function destroy($id)
    {
        foreach (explode(',',$id) as $val)
        {
            $this->repository->delete($val);
        }

        return $this->response(['kernel::app.success']);
    }
}