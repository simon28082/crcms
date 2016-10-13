@extends('kernel::layout.manage-layout')
@section('main')
<div class="clearfix mb10">
	<div class="search pull-left">
		<form action="" class="form-inline" method="get">
			@yield('search-item')
		</form>
	</div>
	<div class="election-operation pull-right">
		<form class="form-inline">
			<div class="form-group">
				<select name="" id="" class="form-control input-sm">
					<option value="">选择批量操作</option>
					@yield('table-btn')
				</select>
			</div>
			<button type="button" class="btn btn-sm btn-default btn-execute">Execute</button>
		</form>
	</div>
</div>
<table class="table table-hover table-striped">
	<tr>
		<th><input type="checkbox" name="ids" class="allElection" v-model="checked" @click="setElementCheck" /></th>
		@yield('table-header')
	</tr>
	@yield('table-list')
	<?php /*
	@foreach($models as $model)
	<tr>
		<td><input type="checkbox" name="id[]" value="{{$model->id}}" /></td>
		@yield('list-list')
	</tr>
	@endforeach*/?>
</table>
<div>
	<div class="page-container pull-left">@yield('paginate')</div>
	<div class="election-operation pull-right">
		<form class="form-inline">
			<div class="form-group">
				<select name="" id="" class="form-control input-sm">
					<option value="">选择批量操作</option>
					@yield('table-btn')
				</select>
			</div>
			<button type="button" class="btn btn-sm btn-default btn-execute">Execute</button>
		</form>
	</div>
</div>
@endsection
@section('script')
@parent
<script>

	/*new Vue({
		el:'.table',
		data:{
			checked:false,
			checked2:false,
		},
		methods:{
			setElementClick:function()
			{
				this.checked = !this.checked;
				if (this.checked)
				{
					this.checked2 = true;
				}
				else
				{
					this.checked2 = false;
				}

			}
		}
	});*/

$(function(){
	//单删除
	$.CR.ajax('.destroy-value',function($object){
		return {
			data:{_method:'DELETE',id:[$object.attr('value')],hash:[$object.attr('hash')]}
		}
	});

	//批量操作
	$('.btn-execute').on('click',function(){
		if($(this).closest('form').find('select').val() === 'destroy')
		{
			if(!confirm('是否确定要删除？'))
			{
				return false;
			}
			
			$.ajax({
				url:$(this).closest('form').find('select option:selected').attr('ajax-url'),
				type:'POST',
				dataType:'json',
				data:{_method:'DELETE',id:$.CR.ids(),hash:$.CR.ids('hash')},
				beforeSend:$.noop,
				error:$.noop,
				success:function(data, textStatus, jqXHR){
					alert(data.app_message);
					if(data.app_code == 1000)
					{
						window.location.reload();
					}
				},
				complete:$.noop
			});
		}
	});

	//全选、全不选
	$.CR.allElection('.allElection','id[]');
});

</script>
@endsection
