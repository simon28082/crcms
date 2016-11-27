"use strict";

var $tool = (function(layer,$){

    var $tool = {};

    /**
     *
     * @param message
     * @param options
     * @param callback
     */
    $tool.message = function(message,options,callback){
        if (typeof options==='function')
        {
            callback = options;
            options = {};
        }
        else if(typeof options=== 'object')
        {
            options = $.extend(true,{time: 2000},options);
        }
        else
        {
            options = {};
        }

        layer.msg(message,options,callback);
    };


    /**
     *
     * @param response
     * @param callback
     */
    $tool.responseHandle = function(response,callback){
        $tool.message(response.message,callback);
    }

    /**
     *
     * @param url
     * @param params
     * @returns {string}
     */
    $tool.url = function (url,params,host) {

        //host
        host = host ? host : $('meta[name="host"]').attr('content');
        // 去除/
        url = url.indexOf('/') === 0 ? url.substring(1,url.length) : url;

        params = (typeof params === 'object' && params) ? '?'+$.param(params) : '';

        return host+'/'+url+params;
    }


    /**
     * 全选
     * @param selecter
     * @param name
     */
    $tool.allElection = function(selecter,name){
        $(selecter).on('click',function(event){
            //event.stopPropagation();
            var checkStatus = $(this).prop('checked'),$name = $('input[name="'+name+'"]');
            checkStatus ? $name.prop('checked',true) : $name.prop('checked',false);
        });
    }


    /**
     * 反选
     * @param selecter
     * @param name
     */
    $tool.antiElection = function(selecter,name) {
        $(selecter).on('click',function(event){
            //event.stopPropagation();
            var checkStatus = null,$name = null;
            $('input[name="'+name+'"]').each(function(){
                $name = $(this);
                checkStatus = $name.prop('checked');
                checkStatus ? $name.prop('checked',false) : $name.prop('checked',true);
            });
        });
    }

    /**
     *
     * @param attr
     * @param name
     * @returns {Array}
     */
    $tool.ids = function(attr,name){
        attr = attr || 'value';
        name = name || "input[name='id[]']:checked";
        var ids = [];
        $(name).each(function(){
            ids.push(attr === 'value' ? $(this).val() : $(this).attr(attr));
        });
        return ids;
    }


    /**
     *
     * @param selecter
     * @param callback
     * @param event
     */
    $tool.ajax = function(selecter,callback,event){
        var defaults = {
            url:'',
            type:'POST',
            dataType:'json',
            data:{},
            beforeSend:$.noop,
            error:$.noop,
            success:function(data, textStatus, jqXHR){
                $tool.message(data.message,window.location.reload());
            },
            complete:$.noop
        },$selecter = $(selecter),ajaxurl='',ajaxtip=null,$this=null,options={};
        //定义默认事件
        event = event || 'click';
        $selecter.on(event,function(){
            $this = $(this);
            //参数配置设置
            if(typeof(callback) === 'function') {
                options = callback($this);
            }
            if(typeof(options)==='object' && !$.isEmptyObject(options)) {
                options = $.extend(true,defaults, options);
            }
            //重新设置URL
            options.url = $this.attr('ajax-url') || options.url;
            if(!options.url) return false;
            //confirm提醒
            ajaxtip = $(this).attr('ajax-tip');
            if(ajaxtip && !confirm(ajaxtip)) return false;
            $.ajax(options);
        });
    }

    /**
     *
     * @param title
     * @param url
     */
    $tool.open = function(title,url,isFull){

        //options
        var options = {};
        if (typeof title==='object')
        {
            options = title;
        }
        else
        {
            options['title'] = title;
            options['content'] = url;
            options['type'] = 2;
        }

        var index = layer.open(options);

        isFull = isFull || true;
        isFull && layer.full(index);
	return index;
    }

    return $tool;
})(layer,jQuery);




