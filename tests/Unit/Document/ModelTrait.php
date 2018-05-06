<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-05-06 14:43
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace Tests\Unit\Document;
use CrCms\Document\Models\Model;
use CrCms\Document\Repositories\ModelRepository;
use Illuminate\Support\Collection;

/**
 * Trait ModelTrait
 * @package Tests\Unit\Document
 */
trait ModelTrait
{

    public function model(): Model
    {
        return Model::firstOrFail();
    }

    public function fields(array $data = []): Collection
    {
        return app(ModelRepository::class)->fields($this->model(),$data);
    }

}