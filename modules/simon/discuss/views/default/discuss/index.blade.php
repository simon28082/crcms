@extends('kernel::layout.layout')

@include('kernel::default.style')

@section('body')

@include('kernel::default.header')

<div class="container ">

    <div class="panel panel-default discuss">
        <div class="panel-heading">
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation" class="active"><a href="#">最新</a></li>
                <li role="presentation"><a href="#">热门</a></li>
                <!--
                <li role="presentation"><a href="#">未回答</a></li>
                -->
            </ul>
        </div>

        <div class="panel-body">
            <div class="discuss-content">
                <div class="row">
                    <div class="col-md-1">
                        <img class="img-circle" width="50" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjEyLjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" alt="...">
                    </div>
                    <div class="col-md-1 text-center">
                        <div>35</div><div>回答</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div>35</div><div>浏览</div>
                    </div>
                    <div class="col-md-9">
                        <h5 class=" title">网站是SESSION保持回话的ION保持回话的ION保持回话的ION保持回话的,我手动删除了客户机上的所有cookie,再次访问的时候为什么还是登录状态呢?</h5>
                        <p class="intro">
                            em0t 19 分钟前回答
                        </p>
                    </div>
                </div>

                <!--
                <ul class="list-group">
                    <li class="list-group-item">

                    </li>
                </ul>-->
                <div class="media">
                    <a class="media-left" href="#">
                        <img class="img-circle" width="50" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjEyLjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" alt="...">
                    </a>
                    <span class="media-left text-center" href="#">
                        35<br><nobr>回答</nobr>
                    </span>
                    <span class="media-left text-center" href="#">
                        40<br><nobr>浏览</nobr>
                    </span>
                    <div class="media-body">
                        <h5 class="media-heading title">网站是SESSION保持回话的ION保持回话的ION保持回话的ION保持回话的,我手动删除了客户机上的所有cookie,再次访问的时候为什么还是登录状态呢?</h5>
                        <p class="intro">
                            em0t 19 分钟前回答
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="discuss">





</div>

</div>







    @include('kernel::default.footer')
@endsection
