<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class Permission extends TestCase
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

    /**
     * 模拟数据测试
     */
public function testMoreData()
{
//
//    return ['name'=>'读取','node'=>'R','status'=>1,'app_id'=>1,'remark'=>'Remark'];
////    echo "11111111111111111\n";
    return [
//        ['name'=>'读取','node'=>'R','status'=>1,'app_id'=>1,'remark'=>'remark'],
//        ['name'=>'写入','node'=>'W','status'=>1,'app_id'=>1,'remark'=>'remark'],
        ['name'=>'执行','node'=>'X','status'=>1,'app_id'=>1,'remark'=>'remark']
    ];
}


//    public function testData()
//    {
//        $data = [];
////        $data['name'] = str_random(10);
//        $data['remark']= str_random(30);
//        $data['app_id'] = 1;
//        $data['node'] = uniqid();
//        $data['status'] = 1;
//
//        return $data;
//    }

    /**
     * @dataProvider  testMoreData
     * @param array $data
     * @return array
     */
    public function testValidation2($name,$node,$status,$app_id,$remark)//$name,$node,$status,$app_id,$remark
    {
//        echo "22222222222222\n";
        $data = compact('name','node','status','app_id','remark');

//        $request = new \Simon\Acl\Http\Requests\PermissionRequest();
//        $validator = $request->validator(app('validator'),$data);
//        $this->assertEquals(false,$validator->fails());

        return $data;
    }

    /**
     * @dataProvider  testMoreData
     * @param array $data
     */
    public function testStore2($name,$node,$status,$app_id,$remark)
    {
        $data = compact('name','node','status','app_id','remark');
//        echo "333333333333333\n";
//        dd($data);
        $data['_method'] = 'POST';
        $data['_token'] = csrf_token();



        $response = $this->call('POST','manage/acl/permissions',$data);





        dd($response->getStatusCode(),$response->getContent());
        $response->assertResponseOk(302);

//        $this->assertEquals(200,$response->getStatus());
//        $response->assert
//        dd($response);
//        dd($response->visit());
    }


    /**
     * @depends testData
     */
//    public function testStore(array $data)
//    {
//        $data['_method'] = 'POST';
//        $response = $this->call('POST','manage/acl/permissions',$data);
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
     * @depends testData
     */
//    public function testUpdate(array $data)
//    {
//
//        $id = 2;
////        $data['name'] = '';
//        $data['name'] = '_'.str_random(10);
//        $data['remark']= '_'.str_random(30);
//        $data['app_id'] = 2;
//        $data['node'] = '_afdafasd57c7cb318d995';
//        $data['status'] = 2;
//        $data['_method'] = 'PUT';
//
//        $response = $this->call('PUT','manage/acl/permissions/'.$id,$data);
//
//        dd($response->getStatusCode(),$response->getContent());
//    }

    /**
     *
     */
//    public function testDestroys()
//    {
//        $id = '1,2,3,4';
//        $data = [];
//        $data['_method'] = 'DELETE';
//
//        $response = $this->call('DELETE','manage/acl/permissions/'.$id);
//
//        dd($response->getStatusCode(),$response->getContent());
//    }
}
