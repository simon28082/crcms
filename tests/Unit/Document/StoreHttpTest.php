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
 * Class StoreHttpTest
 * @package Tests\Unit\Document
 */
class StoreHttpTest extends TestCase
{
    use ModelTrait;

    public function testStore()
    {
        $model = $this->model();


        $data = ['title'=>Str::random(30),'content'=>Str::random(500)];

        try {
            $response = $this->post(route('document.documents.store',['model'=>$model->id]),$data);
            $this->assertEquals(200,$response->getStatusCode());

            dump($response->getContent());

//            $this->assertEquals($data['title'],$model->title);
        } catch (\Exception $exception) {
            dump($exception->getMessage());
        }


    }

}