<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-05-06 14:54
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace Tests\Unit\Document;

use CrCms\Document\Models\DocumentModel;
use CrCms\Document\Repositories\DocumentRepository;
use CrCms\Document\Services\Documents\Store;
use Faker\Factory;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Class StoreFormTest
 * @package Tests\Unit\Document
 */
class StoreFormTest extends TestCase
{
    use ModelTrait;

    public function testStore()
    {
        $model = $this->model();


        $data = ['title'=>Str::random(30),'content'=>Str::random(500)];

        $fields = $this->fields($data);
        $data = (new Store($fields))->handle('store');
        dump($data);
        $model = $this->app->make(DocumentRepository::class,['model'=>$model])->create($data);

        $this->assertInstanceOf(DocumentModel::class,$model);
        $this->assertEquals($data['title'],$model->title);

    }

}