<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Authorize extends TestCase
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


    public function testData()
    {

        $data = [];
        $data['name'] = str_random(30);
        $data['remark']= str_random(30);
        $data['app_id'] = 2;
        $data['status'] = 2;

        return $data;
    }

    /**
     * @depends testData
     * @param array $data
     */
//    public function testValidate(array $data)
//    {
//
//        $request = new \Simon\Acl\Http\Requests\RoleRequest();
//        $rules = $request->rules();
//        $validator = Validator::make($data, $rules);
//        $fails = $validator->fails();
//        $this->assertEquals(false, $fails);
//
//        return $data;
//
//    }

    /**
     * @depends testValidate
     */
//    public function testStore(array $data)
//    {
//        $data['_method'] = 'POST';
//        $response = $this->call('POST','manage/acl/others',$data);
//
//
//        dd($response->getStatusCode(),$response->getContent());
//        $response->assertResponseOk(302);
//
////        $this->assertEquals(200,$response->getStatus());
////        $response->assert
////        dd($response);
////        dd($response->visit());
//    }

    /**
     * @depends testValidate
     */
//    public function testUpdate(array $data)
//    {
//
//        $id = 1;
//
//        $response = $this->call('PUT','manage/acl/others/'.$id,$data);
//
//        dd($response->getStatusCode(),$response->getContent());
//    }

    /**
     *
     */
    public function testDestroys()
    {
        $id = '1,2,3,4';
        $data = [];
        $data['_method'] = 'DELETE';

        $response = $this->call('DELETE','manage/acl/others/'.$id);

        dd($response->getStatusCode(),$response->getContent());
    }
}


