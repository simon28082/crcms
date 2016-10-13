@extends('kernel::layout.manage-layout')
@section('sidebar')
    <h2 class="logo">Acl</h2>
    <div class="sidebar">
        <ul class="nav nav-pills nav-stacked">
            <li id="accordion-acl" class="active">
                <a href="#collapse-ul-acl" data-parent="#accordion-acl" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">Acl权限</a>
                <ul  id="collapse-ul-acl" class="collapse in">
                    <li><a href="{{url('manage/acl/permissions')}}">权限节点</a></li>
                </ul>
            </li>
        </ul>
    </div>
@endsection

