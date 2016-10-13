<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 12:24
 */

namespace Simon\Acl\Http\Controllers\Manage;


use Simon\Acl\Http\Requests\AuthorizeRequest;
use Simon\Acl\Repositorys\Interfaces\AuthorizeRepositoryInterface;
use Simon\Kernel\Http\Controllers\Controller;

class AuthorizeController extends Controller
{

    protected $view = 'acl::default.authorize.';

    public function __construct(AuthorizeRepositoryInterface $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index()
    {
        $models = $this->repository->all();
        $status = $this->repository->status();
        return $this->view('index',compact('models','status'));
    }

    public function create()
    {
        return $this->view('create');
    }

    public function store(AuthorizeRequest $authorizeRequest)
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

    public function update($id,AuthorizeRequest $authorizeRequest)
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