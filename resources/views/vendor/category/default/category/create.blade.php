@extends('category::default.layout')

@section('body')

    <form action="{{route('categories.store')}}" method="post" @submit.prevent="store">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label class="">上层分类</label>
            <select class="form-control" name="parent_id" v-model="category.parent_id">
                <option value="0" selected>顶层分类</option>
                @foreach($models as $key=>$model)
                    <option value="{{$model['id']}}">
                        {{$model['delimiter']}}
                        {{$model['name']}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>分类名称</label>
            <input type="text" v-model="category.name" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>分类Key</label>
            <input type="text" v-model="category.mark" class="form-control" name="mark">
        </div>
        <div class="form-group">
            <div class="form-group">
                @foreach($status as $key=>$value)
                    <label class="radio-inline">
                        <input type="radio" v-model="category.status" name="status" value="{{$key}}" {{$key==1 ? 'checked' : null}}> {{$value}}
                    </label>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label>备注</label>
            <textarea name="remark" class="form-control" v-model="category.remark"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">提交</button>
        </div>
    </form>
@endsection
