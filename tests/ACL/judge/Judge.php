<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Judge extends TestCase
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

    protected function user()
    {
        $user =  \Simon\User\Models\User::find(1);
        if (empty($user))
        {
//             $user = new \Simon\User\Models\User(config('acl.user'));
                $user = config('acl.acl_user');
        }

        return $user;
    }

/*    public function testUserJudge()
    {
        $user = $this->user();

        $userAcl = new \Simon\Acl\Services\UserAcl($user);

//        dd($userAcl->getUser());

//        dd($userAcl->getUserPermission());
//        dd($userAcl->getRole());
        dd($userAcl->getRolePermission());
    }*/

    protected function _testData()
    {
        return \Simon\Acl\Models\Test::find(1);
    }

    public function testDataJudge()
    {
        $data = $this->_testData();
        $acl = new \Simon\Acl\Services\DataAcl($data);

//        dd($acl->getUser());
//        dd($acl->getUserPermission());
//        dd($acl->getRole());
        dd($acl->getRolePermission());
//        dd($acl->getOther());
//        dd($acl->getOtherPermission());
    }

}
