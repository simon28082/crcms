@extends('manage::default.layout')

@section('body')

    <form action="{{route('admins.update',['admin'=>$model->id])}}" method="post">
        {{csrf_field()}}
        {{method_field('put')}}
        <div class="form-group">
            <label>用户名</label>
            <input type="text" class="form-control" name="name" value="{{$model->name}}">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="text" class="form-control" name="password" placeholder="为空不修改">
        </div>
        <div class="form-group">
            @foreach($status as $key=>$value)
            <label class="radio-inline">
                <input type="radio" name="status" value="{{$key}}" {{$key==$model->status ? 'checked' : null}}> {{$value}}
            </label>
            @endforeach
        </div>
        <div class="form-group">
            <button class="btn btn-success">提交</button>
        </div>
    </form>

@endsection


