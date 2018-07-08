<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-07-09 06:51
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\Tests\Feature;

use CrCms\Tests\TestCase;

/**
 * Class ApiResponseVersionTest
 * @package CrCms\Tests\Feature
 */
class ApiResponseVersionTest extends TestCase
{

    public function testVersion()
    {
        $response = $this->getJson('api/v1/mall/manage/categories');

        $this->assertArrayHasKey(strtolower('X-CRCMS-Media-Type'),$response->headers->all());
        $this->assertArrayHasKey(strtolower('X-CRCMS-Media-version'),$response->headers->all());
    }

}