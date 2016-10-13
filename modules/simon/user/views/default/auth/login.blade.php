@extends('kernel::layout.layout')

@include('kernel::default.style')

@section('body')

@include('kernel::default.header')


<div class="container">
    <div class="row mt20">
        <div class="col-md-3 hidden-xs"></div>
        <div class="col-md-6 col-xs-12">
            <div class="auth-box white radius">
                <h2 class="text-center mb30">用户登录</h2>
                @include('kernel::layout.alert')
                <form action="{{route('login')}}" method="post">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control input-lg" value="{{old('name')}}" name="name" placeholder="name or mail">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control input-lg" value="{{old('name')}}" name="password" placeholder="password">
                    </div>

                    @include('kernel::layout.verify-code',['openVerify'=>$openVerify])

                    <div class="form-group mt30">
                        <button type="submit" class="btn btn-lg btn-success btn-block">登录</button>
                    </div>
                    <p class="clearfix">
                        <a class="pull-left" href="{{route('forget_password')}}">忘记密码？</a>
                        <a href="{{route('register')}}" class="pull-right">立即注册</a>
                    </p>
                </form>
            </div>
        </div>
        <div class="col-md-3 hidden-xs"></div>
    </div>
</div>







@include('kernel::default.footer')
@endsection
