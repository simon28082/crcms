<?php
/**
 *
 *@include('kernel::layout.alert')
 */
?>

@extends('kernel::layout.layout')
@include('kernel::default.style')
@section('body')
    @include('kernel::default.header')
    <?php $user = \Simon\User\Facades\User::user(); ?>
    <div class="user-global user-box">
        <div class="container ">
            <div class="row">
                <div class="col-md-2">
                    <img class="img-circle img-responsive" src="https://sf-static.b0.upaiyun.com/v-57d7cc42/global/img/user-256.png" alt="">
                </div>
                <div class="col-md-10">
                    <h3>{{$user->name}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="user-box user-nav"><!-- style="border-top:1px solid #EEEEEE;"-->
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-default panel-nav">
                        <div class="panel-heading">
                            <h4 class="panel-title">我的信息</h4>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item"><a href="{{route('basic_information')}}">基本资料</a></li>
                                <li class="list-group-item"><a href="{{route('update_password')}}">修改密码</a></li>
                                <li class="list-group-item"><a href="{{route('verify_email')}}">验证邮件</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    @yield('user_container')
                </div>
            </div>
        </div>
    </div>
    @include('kernel::default.footer')
@endsection

