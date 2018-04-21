<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->post('/api/v1/auth/login',[
           'name'=>'nLZr7qCxltbjZp4',
           'password'=>'123456789'
        ],['Accept'=>'application/json']);

        $response->assertStatus(200);

        $json = $response->getContent();
        dump($json);



        $result = json_decode($json,true);
dump($result);
        $this->assertArrayHasKey('data',$result);
        $this->assertArrayHasKey('access_token',$result['data']);



    }
}
