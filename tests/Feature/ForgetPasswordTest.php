<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018-04-23 21:23
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace Tests\Feature;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserModel;
use CrCms\User\Models\UserVerificationModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ForgetPasswordTest
 * @package Tests\Unit
 */
class ForgetPasswordTest extends TestCase
{
    /**
     *
     */
    public function testResetPasswordGetUrl()
    {
        $user = $this->getUser();
        $userVerification = $this->getUserVerificatioin();
dump($user->email);
        $response = $this->post('/api/v1/auth/reset-password-url',[
            'email' => $user->email,
            'token' => $userVerification->ext
        ],['Accept'=>'application/json']);

        $content = $response->getContent();

        $this->assertEquals(200,$response->getStatusCode());

        $content = json_decode($content,true)['data'];

        $this->assertArrayHasKey('url',$content);

        $url = str_replace(env('APP_URL'),'',$content['url']);
        dump($url);
        $password = Str::random(10);
        $response = $this->post($url,['password'=>$password,'password_confirmation'=>$password],[
            'Accept'=>'application/json'
        ]);

        if ($response->getStatusCode() === 500) {
            dump($response->getContent());
        } else {
            $this->assertEquals(204,$response->getStatusCode());
        }

        $user = $this->getUser();

        $this->assertTrue(Hash::check($password,$user->password));
    }

    /**
     * @return UserVerificationModel
     */
    protected function getUserVerificatioin(): UserVerificationModel
    {
        $model =  UserVerificationModel::orderBy('created_at','desc')->firstOrFail();
        $model->status = UserAttribute::VERIFY_STATUS_NO;
        $model->save();
        return $model;
    }

    protected function getUser()
    {
        $model = UserModel::where('id',$this->getUserVerificatioin()->user_id)->firstOrFail();

        return $model;
    }
}