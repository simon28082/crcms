<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="host" content="{{ url('/') }}">
    <title>Manage</title>
    @include('kernel::style')
    <link rel="stylesheet" href="{{static_asset('vendor/global/css/global.css')}}">
    @yield('style')
</head>
<body>
<div class="container-fluid pl25 pr20 mt20">
@yield('body')
</div>
@push('script')
@include('kernel::script')

{{--<script src="{{static_asset('vendor/vue-resource/vue-resource.min.js')}}"></script>--}}
{{--<script src="{{static_asset('vendor/category/js/category.js')}}"></script>--}}
@include('kernel::alert')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function(){
        //单删除
        $tool.ajax('.destroy-value',function($object){
            return {
                data:{_method:'DELETE'}
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
                    success:function(response, textStatus, jqXHR){
                        $tool.message(response.message,function(){
                            if(response.appCode == 1000)
                            {
                                window.location.reload();
                            }
                        });
                    },
                    complete:$.noop
                });
            }
        });

        //全选、全不选
        $tool.allElection('.allElection','id[]');

        $('#test').on('click',function(){
            $tool.open('新增用户','{{route('admins.create')}}');
        });
    });
</script>

@endpush

@stack('script')
</body>
</html>