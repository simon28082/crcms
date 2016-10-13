@extends('kernel::layout.layout')
@section('style')
@parent
<link rel="stylesheet" href="{{static_asset('vendor/manage/css/css.css')}}" />
<link rel="stylesheet" href="{{static_asset('vendor/artdialog/6.0.2/css/ui-dialog.css')}}" />
@endsection
@section('body')
<div class="main">
	<div class="main-left">
		@section('sidebar')
			<?php /*
		<h2 class="logo">CRCMS</h2>
		<div class="sidebar">
			<ul class="nav nav-pills nav-stacked">
			     <li id="accordion0" class="active">
					<a href="#collapse-ul-0" data-parent="#accordion0" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">系统</a>
					<ul  id="collapse-ul-0" class="collapse in">
						<li><a href="{{url('manage/admin/index')}}">管理员列表</a></li>
					</ul>
				</li>
				<li id="accordion1" class="active">
					<a href="#collapse-ul-4" data-parent="#accordion4" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">模型</a>
					<ul  id="collapse-ul-4" class="collapse in">
						<li><a href="{{url('manage/model/index')}}">模型列表</a></li>
						<li><a href="{{url('manage/field/index')}}">字段列表</a></li>
					</ul>
				</li>
				<li id="accordion1" class="active">
					<a href="#collapse-ul-1" data-parent="#accordion1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">文档</a>
					<ul  id="collapse-ul-1" class="collapse in">
						<li><a href="{{url('manage/document/index')}}">文档列表</a></li>
						<li><a href="{{url('manage/doubi/index')}}">92doubi列表</a></li>
						<li><a href="{{url('manage/category/index')}}">文档分类</a></li>
					</ul>
				</li>
				<li id="accordion3" class="active">
					<a href="#collapse-ul-3" data-parent="#accordion3" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">标签</a>
					<ul  id="collapse-ul-3" class="collapse in">
						<li><a href="{{url('manage/tags/index')}}">标签列表</a></li>
						<li><a href="{{url('manage/tags-relation/index')}}">标签关联</a></li>
					</ul>
				</li>
				<li id="accordion2" class="active">
					<a href="#collapse-ul-2" data-parent="#accordion2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">日志</a>
					<ul  id="collapse-ul-2" class="collapse in">
						<li><a href="{{url('manage/log/login-log')}}">登录日志</a></li>
						<li><a href="{{url('manage/log/action-log')}}">行为日志</a></li>
					</ul>
				</li>
			</ul>
		</div>*/ ?>
		@show
	</div>
	<div class="main-right">
		<div class="container-fluid">
			<div class="list-header">
				@yield('list-header')
			</div>
			@include('kernel::layout.alert')
			@yield('main')
		</div>
	</div>
</div>
<div class="clearfix visible-xs-block"></div>
@endsection
