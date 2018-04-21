<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgetPasswordTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testForgetPassword()
    {
        $this->post('/api/v1/auth/forget-password',[
            'email'=>'7BXXegNAM9war8Hf0fyL@gmail.com',
        ]);

//        try {
//            $response = $this->post('/api/v1/auth/forget-password',[
//                'email'=>'7BXXegNAM9war8Hf0fyL@gmail.com',
//            ]);//,['Accept'=>'application/json']
//        } catch (\Exception $exception) {
//            dump($exception->getMessage());
//        }

//
//        $response->assertStatus(200);
//
//        $json = $response->getContent();
//        dump($json);
    }
}
