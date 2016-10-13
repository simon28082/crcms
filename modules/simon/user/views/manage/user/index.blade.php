@extends('layout.manage-index')
@section('list-header')
<h3>
	用户列表
	<a class="btn btn-sm btn-default" href="{{url('manage/admin/create')}}">加用户</a>
</h3>
@endsection

@section('search-item')
<div class="form-group">
	<input type="text" name="user" value="{{input('user')}}" placeholder="name or email or mobile" class="form-control input-sm" />
</div>
<div class="form-group">
	<select name="mail_status" class="form-control input-sm">
		<option value="">Mail status</option>
		@foreach($mailStatus as $key=>$value)
			<option value="{{$key}}" {{input('mail_status') !== '' && input('mail_status')==$key ? 'selected' : null}}>{{$value}}</option>
		@endforeach
	</select>
	<select name="mobile_status" class="form-control input-sm">
		<option value="">Mobile status</option>
		@foreach($mobileStatus as $key=>$value)
			<option value="{{$key}}" {{input('mobile_status') !== '' && input('mobile_status')==$key ? 'selected' : null}}>{{$value}}</option>
		@endforeach
	</select>
</div>
<button type="submit" class="btn btn-sm btn-default">Search</button>
@endsection

@section('table-header')
<th>Nmae</th>
<th>E-Mail</th>
<th>Mobile</th>
<th>LoginTime</th>
<th>LoginIp</th>
<th>Status</th>
@endsection

@section('table-list')
	@foreach($models as $model)
	<tr>
		<td><input type="checkbox"  v-model="checked2" name="id[]" value="{{$model->id}}" /></td>
		<td>
			<div>{{$model->name}}</div>
			<div>
				<a href="{{url('manage/users/'.$model->id)}}" class="fs12">编辑</a>
				<a href="###" class="ml5 fs12 destroy-value" ajax-tip="是否确定要删除？" value="{{$model->id}}" ajax-url="{{url('manage/admin/destroy')}}">删除</a>
				<a href="###" class="ml5 fs12">查看</a>
			</div>
		</td>
		<td>{{$model->email}}&nbsp;{{$model->email ? "({$model->mail_status})" : null}}</td>
		<td>{{$model->mobile}}&nbsp;{{$model->mobile ? "({$model->mobile_status})" : null}}</td>
		<td>{{$model->login_time ? format_date($model->login_time) : null}}</td>
		<td>{{long_ip($model->login_ip)}}</td>
		<td>{{$model->status}}</td>
	</tr>
	@endforeach
@endsection

@section('paginate')
{!! $models->links() !!}
@endsection

@section('table-btn')
<option value="destroy" ajax-url="{{url('manage/admin/destroy')}}">删除</option>
@endsection
