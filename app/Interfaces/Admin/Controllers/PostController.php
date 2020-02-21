<?php

/**
 * @author simon <simon@crcms.cn>
 * @datetime 2020-02-21 10:19
 *
 * @link http://crcms.cn/
 *
 * @copyright Copyright &copy; 2020 Rights Reserved CRCMS
 */

namespace Interfaces\Admin\Controllers;

use Application\Http\Controllers\AbstractController;
use Domain\Document\Actions\CreatePostAction;
use Domain\Document\Dto\PostData;
use Illuminate\Support\Facades\Response;
use Interfaces\Admin\Requests\PostRequest;

class PostController extends AbstractController
{
    public function store(PostRequest $request,CreatePostAction $action)
    {
        $data = PostData::formRequest($request);

        $result = $action->execute($data);

        Response::json($result->toArray());
    }
}
