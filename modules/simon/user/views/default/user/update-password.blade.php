@extends('user::default.user')
@section('user_container')
    <div class=" white radius">
        <h4 class="user-title">修改密码</h4>
        @include('kernel::layout.alert')
        <form action="{{route('update_password')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label>原密码</label>
                <input type="password" class="form-control " value="" name="old_password" placeholder="">
            </div>
            <div class="form-group">
                <label>新密码</label>
                <input type="password" class="form-control " value="" name="password" placeholder="">
            </div>
            <div class="form-group mt30">
                <button type="submit" class="btn btn-success btn-block">修改密码</button>
            </div>
        </form>
    </div>
@endsection