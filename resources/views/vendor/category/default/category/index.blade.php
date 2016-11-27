@extends('category::default.layout')


@section('body')

        <div class="row mb20 ">
            <div class="col-md-8">
                <form action="" class="form-inline" method="get">
                    <div class="form-group">
                        <input type="text" name="title" placeholder="搜索标题" class="form-control input-sm" />
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control input-sm">
                            <option value="">类别</option>
                            <option value="21">

                                abcdea
                            </option>
                            <option value="16">

                                fda
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control input-sm">
                            <option value="">状态</option>
                            <option value="1">开启</option>
                            <option value="2">隐藏</option>
                            <option value="3">禁止</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">搜索</button>
                </form>
            </div>
            <div class="col-md-4 text-right">
                <form class="form-inline">
                    <div class="form-group">
                        <select name="" id="" class="form-control input-sm">
                            <option value="">选择批量操作</option>
                            <option value="destroy" ajax-url="http://localhost/3.1/public/manage/category/destroy">删除</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-sm btn-success btn-execute">执行</button>
                    <a class="btn btn-sm btn-primary" href="{{route('categories.create')}}">新增分类</a>
                </form>
            </div>
        </div>
        <table class="table table-hover table-striped">
            <tr>
                <th><input type="checkbox" name="ids" class="allElection" /></th>
                <th>名称</th>
                <th>状态</th>
            </tr>
            @foreach($models as $model)
            <tr>
                <td><input type="checkbox" name="id[]" value="{{$model['id']}}" /></td>
                <td>
                    <div class="pull-left" style="width: auto;">
                        {{$model['delimiter']}}
                    </div>
                    <div class="pull-left" style="width: auto;">
                        <p class="mb0">{{$model['name']}}&nbsp;&lt;{{$model['mark']}}&gt;</p>
                        <p class="mb0">
                            <a href="{{route('categories.edit',['category'=>$model['id']])}}" class="fs12">编辑</a>
                            <a href="###" class="ml5 fs12 destroy-value" ajax-tip="是否确定要删除？" value="21" ajax-url="{{route('categories.destroy',['category'=>$model['id']])}}">删除</a>
                        </p>
                    </div>
                </td>
                <td>开启</td>
            </tr>
            @endforeach
        </table>
        <div class="page-container text-right"></div>

@endsection