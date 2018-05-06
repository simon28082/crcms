<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-05-06 16:27
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace Tests\Unit\Document;

use CrCms\Document\Repositories\DocumentRepository;
use CrCms\Document\Services\Documents\Single;
use Tests\TestCase;

/**
 * Class SingleTest
 * @package Tests\Unit\Document
 */
class SingleTest extends TestCase
{

    use ModelTrait;

    public function testSingle()
    {
        $model = $this->model();
        $fields = $this->fields();

        $document = $this->app->make(DocumentRepository::class,['model'=>$model])->firstOrFail();

        $data = (new Single($fields,$document))->handle('single');

        dump($data);

        $this->assertArrayHasKey('title',$data);
        $this->assertArrayHasKey('content',$data);

    }


}