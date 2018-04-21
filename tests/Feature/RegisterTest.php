<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $response = $this->post('/api/v1/auth/register',[
           'name'=>Str::random(15),
           'email'=>Str::random(20).'@gmail.com',
           'password'=>'12345678'
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
