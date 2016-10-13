;(function(window,$){

    $.TAGS = {
        search:function(input,url,tag_createurl){
            //
            var $typeahead = $(input);
            $typeahead.typeahead({
                source: function (query, process) {
                    return $.get(url, { 'name': query }, function (response) {
                        console.log(response);
                        if(response.app_code == 1000 && response.data.models.length > 0)
                        {
                            response.data.models.push({name:"创建标签"+query,id:-1,_name:query});
                            return process(response.data.models);
                        }
                        else{
                            return process([{name:"创建标签"+query,id:-1,_name:query}]);
                        }
                    });
                },
                minLength:1,
//			 		updater:function(item){
//			 		},
                afterSelect:function(item)
                {
                    //添加新标签
                    if(item.id == -1)
                    {
                        var contentHtml = null;
                        $.ajax({
                            async:false,
                            type:'GET',
                            data:{"name":item._name},
                            url:tag_createurl,
                            success:function(data)
                            {
                                contentHtml = data;
                                console.log(contentHtml);
                            },
                            error:function(){
                                alert('Error!');
                            }
                        });
                        //dialog弹窗
                        var d = dialog({
                            title: '创建标签',
                            content:contentHtml,
                            id:'create_tag_',
                            width:480,
                            quickClose: true,
                            ok:function(){
                                var _form = $('#create-tags');
                                this.title('正在提交...');
                                var that = this;
                                $.ajax({
                                    async:false,
                                    type:'POST',
                                    url:_form.attr('action'),
                                    data:_form.serialize(),
                                    success:function(response){
                                        console.log(response);
                                        if(response.app_code == 1000)
                                        {
                                            that.title('提交成功');
                                            item.id = response.data.model.id;
                                            item.name = response.data.model.name;
                                            console.log(item);
                                            //添加标签
                                            $.TAGS.addTag(input,item);

                                            setTimeout(function () {
                                                that.close().remove();
                                            }, 1000);
                                        }
                                        else
                                        {
                                            that.title('提交失败：'+response.app_message);
                                        }
                                    },
                                    error:function(response)
                                    {
                                        that.title('提交失败：'+response.responseJSON.app_message);
                                    }
                                });
                                return false;
                            },
                            cannel:function(){return true;}
                        });
                        d.show();
                        return false;
                    }
                    $.TAGS.addTag(input,item);
                    /*else if ($('[name="tags['+item.id+']"]').length <= 0)
                     {
                     }
                     else
                     {
                     alert('标签已选择！');
                     $(input).val('');
                     }*/
                },
//					displayText: function (item) {
//						return item.name;
//			        },
                items:'all'
            });
        }
        ,destroy:function(){
            $(document).on('click','.delete-tag-item',function(){
                var id = $(this).attr('item-id');
                $('[name="tags['+id+']"]').remove();
                $(this).parent().remove();
            });
        }
        ,addTag:function(input,item){
            if($('[name="tags['+item.id+']"]').length <= 0)
            {
                $(input).closest('form').append('<input type="hidden" name="tags['+item.id+']" value="'+item.id+'" />');
                $(input).before('<span class="tag-item"><a href="###" class="delete-tag-item" item-id="'+item.id+'">'+item.name+'<i class="ml5 glyphicon glyphicon-remove fs12"></i></a></span>');
                $(input).val('');
            }
            else
            {
                $(input).val('');
            }
        }
    }

        ,$.CR = {
        validForm:function(tags,setting) {
            //设置第一个参数直接传配置
            if(typeof(tags) == 'object') {
                setting = tags;
                tags = null;
            }
            //表单id或class
            var tags = tags ? tags : '.valid-form';
            //设置默认配置
            var defaultObject = {};
            //提示方式
            defaultObject.tiptype = function(msg,o,cssctl){
                //msg：提示信息;
                //o:{obj:*,type:*,curform:*}, obj指向的是当前验证的表单元素（或表单对象），type指示提示的状态，值为1、2、3、4， 1：正在检测/提交数据，2：通过验证，3：验证失败，4：提示ignore状态, curform为当前form对象;
                //cssctl:内置的提示信息样式控制函数，该函数需传入两个参数：显示提示信息的对象 和 当前提示的状态（既形参o中的type）;
                if(!o.obj.is("form")){//验证表单元素时o.obj为该表单元素，全部验证通过提交表单时o.obj为该表单对象;
                    var objtip = null;
                    if($.inArray(o.obj.attr('type'),['checkbox','radio']) != -1) {
                        objtip=o.obj.parent().parent();
                    } else {
                        objtip=o.obj.parent();
                    }
                    objtip =objtip.siblings(".Validform_checktip");
                    cssctl(objtip,o.type);
                    objtip.text(msg);
                }
            };
            //设置默认datatype扩展
            defaultObject.datatype = {
                "need_1":function(gets,obj,curform,regxp){
                    var need=1,numselected=curform.find("input[name='"+obj.attr("name")+"']:checked").length;
                    return  numselected >= need ? true : "请至少选择"+need+"项！";
                }
                ,"z":function(gets,obj,curform,regxp){
                    var preg = /^[\u4E00-\uFA29]+$/;
                    return preg.test(gets);
                }
                //jsonp 跨域数据获取  domainajaxurl
                ,'dmajaxurl':function(gets,obj,curform,regxp){
                    var param = $.trim(gets);
                    if(!param) return false;
                    var params = {};
                    params['param'] = param;
                    params[_VAR_AJAX_SUBMIT_] = 1;
                    params[_VAR_JSONP_HANDLER_] = '?';
                    var url = $.G.RUrlSuffix($(obj).attr('dmajaxurl'),params);
                    /*$.ajax({
                     url:url,
                     dataType:'jsonp',
                     asnyc:false,
                     success:function(data){
                     if(data.status == 'success' || data.status == 1) {
                     return true;
                     } else {
                     return data.info;
                     }
                     }
                     });*/
                    $.getJSON(url,function(data){
                        if(data.status == 'success' || data.status == 1) {
                            return true;
                        } else {
                            return data.info;
                        }
                    });
                }
            };
            //合并自定义datatype扩展，会自动覆盖默认，递归合并
            setting ? $.extend(true,defaultObject,setting) : defaultObject;
            return $(tags).Validform(defaultObject);
        }
        //全选/全不选
        ,allElection:function(selecter,name){
            $(selecter).on('click',function(event){
                //event.stopPropagation();
                var checkStatus = $(this).prop('checked'),$name = $('input[name="'+name+'"]');
                checkStatus ? $name.prop('checked',true) : $name.prop('checked',false);
            });
        }
        //反选
        ,antiElection:function(selecter,name) {
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
        ,ids:function(attr,name){
            attr = attr || 'value';
            name = name || "input[name='id[]']:checked";
            var ids = [];
            $(name).each(function(){
                ids.push(attr === 'value' ? $(this).val() : $(this).attr(attr));
            });
            return ids;
        }
        ,createForm:function(selecter,data,dataKey,isRemoveRole){

            var $selecter = typeof selecter==='string' ? $(selecter) : selecter;
            var $object = null;

            $.each(data,function(name,attrs){

                $object = $selecter.find('[role="'+attrs.role+'"]').first().clone();

                if(typeof attrs.label_name !== 'undefined' && attrs.label_name != '') {
                    $object.find('.label-name,.label_name').text(attrs.label_name);
                }

                if(typeof attrs.label_explain !== 'undefined' && attrs.label_explain != '') {
                    $object.find('.label-explain,.label_explain').text(attrs.label_explain);
                }

                //增加name属性
                attrs.attr.name = attrs.attr.name || name;

                if(dataKey)
                {
                    //attrs.attr.name = dataKey+'['+attrs.attr.name+']';
                }

                switch (attrs.role) {
                    case 'text':
                        //alert(attrs.attr);
                        $object.find('input').attr(attrs.attr);
                        break;
                    case 'textarea':
                        $object.find('textarea').attr(attrs.attr);
                        break;
                    case 'editor':
                        $object.find('script').attr(attrs.attr);
                        var ue = UE.getEditor(attrs.attr.id);
                        break;
                    case 'radio':
                    case 'checkbox':

                        //获取对象父元素及容器
                        var $parent = $object.find('input:eq(0)').parent();
                        var $container = $parent.parent();

                        //保存对象value值
                        var itemValue = attrs.attr.value;

                        $.each(attrs.option,function(value,label) {

                            if($.inArray(parseInt(value),itemValue) > -1 || itemValue == value) {
                                attrs.attr.checked = true;
                            } else {
                                attrs.attr.checked = false;
                            }

                            //重新设置value
                            attrs.attr.value = value;

                            //checkbox value
                            if (attrs.role === 'checkbox') {
                                attrs.attr.name = name+'['+value+']';
                            }

                            //添加label说明
                            //重新设置html防止循环时label叠加
                            $parent.html($parent.find('input').attr(attrs.attr));
                            $parent.append(label);

                            //保存到容器
                            $container.append($parent);

                            $parent = $parent.clone();//重新clone自己，下次循环使用
                        });

                        break;
                    case 'select':

                        //获取对象父元素及容器--
                        var $option = $object.find('option:eq(0)');
                        var $container = $option.parent();

                        //设置第一个option说明
                        $option.text('选择'+attrs.label_name);

                        //set name  -- more
                        if (attrs.attr.multiple !== undefined) {
                            attrs.attr.name = name+'[]';
                        }

                        //select attr
                        $container.attr(attrs.attr);

                        //保存对象value值
                        var itemValue = attrs.attr.value;

                        $.each(attrs.option,function(value,label) {

                            $option = $option.clone();//clone多个

                            if($.inArray(parseInt(value),itemValue) > -1 || itemValue == value) {
                                attrs.attr.selected = true;
                            } else {
                                attrs.attr.selected = false;
                            }

                            //重新设置value  -- text
                            $option.attr({'value':value}).text(label);

                            //保存到容器
                            $container.append($option);
                        });
                        break;
                }

                //移除所有规则标签
                $object.removeAttr('role');
                $selecter.append($object).show();

            });

            if(typeof isRemoveRole === 'undefined')
            {
                isRemoveRole = true;
            }

            //移除explan规范
            if(isRemoveRole)
            {
                $selecter.find('[role]').remove();
            }

        }
        ,get:function(vars,key,def){
            def = def ? def : null;
            return typeof vars[key]==='undefine' ? def : vars[key];
        }
        //批量ajax批量操作如sort ,checkbox
//		,ajax:function(selecter,event,dataCallback,callback) {
//			//callback处理
//			if(typeof(callback) !== 'function') {
//				var callback = function(result) {
//					alert(result.info);
//					if(result.status == 'success' || result.status == 1) {
//						window.location.reload();
//					}
//				};
//			}
//			var $selecter = $(selecter),ajaxurl='',object={},data={},ajaxtip=null;
//			$selecter.on(event,function(){
//				if(typeof(dataCallback) === 'function') {
//					object = dataCallback(this);
//					ajaxurl = object.ajaxurl || $(this).attr('ajax-url');
//					ajaxtip = object.ajaxtip || $(this).attr('ajax-tip');
//					data = (object.ajaxurl || object.ajaxtip) ? object.data : object;
//				} else {
//					data = dataCallback;
//					ajaxtip = $(this).attr('ajax-tip');
//					ajaxurl = $(this).attr('ajax-url');
//				}
//				if(!ajaxurl) return false;
//				if(ajaxtip && !confirm(ajaxtip)) return false;
//				$.post(ajaxurl,data,callback);
//			});
//		}
        ,ajax:function(selecter,callback,event){
            var defaults = {
                url:'',
                type:'POST',
                dataType:'json',
                data:{},
                beforeSend:$.noop,
                error:$.noop,
                success:function(data, textStatus, jqXHR){
                    alert(data.msg);
                    if(data.status == 'success' || data.status == 1000) {
                        window.location.reload();
                    }
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
        ,getSpecifyField:function(className,url) {
            var $this={},search = {},i=0,s_table=null,s_rand=null,s_token=null,s_value=null,s_s_field=null,s_g_field=null;
            $(className).each(function(){
                $this = $(this);
                s_table = $this.attr('s-table'),s_rand = $this.attr('s-rand'),s_token = $this.attr('s-token'),s_value = $this.attr('s-value'),s_s_field = $this.attr('s-s-field'),s_g_field = $this.attr('s-g-field');
                if(s_table && s_rand && s_token && s_s_field && s_g_field) {
                    search[i] = {};
                    search[i]['s_table'] = s_table,search[i]['s_rand'] = s_rand,search[i]['s_token'] = s_token,search[i]['s_value'] = s_value,search[i]['s_s_field'] = s_s_field,search[i]['s_g_field'] = s_g_field;
                    i++;
                }
            });
            var params = {};
            params[_VAR_AJAX_SUBMIT_]=1;
            params['search'] = search;
            $.CR.getJSONP(url,params,function(data){
                $.each(data,function(k,v){
                    //token是惟一值可以token标识选择，也可加入其它选择器
                    if(v.value) $('[s-token="'+v.s_token+'"]').val(v.value).text(v.value);
                });
            });
        }
        //jsonp数据获取
        ,getJSONP:function(url,data,callback){
            $.ajax({
                async:false,//同步请求
                crossDomain:true,//跨域请求
                url:url,
                data:data,
                type:'GET',
                dataType:'jsonp',
                jsonp:_VAR_JSONP_HANDLER_,
                jsonpCallback:_DEFAULT_JSONP_HANDLER_,
                success:callback
            });
        }
        ,openDialog : function(url,setting){
            //不传递ajax的兼容
            if(typeof(arguments[0]) === 'object') {
                var setting = url;
            }
            //设置初始值
            var dsetting = {
                title:'系统信息',
                okValue: '确定',
                ok: function () {},
                width:550,
                height:400,
                cancelValue: '取消',
                cancel: function () {}
            };
            setting = $.extend(true,dsetting,setting);
            //如果已经有content值则不进行ajax获取
            if(setting.content) {
                dialog(setting).show();
            } else {
                $.get(url,{},function(data){
                    if(!data) return false;
                    setting.content = data;
                    dialog(setting).show();
                });
            }
        }
        ,redirect:function(url){
            window.location.href = url;
        }






        //##下面为抛弃部分，
        /***前后台共用***/
        ,G:{
            //Ajax批量操作
            bulkAction:function(url) {
                var id = '';
                $('input[name="id_all[]"]:checked').each(function(){id += $(this).val()+',';});
                if(id) {
                    id = id.substr(0,id.length-1);
                    $.ajax({
                        url:url,
                        data:{id:id},
                        type:'POST',
                        dataType:'json',
                        boforeSend:function(){art.dialog.tips('数据正在提交...', 10);},
                        success:function(data){_tips(data,true);},
                        error:function(){art.dialog.tips('发送数据至服务器失败！');}
                    });
                }else {
                    _alert('请选择需要操作的数据！');
                }
            },
            //Ajax批量操作+Token
            bulkTokenAction:function(url,tokenName,obj) {
                var idKey = '';
                $('input[name="id_all[]"]:checked').each(function(){
                    idKey += $(this).val()+','+$(this).attr(tokenName)+'|';
                });
                if(idKey) {
                    idKey = idKey.substr(0,idKey.length-1);
                    var data = {id_key:idKey};
                    if(obj) data = $.extend(obj,data)
                    $.ajax({
                        url:url,
                        data:data,
                        type:'POST',
                        dataType:'json',
                        boforeSend:function(){art.dialog.tips('数据正在提交...', 10);},
                        success:function(data){_tips(data,true);},
                        error:function(){art.dialog.tips('发送数据至服务器失败！');}
                    });
                }else {
                    _alert('请选择需要操作的数据！');
                }
            },
            //排序
            sort:function(url) {
                url = url ? url : $.G.U('sort');
                _sortVal = '';
                $('[name^="sort"]').each(function(){
                    var sortID = $(this).attr('name').replace(/sort\[(.+)\]/,'$1');
                    var sortVal = $(this).val();
                    _sortVal += sortID+'#'+sortVal+'|';
                })
                _sortVal = _sortVal.substr(0,_sortVal.length-1);
                $.ajax({
                    url:url,
                    data:{sort:_sortVal},
                    type:'POST',
                    dataType:'json',
                    boforeSend:function(){art.dialog.tips('数据正在提交...', 10);},
                    success:function(data){_tips(data,true);},
                    error:function(){art.dialog.tips('发送数据至服务器失败！');}
                });
            },
            //搜索
            searchs:function (params){
                params = params ? params :'?1=1&';
                var _formVal = $('[name="search_form"]').serialize();
                var _formAction = $('[name="search_form"]').attr('action');
                window.location.href = _formAction+params+_formVal;
            },
            //图片展示
            showIMG:function (src) {
                if(!src) return false;
                var _indexLen = src.indexOf('|');
                if(src.indexOf('|') > 0) {var src = src.substr(0,_indexLen);}
                art.dialog({
                    title: '图片展示',
                    fixed: true,
                    id:"image_priview",
                    lock: true,
                    background:"#CCCCCC",
                    opacity:0,
                    content: '<img src="' + _ROOT_ +'/' + src + '" />',
                    time: 10
                });
            }
        },
        /**后台操作**/
        B:{
            getModelFields:function(id) {
                $('#fields').val('');
                $.get($.G.U('Back/Public/get_Model_Fields'),{id:id},function(data){
                    if(data.data) {
                        var fields = '';
                        $.each(data.data,function(k,v){
//							 fields+='<a href="###" onclick="$(\'#fields\').val($(\'#fields\').val()+\''+v+',\')">'+v+'</a>';
                            fields+='<a href="###" onclick="var _fieldsValue = $(\'#fields\').val();if(_fieldsValue.indexOf(\''+v+':0,\') <= -1){$(\'#fields\').val(_fieldsValue+\''+v+':0,\\n\')}">'+v+'</a>';
                        })
                        $('#select_fields').html(fields);
                    }
                });
            }
        }
        /**后台操作 End**/
    }
})(window,jQuery);

function uploaded(type,options)
{

    if(!type)
    {
        type = 'image_upload';
    }
    else if(typeof type === 'object')
    {
        options = type;
        type = 'image_upload';
    }

    $.ajax({
        url:APP_URL + '/upload/setting',
        data:{'type':type},
        type:'POST',
        success:function(response)
        {
            options = options || {};

            var dialogOptions = {
                id: 'file-upload-dialog',
                title:'文件上传',
                width:600,
                okValue:'确定'
            };

            dialogOptions = $.extend(dialogOptions,options);
            //'http://'+window.location.host+'/index.php/upload/upload'
            $.get(APP_URL + '/upload/upload',function(data){
                dialogOptions.content = data;
                dialog(dialogOptions).show();
            });
        },
        error:function()
        {
            alert('配置加载出错，无法上传!');
        }
    });


}

function uploaded_single(selecter,btn,type)
{

    if(!type)
    {
        type = 'image_upload';
    }

    $.ajax({
        url:APP_URL + '/upload/setting',
        data:{'type':type},
        type:'POST',
        success:function(response)
        {
            $.get(APP_URL + '/upload/upload-single',{'btn':btn},function(data){
                $(selecter).append(data);
            });
        },
        error:function()
        {
            alert('配置加载出错，无法上传!');
        }
    });
}

//var TAGS_SEARCH = (function($){
//	return {
//
//	};
//})(jQuery);

//b.a();