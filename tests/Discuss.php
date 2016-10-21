<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Discuss extends TestCase
{

    public function testStore()
    {
        $params = [
            'title'=>'1233445',
            'content'=>'223232323',
        ];
        $response = $this->call('post','api/discusses',$params);
        dd($response->getContent());

    }
}
