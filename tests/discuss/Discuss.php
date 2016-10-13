<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/25
 * Time: 12:28
 */
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Discuss extends TestCase
{

//    public function userDataProvider()
//    {
//        return [
//          'name'=>'fdasfsdfada',
//            'password'=>'123456',
//        ];
//    }

    /**
     *
     */
    public function testStore()
    {
        $response = $this->call('POST','/discuss',[
            '_token'=>csrf_token(),
            'title'=>str_random(10),
            'content'=>str_random(30),
        ]);

        dd($response->status(),$response->getContent());
    }


}