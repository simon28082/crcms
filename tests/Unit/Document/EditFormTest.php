<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-05-06 14:42
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace Tests\Unit\Document;

use CrCms\Document\Repositories\DocumentRepository;
use CrCms\Document\Services\Documents\Form;
use CrCms\Document\Services\Documents\Single;
use Tests\TestCase;

/**
 * Class EditFormTest
 * @package Tests\Unit\Document
 */
class EditFormTest extends TestCase
{
    use ModelTrait;

    public function testForm()
    {
        $model = $this->model();

        $fields = $this->fields();

        $document = $this->app->make(DocumentRepository::class,['model'=>$model])->firstOrFail();

        $data = (new Single($fields,$document))->handle('single');

        $data = (new Form($fields,$data))->handle('edit');
        dump($data);
//
//
    }

}