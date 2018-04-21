<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
        $data = $this->dataProvider();

        $response = $this->post('/api/categories', $data);

        $json = $response->getContent();
        $result = json_decode($json,true);

        $this->assertArrayHasKey('data',$result);
        $this->assertArrayHasKey('name',$result['data']);
        $response->assertStatus(201);

        return $result;
    }

    /**
     * @depends testStore
     */
    public function testUpdate(array $model)
    {
        $data = $this->dataProvider();
        $response = $this->put('/api/categories/'.$model['data']['id'],$data);

        $json = $response->getContent();
        $result = json_decode($json,true);

        $this->assertArrayHasKey('data',$result);
        $this->assertArrayHasKey('name',$result['data']);
        $response->assertStatus(200);
    }

    protected function dataProvider()
    {
        $name = Str::random(10);
        $sign = Str::random(10);
        $parentId = mt_rand(1,10);
        $data = [
            'name' => $name,
            'sign' => $sign,
            'parent_id' => $parentId,
            'status' => 1,
            'icon' => '',
            'sort' => 0,
        ];
        return $data;
    }
}
