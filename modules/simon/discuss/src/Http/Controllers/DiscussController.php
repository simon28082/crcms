<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/18
 * Time: 18:37
 */

namespace Simon\Discuss\Http\Controllers;


use Simon\Discuss\Http\Requests\DiscussRequest;
use Simon\Discuss\Repositorys\Interfaces\DiscussRepositoryInterface;
use Simon\Kernel\Http\Controllers\Controller;

class DiscussController extends Controller
{

    protected $view = 'discuss::default.discuss.';

    public function __construct(DiscussRepositoryInterface $repository)
    {
        $this->repository = $repository;
        parent::__construct();
    }

    public function index()
    {
        return $this->view('index');
    }

    public function create()
    {
        return $this->view('create');
    }

    public function store(DiscussRequest $discussRequest)
    {
        $model = $this->repository->create($this->input);

        return $this->redirectRoute('discuss.show',['id'=>$model->id]);
    }

    public function show($id)
    {
        $model = $this->repository->findById($id);

        return $this->view('show',compact('model'));
    }

}