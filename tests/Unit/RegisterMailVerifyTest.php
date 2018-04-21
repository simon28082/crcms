<?php

namespace Tests\Unit;

use CrCms\Foundation\App\Helpers\Hash\Contracts\HashVerify;
use CrCms\Foundation\App\Helpers\Hash\Verify;
use CrCms\User\Attributes\UserAttribute;
use CrCms\User\Models\UserModel;
use CrCms\User\Repositories\UserRepository;
use CrCms\User\Repositories\UserVerificationRepository;
use CrCms\User\Services\Verification\RegisterMailVerification;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterMailVerifyTest extends TestCase
{
    protected $registerMailVerification;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->registerMailVerification = $this->getVerification();
    }

    protected function getVerification() : RegisterMailVerification
    {
        app()->singleton(HashVerify::class,Verify::class);
        return app(RegisterMailVerification::class);
//        return new RegisterMailVerification(
//            app(Request::class),
//            new Verify(),
//            app(UserVerificationRepository::class)
//        );
    }

    protected function getUser()
    {
        return new UserModel([
            'id' => 1,
        ]);
//        return app(UserRepository::class)->byIntIdOrFail(1);
    }

    /**
     * @return string
     */
    public function testCheckUrl(): string
    {
        $this->registerMailVerification->create($this->getUser()->id,UserAttribute::VERIFY_MAIL);

        $url = $this->registerMailVerification->url();

        $this->assertNotEmpty($url);

        return $url;
        //$this->assertStringMatchesFormat()
    }

    /**
     * @depends testCheckUrl
     */
    public function testUpdate(string $url)
    {
        $url = parse_url($url);
        $query = $url['query'];
        $query = parse_str($query);

        $this->getVerification()->validate();

        $result = $this->registerMailVerification->update();

        $this->assertEquals($result->status,UserAttribute::VERIFY_STATUS_SUCCESS);
    }
}
