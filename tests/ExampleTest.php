<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
//    public function testBasicExample()
//    {
//        $this->visit('/')
//             ->see('Laravel');
//    }

    public function addDataProvider()
    {
        return [
            ['a','b']
        ];

    }

    /**
     * @dataProvider addDataProvider
     */
    public function testData($a,$b)
    {
        dd($a,$b);
    }

}
