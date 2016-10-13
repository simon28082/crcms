@extends('acl::manage.layout.layout')
@section('list-header')
    <h3>
        新增节点
        <a class="btn btn-sm btn-default" href="{{url('manage/category/index')}}">列表</a>
    </h3>
@endsection
@section('main')
    <form action="{{url('manage/acl/permissions/'.$model->id)}}" method="POST" class="" id="form" @submit.prevent="postForm">
        <input type="hidden" name="_method" value="PUT">
        {{csrf_field()}}
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" v-model="form.element.name" placeholder="name" name="name" value="{{$model->name}}">
        </div>
        <div class="form-group">
            <label>Node</label>
            <input type="text" readonly="readonly" class="form-control" v-model="form.element.node" placeholder="node" name="node" value="{{$model->node}}">
        </div>
        <div class="form-group">
            <input type="hidden" name="app_id" value="{{$model->app_id}}">
            <label>App</label>
            <select name="" disabled="disabled" id="" class="form-control" v-model="form.element.app_id">
                <option value="">select authorize app</option>
                @foreach($openApp as $app)
                <option value="{{$app->id}}" {{$app->id==$model->app_id ? 'selected' : null}}>{{$app->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <div>
                @foreach($status as $key=>$value)
                    <label class="radio-inline">
                        <input type="radio" v-model="form.element.status" name="status" {{$key==$model->status ? 'checked' : null}} value="{{$key}}"> {{$value}}
                    </label>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label>Remark</label>
            <textarea name="remark" v-model="form.element.remark" class="form-control" placeholder="remark" rows="2">{{$model->remark}}</textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Submit</button>

        </div>
    </form>
@endsection

@section('script')
    @parent
    <script>
        /*
        new Vue({
            el:'#form',
            data:{
                form:{
                    element:{
                        '_method':'POST',
                        '_token':'{{csrf_token()}}',
                    },
                    action:'{{url('manage/acl/permissions')}}',
                    method:'POST',
                },
            },
            methods:{
                postForm:function()
                {
                    var form = this.form;
                    $.ajax({
                        url:form.action,
                        type:form.method,
                        dataType:'json',
                        data:form.element,
                        success:function(response){
                            //alert(response.app_message);
                        },
                        error:function(response) {
                            var app = response.responseJSON;
//                            var app = $.parseJSON(response.responseJSON);
//                            console.log(app);
                            alert(app.app_message);
//                            console.log(response);
                        },
                        complete:function () {
                            
                        }
                    })
                }
            }
        })*/

    </script>
@endsection
