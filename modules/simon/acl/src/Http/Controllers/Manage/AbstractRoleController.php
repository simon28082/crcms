<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 16:03
 */

namespace Simon\Acl\Http\Controllers\Manage;


use Simon\Acl\Http\Requests\RoleRequest;
use Simon\Acl\Repositorys\Interfaces\RoleRepositoryInterface;
use Simon\Kernel\Http\Controllers\Controller;

class AbstractRoleController extends Controller
{

    protected $view = 'acl::default.role.';


    public function index()
    {

        $models = $this->repository->allPaginateBySearch([])->findAllPaginate();

        return $this->view('index',compact('models'));
    }

    public function create()
    {
        return $this->view('create');
    }

    public function store(RoleRequest $roleRequest)
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

    public function update($id,RoleRequest $roleRequest)
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