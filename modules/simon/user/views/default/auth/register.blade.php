@extends('kernel::layout.layout')

@include('kernel::default.style')

@section('body')
@include('kernel::default.header')

<div class="container">
    <div class="row mt20">
        <div class="col-md-3 hidden-xs"></div>
        <div class="col-md-6 col-xs-12">
            <div class="auth-box white radius">
                <h2 class="text-center mb30">用户注册</h2>
                @include('kernel::layout.alert')
                <form action="{{route('register')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control input-lg" value="{{old('name')}}" name="name">
                    </div>


                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control input-lg" name="email" value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control input-lg" name="password" value="{{old('password')}}">
                    </div>

                    @include('kernel::layout.verify-code',['openVerify'=>$openVerify])

                    <div class="form-group mt30">
                        <button type="submit" class="btn-lg btn btn-success btn-block">Register</button>
                    </div>
                    <p class="clearfix">
                        <a href="{{route('login')}}" class="pull-right">立即登录</a>
                    </p>
                </form>
            </div>
        </div>
        <div class="col-md-3 hidden-xs"></div>
    </div>
</div>


@include('kernel::default.footer')
@endsection

