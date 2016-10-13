@extends('user::default.user')
@section('user_container')
    <div class="white radius">
        <h4 class=" user-title">基本资料</h4>
        @include('kernel::layout.alert')
        <form class="" action="{{route('basic_information')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label>姓名</label>
                <div>
                    <input type="text" class="form-control " value="{{$userInfo->real_name ?? null}}" name="real_name" placeholder="请填写您的真实姓名">
                </div>
            </div>
            <div class="form-group">
                <label>生日</label>
                <input type="text" class="form-control " value="{{$userInfo->birthday ?? null}}" name="birthday" placeholder="如：1990-05-03">
            </div>
            <div class="form-group">
                <label>站点</label>
                <input type="text" class="form-control " value="{{$userInfo->website ?? null}}" name="website" placeholder="http:// or https://">
            </div>
            <div class="form-group">
                <label>简介</label>
                <textarea class="form-control " name="introduction" rows="2" placeholder="用一句简单的话描述自己吧！">{{$userInfo->introduction ?? null}}</textarea>
            </div>
            <div class="form-group mt30">
                <button type="submit" class="btn btn-lg btn-success btn-block">修改基本信息</button>
            </div>
        </form>
    </div>
@endsection
