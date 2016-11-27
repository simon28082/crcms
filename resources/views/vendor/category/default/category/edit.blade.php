@extends('category::default.layout')

@section('body')

    <form action="{{route('categories.update',['category'=>$model->id])}}" method="post" @submit.prevent="store">
        {{method_field('put')}}
        {{csrf_field()}}
        <div class="form-group">
            <label class="">上层分类</label>
            <select class="form-control" name="parent_id" v-model="category.parent_id">
                <option value="0">顶层分类</option>
                @foreach($models as $key=>$value)
                    <option value="{{$value['id']}}" {{$value['id']==$model->parent_id ? 'selected' : null}}>
                        {{$value['delimiter']}}
                        {{$value['name']}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>分类名称</label>
            <input type="text" value="{{$model->name}}" v-model="category.name" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>分类Key</label>
            <input type="text" value="{{$model->mark}}" v-model="category.mark" class="form-control" name="mark">
        </div>
        <div class="form-group">
            <div class="form-group">
                @foreach($status as $key=>$value)
                    <label class="radio-inline">
                        <input type="radio" {{$model->status==$value ? 'checked' : null}} v-model="category.status" name="status" value="{{$key}}" {{$key==1 ? 'checked' : null}}> {{$value}}
                    </label>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label>备注</label>
            <textarea name="remark" class="form-control" v-model="category.remark">{{$model->remark}}</textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">提交</button>
        </div>
    </form>
@endsection

@push('script')
    <script>
    </script>
@endpush

@stack('script')