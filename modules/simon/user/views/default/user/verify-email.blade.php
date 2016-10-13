@extends('user::default.user')
@section('user_container')
    <div class=" white radius">
        <h4 class="user-title">验证E-Mail</h4>
        @include('kernel::layout.alert')
        <form action="{{route('verify_send_email')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label>E-Mail</label>
                <input type="email" class="form-control " value="" name="old_password" placeholder="">
            </div>
            <div class="form-group mt30">
                <button type="submit" class="btn btn-success btn-block">修改密码</button>
            </div>
        </form>
    </div>
@endsection