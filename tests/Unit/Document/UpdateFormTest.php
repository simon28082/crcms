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
use CrCms\Document\Services\Documents\Store;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Class UpdateFormTest
 * @package Tests\Unit\Document
 */
class UpdateFormTest extends TestCase
{
    use ModelTrait;

    public function testForm()
    {
        $model = $this->model();

        $fields = $this->fields();

        $data = ['_id'=>'5aeeb38e4d97bb12d14c6942','title'=>Str::random(30),'content'=>Str::random(500)];



        $fields = $this->fields($data);
        $data = (new Store($fields))->handle('update');
        dump($data);
//
//
    }

}