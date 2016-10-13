@extends('acl::manage.layout.layout-index')

@section('list-header')
<h3>
    节点列表
    <a class="btn btn-sm btn-default" href="{{url('manage/category/index')}}">列表</a>
</h3>
@endsection
@section('table-header')
    <th>Name</th>
    <th>Node</th>
    <th>App</th>
    <th>Status</th>
    <th>Remark</th>
@endsection

@section('table-list')
    @foreach($models as $model)
    <tr>
        <td><input type="checkbox" name="id[]" value="{{$model->id}}"></td>
        <td>{{$model->name}}</td>
        <td>{{$model->node}}</td>
        <td>{{$model->app_id}}</td>
        <td>{{$status[$model->status]}}</td>
        <td>{{$model->remark}}</td>
    </tr>
    @endforeach
@endsection