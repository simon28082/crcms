<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/1
 * Time: 20:26
 */

namespace Simon\Acl\Http\Controllers\Manage;


use Illuminate\Support\Facades\DB;
use Simon\Acl\Models\AclRole;
use Simon\Acl\Models\Test;
use Simon\Kernel\Http\Controllers\Controller;
use Simon\User\Models\User;

class TestController extends Controller
{

    public function index()
    {
        $config = config('acl.acl');

        $models = Test::get();//where('user_id',1)->

        /*
         *
         * 如果用户不存在，则判断组，
         * 组也不存在，则判断 other权限，并不是用户不存在判断默认用户权限
         */

        $permissionMark = 'R';

        $user = User::find(1);//模拟自己登陆

        //获取我对数据的权限
        $selfPermission = $user->hasBelongsToManyPermission()->pluck('node','id')->all();
        if (empty($selfPermission))
        {
            $selfPermission = $config['user'];
        }

        //获取我的所属组
        $selfRole = $user->hasBelongsToManyAclRole()->pluck('id')->all();

        if ($selfRole)
        {

            //获取我的所属组权限
            $selfRolePermission = [];
            foreach ($user->hasBelongsToManyAclRole()->get() as $role) {
                $selfRolePermission += $role->hasBelongsToManyPermission()->pluck('node', 'id')->all();
            }
        }
        else
        {
            $selfRole = config('acl.acl_role');//默认组
            $selfRolePermission = $config['role'];
        }

//dd
//
//        //查询我的组所属权限
//        $selfRolePermission = $user->hasBelongsToManyAclRole()->hasBelongsToManyPermission()->pluck('node','id')->all();
//
//        dd(DB::getQueryLog(),$selfRolePermission);
//
//        $selfRole = $user->hasBelongsToManyAclRole()->get();
//dd(DB::getQueryLog(),$selfRole);
//        if (!$selfRole) //如果我的组为空，则默认组权限
//        {
//            $selfRole = $config['role'];
//        }

        foreach ($models as $model)
        {

            //获取此条数据的所有者和所有组和other用户的权限


            //获取组
            $modelRole = $model->hasBelongsToManyRole('test')->pluck('id')->all();

            //获取组权限
            if (empty($modelRole))//如果没有设置组，则使用默认组权限
            {
                $modelRole = config('acl.acl_role');//默认组

                $modelRolePermission = $config['role'];
            }
            else
            {   $modelRolePermission = [];
                foreach ($model->hasBelongsToManyRole('test')->get() as $role)
                {
                    $modelRolePermission += $role->hasBelongsToManyPermission()->pluck('node','id')->all();
                }
            }



            //如果发布人和登录人相同
            if ($model->user_id === $user->id)
            {
                //如果发布人没有权限，则使用默认

                //判断发布人的权限（也是登录人的权限）
                if (in_array($permissionMark,$selfPermission,true))
                {
                    continue;
                }
                else
                {
                    //delete
                }
            }


            //如果发布人，不是自己，则判断当条数据的组和自己的组是否相同
            if ($model->user_id !== $user->id)
            {
                //如果有相同组
                $roles = array_intersect($selfRole,$modelRole);
                if ($roles)
                {
                    foreach ($roles as $role)
                    {
                        //获取这个组的权限
                        $searchResult = AclRole::find($role)->hasBelongsToManyPermission()->get()->search(function($item) use ($permissionMark){
                            return $item->node === $permissionMark;
                        });
                        if ($searchResult !== false)//如果有可读权限
                        {
                            continue;
                        }
                    }
                }
                else //没有相同组，则判断此条数据的other权限
                {
                    foreach ($model->hasBelongsToManyOther('test')->get() as $other)
                    {
                        $modeOtherPermission = $other->hasBelongsToManyPermission()->pluck('node','id')->all();
                        if (in_array($permissionMark,$modeOtherPermission,true))
                        {
                            continue;
                        }
                    }
                }
            }

            //如果用户不存在
            if (empty($model->user_id))
            {

            }

















































            //如果这个创建人是我的话
            if($model->user_id === $user->id)
            {
                //获取我的用户权限节点
                $nodes = $user->hasOneUser->hasBelongsToManyPermission()
                    ->select('node')->get();

                if(!$nodes->isEmpty()) //如果有权限节点
                {
                    $permission = $nodes->search(function($item) use ($permissionMark){
                        return $item->node === $permissionMark;
                    });

                    if ($permission !== false) //包含权限
                    {
                        continue;
                    }
                }
                else//如果用户（也就是我）没有权限任何节点-则使用默认权限
                {
                    if (in_array($permissionMark,$config['user'],true))
                    {
                        continue;
                    }
                }
            }

            //创建人不是我，那么查看创建人和我是否有相同的组
            //获取我的组$selfRole

            //获取当前用户组

            $modelUser = $model->hasOneUser->hasBelongsToManyAclRole()->get();

            //发布者没有组，则默认组权限  我也没有组，则也是公共组
            if (!$modelUser && !$selfRole) //两个都没有组，则是相同组，可以有相同组的权限
            {
                $role = $config['role'];//rw
                if (in_array($permissionMark,$role,true))
                {
                    continue;
                }
            }

            //此用户有组的话 并且我也有组的话
            if($modelUser && $selfRole)  //丙个都有组的话，要判断有没有公共相同组，进而来判断权限
            {
                //判断 我的组在不在发布人组中，
//                $newRole = $modelUser->each(function($item,$key) use ($selfRole){
//                    $selfRole->each(function ($item2,$key2) use ($item){
//                        $item->where()
//                });
//                });
                if (true) //如果在发布人组中
                {
                    if (true) //判断 有R权限
                    {
                        continue;
                    }
                }
            }

            //如果我有组，发布人没有组则是默认组 -   -- 此种情况往下执行
            if ($selfRole && !$modelUser) //组并不相同
            {
                //Kill delete
            }

            //如果发布人有组，我没有组，那么肯定是不能执行的  -- 此种情况往下执行
            if ($modelUser && !$selfRole)
            {
                //Kill delete
                //默认组权限  RW
            }


            //Other权限判断
            //获取此条数据的Other组

















            //否则，如果我的组为空或者$modelUser发布者的组没有


//            elseif ($modelUser)//数据用户没有组，







            //如果创建人不是我，并且也和我不在同一个组，那么就是other权限




















            //判断用户是否存在
            if ($model->hasOneUser)
            {

                if($model->user_id === $userid) //默认有读写权限
                {

                }


                //获取用户权限节点
                $nodes = $model->hasOneUser->hasBelongsToManyPermission()
                    ->select('node')->get();
                if($nodes) //如果有权限节点
                {
                    $permission = $nodes->search(function($item) use ($permissionMark){
                        return $item->node === $permissionMark;
                    });

                    if ($permission !== false) //包含权限
                    {
                        continue;
                    }
                }
                else//如果没有权限节点-则使用默认权限
                {
                    if (in_array($permissionMark,$config['user'],true))
                    {
                        continue;
                    }
                }
                if ($model->hasOneUser->hasBelongsToManyPermission()
                    ->select('node')->get())

                //查找用户权限
                $permission = $model->hasOneUser->hasBelongsToManyPermission()
                                    ->select('node')->get()
                                    ->search(function($item) use ($permissionMark){
                                        return $item->node === $permissionMark;
                                    });
                if ($permission !== false) //包含权限
                {
                    continue;
                }
            }


            //用户不存在，则判断是否有用户组













            //else 则读取默认用户权限[在没有userid字段或未查找到用户对应的权限时]
            if (in_array('R',$config['user'],true))
            {
                continue;
            }

            //======================做到些处

            //没有用户或未找到对应权限，则判断其内容用户组

            //没有user,获取组
            $roles = $model->hasBelongsToManyRole('abc')->get();
            //没有组，读取配置文件，获取默认组权限
            if ($roles->isEmpty())
            {
                if (in_array('R',$config['role'],true))
                {
                    continue;
                }
            }

        }
    }

}
