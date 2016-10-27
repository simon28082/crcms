<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/10/26
 * Time: 14:56
 */

namespace CrCms\Manage\Http\Controllers;


use CrCms\Manage\Http\Requests\AdminRequest;
use CrCms\Repositories\Interfaces\AdminRepositoryInterface;
use Simon\Kernel\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function __construct(AdminRepositoryInterface $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->view('index');
    }


    /**
     *
     */
    public function create()
    {
        return $this->view('create');
    }


    /**
     *
     */
    public function store(AdminRequest $adminRequest)
    {
        $this->repository->create($this->input);
        return $this->response(['app.success']);
    }


    /**
     * @param int $id
     */
    public function edit(int $id)
    {

    }

    public function update(int $id)
    {

    }

    public function destroy(int $id)
    {

    }

}