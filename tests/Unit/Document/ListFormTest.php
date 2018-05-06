<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-05-06 15:28
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace Tests\Unit\Document;

use CrCms\Document\Repositories\DocumentRepository;
use CrCms\Document\Services\Documents\Many;
use Tests\TestCase;

/**
 * Class ListFormTest
 * @package Tests\Unit\Document
 */
class ListFormTest extends TestCase
{
    use ModelTrait;

    public function testList()
    {
        $model = $this->model();
        $fields = $this->fields();
//        dd($fields->toArray());
        $paginate = $this->app->make(DocumentRepository::class,['model'=>$model])->paginate();

        $paginate = (new Many($fields,$paginate))->handle('list');
        dd($paginate);
    }
}