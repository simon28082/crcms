<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 20:24
 */
return [
//    'acl'=>[
//        'other'=>[],
//        'role'=>['R'],
//        'user'=>['R','W']
//    ],

//    'user'=>['id'=>0,'username'=>'test'],
    'acl_user'=>new \Simon\User\Models\User(['id'=>0,'username'=>'test']),

    //默认的用户权限
    'acl_user_permission'=>collect([
//        new \Simon\Acl\Models\Permission(['node'=>'R']),
//        new \Simon\Acl\Models\Permission(['node'=>'W']),
    ]),

//    'acl_role'=>[0],//id 默认为0 - 则为默认组
    'acl_role'=>collect([
        new \Simon\Acl\Models\AclRole(['id'=>0,'name'=>'默认角色','status'=>1]),
    ]),//id 默认为0 - 则为默认组

    //默认组的权限，如果有多个默认组，那么每个默认组都会有如下多个权限
    //
    'acl_role_permission'=>collect([
        new \Simon\Acl\Models\Permission(['node'=>'R']),
        new \Simon\Acl\Models\Permission(['node'=>'W']),
    ]),

    'acl_other'=>collect([
        new \Simon\Acl\Models\AclOther(['id'=>0,'name'=>'其它用户','status'=>1]),
    ]),//id 默认为0 - 则为默认组

    'acl_other_permission'=>collect([
//        new \Simon\Acl\Models\Permission(['node'=>'R']),
    ]),

];