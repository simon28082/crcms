<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-23 21:23
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class GetRorgetPasswordUrlTest
 * @package Tests\Feature
 */
class GetRorgetPasswordUrlTest extends TestCase
{
    /**
     *
     */
    public function testResetPasswordGetUrl()
    {
        $response = $this->post('/api/v1/auth/reset-password-url',[
           'token'=>Str::random(10),
           'email'=>'Test@qq.com'
        ],['Accept'=>'application/json']);

        dump($response->getContent());

        $this->assertEquals(200,$response->getStatusCode());
        $array = json_decode($response->getContent(),true);
        $this->assertArrayHasKey('url',$array['data']);
    }

}