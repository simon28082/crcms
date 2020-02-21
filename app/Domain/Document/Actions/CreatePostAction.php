<?php

/**
 * @author simon <simon@crcms.cn>
 * @datetime 2020-02-21 09:47
 *
 * @link http://crcms.cn/
 *
 * @copyright Copyright &copy; 2020 Rights Reserved CRCMS
 */

namespace Domain\Document\Actions;

use Domain\Document\Dto\PostData;
use Domain\Document\Models\PostModel;
use Domain\Document\Repositories\PostRepository;

class CreatePostAction
{
    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(PostData $data): PostModel
    {
        return $this->repository->create($data->all());
    }
}
