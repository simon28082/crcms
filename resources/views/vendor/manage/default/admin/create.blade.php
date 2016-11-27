@extends('manage::default.layout')

@section('body')

    <form action="{{route('admins.store')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label>用户名</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="text" class="form-control" name="password">
        </div>
        <div class="form-group">
            @foreach($status as $key=>$value)
            <label class="radio-inline">
                <input type="radio" name="status" value="{{$key}}" {{$key==1 ? 'checked' : null}}> {{$value}}
            </label>
            @endforeach
        </div>
        <div class="form-group">
            <button class="btn btn-success">提交</button>
        </div>
    </form>

@endsection


