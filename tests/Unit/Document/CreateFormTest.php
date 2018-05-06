<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-05-06 14:42
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace Tests\Unit\Document;

use Tests\TestCase;

/**
 * Class CreateFormTest
 * @package Tests\Unit\Document
 */
class CreateFormTest extends TestCase
{
    use ModelTrait;

    public function testForm()
    {
        $model = $this->model();

        $fields = $this->fields();

        dump($fields);


    }

}