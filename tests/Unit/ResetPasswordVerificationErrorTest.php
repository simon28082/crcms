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

class ResetPasswordVerificationErrorTest extends TestCase
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
        return new UserModel([
            'id' => 8080,
        ]);
    }

    protected function code(): string
    {
        return Str::random(6);
    }

    public function testCreate()
    {
        $code = $this->code();

        $model = $this->verification()->create(
            $this->user()->id,
            UserAttribute::VERIFY_MAIL,
            $code
        );

//        $this->assertObjectHasAttribute('ext', $model);
        $this->assertEquals($model->ext, $code);

        return $model;
    }


    /**
     * @depends testCreate
     * @param UserVerificationModel $userVerificationModel
     * @return ResetPasswordVerification
     */
    public function testErrorCode(UserVerificationModel $userVerificationModel)
    {
        $request = $this->app->make('request');
        $request->query = new ParameterBag([
            'token' => $userVerificationModel->ext,
            'user_id' => $userVerificationModel->user_id
        ]);

        config('user.verification_expired',1);
        sleep(10);
        $verify = $this->verification($request);

        try {
            $result = $verify->validate();
        } catch (\Exception $exception) {
            $this->assertContains($exception,[
                UnprocessableEntityHttpException::class
            ]);

            if ($exception instanceof UnprocessableEntityHttpException) {
                $this->assertEquals(422,$exception->getCode());
            }
        }
    }
}
