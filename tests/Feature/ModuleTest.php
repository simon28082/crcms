<?php

namespace Tests\Feature;

use CrCms\Category\Providers\CategoryServiceProvider;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleTest extends TestCase
{
    protected function dataProvider()
    {
        $name = Str::random(10);
        $sign = Str::random(10);
        $data = [
            'name' => $name,
            'sign' => $sign,
            'namespace' => Str::random(20),//CategoryServiceProvider::class,
            'status' => 1,
        ];
        return $data;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
        $response = $this->post('/api/v1/manage/modules',$this->dataProvider());
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
        $response = $this->put('/api/v1/manage/modules/'.$model['data']['id'],$data);

        $json = $response->getContent();
        $result = json_decode($json,true);

        $this->assertArrayHasKey('data',$result);
        $this->assertArrayHasKey('name',$result['data']);
        $response->assertStatus(200);

        return $model['data']['id'];
    }

    /**
     * @param int $id
     * @depends testUpdate
     */
    public function testDestroy(int $id)
    {
        $response = $this->delete('/api/v1/manage/modules/'.$id);
        $response->assertStatus(204);
    }
}
