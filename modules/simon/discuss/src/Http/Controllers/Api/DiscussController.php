<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/18
 * Time: 18:37
 */

namespace Simon\Discuss\Http\Controllers\Api;


use App\UserTransformer;
use Dingo\Api\Routing\Helpers;
use Dingo\Api\Tests\Stubs\UserTransformerStub;
use Simon\Discuss\Http\Requests\DiscussRequest;
use Simon\Discuss\Repositories\Interfaces\DiscussRepositoryInterface;
use Simon\Kernel\Http\Controllers\Controller;
use Simon\User\Models\User;

class DiscussController extends Controller
{

//    use Helpers {
//        response as apiResponse;
//    }

    public function __construct(DiscussRepositoryInterface $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    public function index()
    {
//        $user = User::all();

        $user = User::paginate(5);

        return $user;

        return $this->response(['app.success'],compact('user'));

//        return $this->apiResponse()->paginator($user,new UserTransformer,['a'=>'b']);

//        return $this->response->collection($user,new UserTransformerStub);
//        return $this->response->error('This is an error.', 404);
    }

    public function store(DiscussRequest $discussRequest)
    {
        $model = $this->repository->create($this->input);

        return $this->response(['app.success'],compact('model'));
    }

    public function show($id)
    {
        $model = $this->repository->findById($id);

        return $model;
    }

}