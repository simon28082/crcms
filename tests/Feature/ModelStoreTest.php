<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelStoreTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $data = [
            'name' => Str::random(10),
            'table_name' => Str::random(10),
            'status' => 1,
            'built_fields' => ['created_uid'],
        ];

        $response = $this->post('api/v1/manage/models',$data);


        dump($response->getContent());

        $this->assertEquals(200,$response->getStatusCode());



    }
}
