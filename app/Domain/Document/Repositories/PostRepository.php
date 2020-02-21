<?php

/**
 * @author simon <simon@crcms.cn>
 * @datetime 2020-02-21 10:22
 *
 * @link http://crcms.cn/
 *
 * @copyright Copyright &copy; 2020 Rights Reserved CRCMS
 */

namespace Domain\Document\Repositories;

use CrCms\Repository\AbstractRepository;
use Domain\Document\Models\PostModel;

class PostRepository extends AbstractRepository
{
    public function newModel(): PostModel
    {
        return new PostModel;
    }
}
