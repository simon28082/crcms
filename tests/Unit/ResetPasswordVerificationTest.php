<?php

namespace Tests\Unit;

use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserModel;
use CrCms\User\Models\UserVerificationModel;
use CrCms\User\Services\Verification\RegisterMailVerification;
use CrCms\User\Services\Verification\ResetPasswordVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordVerificationTest extends TestCase
{

    protected function verification($request = null): ResetPasswordVerification
    {
        $params = $request ? ['request' => $request] : [];

        return $this->app->make(ResetPasswordVerification::class, $params);
    }

    /**
     * @return UserModel
     */
    protected function user(): UserModel
    {
        return UserModel::orderBy('created_at','desc')->firstOrFail();
    }

    protected function code(): string
    {
        return Str::random(6);
    }

    public function testCreate()
    {
        $code = $this->code();

        $model = $this->verification()->create(
            $this->user(),
            UserAttribute::VERIFY_MAIL,
            $code
        );

//        $this->assertObjectHasAttribute('ext', $model);
        $this->assertEquals($model->ext, $code);

        return $model;
    }

    /**
     * @depends testCreate
     */
    public function testVerify(UserVerificationModel $userVerificationModel)
    {
        $request = $this->app->make('request');
        $request->query = new ParameterBag([
            'token' => $userVerificationModel->ext,
            'user_id' => $userVerificationModel->user_id
        ]);

        $verify = $this->verification($request);
        $result = $verify->exists($this->user(),$userVerificationModel->ext);

        $this->assertEquals($result, true);

        return $this->verification($request)->current($this->user(),$userVerificationModel->ext);
    }

    /**
     * @depends testVerify
     * @param ResetPasswordVerification $resetPasswordVerification
     */
    public function testUpdate(UserVerificationModel $userVerificationModel)
    {
        $model = $this->verification()->update($userVerificationModel,UserAttribute::VERIFY_STATUS_SUCCESS);

        $this->assertEquals(UserAttribute::VERIFY_STATUS_SUCCESS,$model->status);
    }
}
