<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/8/25
 * Time: 6:40
 */
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserController extends TestCase
{

    public function testUserIndex()
    {
        $this->get('manage/users');
    }

}