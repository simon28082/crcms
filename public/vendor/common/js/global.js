/**
 * 全局JS
 */
(function(window,$){
	$.G = {
		/**打印对象字符串**/
		ObjectToString:function(dataObjs){
			var dataObjsString = '{';
			$.each(dataObjs,function(k,v){
				if(typeof(v) === 'object') {
					dataObjsString += k+":"+$.G.ObjectToString(v)+",";
				} else {
					dataObjsString += k+":'"+v+"',";
				}
			});
			dataObjsString = dataObjsString.substring(0,dataObjsString.length - 1);
			dataObjsString += '}';
			return dataObjsString;
		},
		/**解析返回URL参数后缀**/
		RUrlSuffix:function(url,params){
			var delimter = url.indexOf('?')==-1 ? '?' : '&';
			url = url+delimter; 
			if(params && typeof(params)==='object') {
				$.each(params,function(k,v){
					url += '&'+k+'='+v;
				});
			}
			return url;
		},
		/**URL路径返回**/
		U:function(){
			var paramsLength = arguments.length,url='';
			if(paramsLength == 0) {
				url = _ACTION_;
			} else if(paramsLength == 1 && typeof(arguments[0])=='object') {
				url = _ACTION_;
				$.each(arguments[0],function(k,v){
					url += '&'+k+'='+v;
				});
			} else {
				arguments[0] = $.trim(arguments[0]);
				if(arguments[0].indexOf('@') >= 0) {
					var urlArray = arguments[0].split('@');
					//get domain
					var domain = (arguments[2] ? arguments[2]+'://' : 'http://')+urlArray[0];
					urlArray = urlArray[1].split('/');
					if(urlArray.length == 1) {
						url = domain+'?'+_VAR_CONTROLLER_+'='+_CONTROLLER_NAME_+'&'+_VAR_ACTION_+'='+urlArray[0];
					} else if(urlArray.length == 2) {
						url = domain+'?'+_VAR_CONTROLLER_+'='+urlArray[0]+'&'+_VAR_ACTION_+'='+urlArray[1];
					}
				} else {
					var urlArray = arguments[0].split('/');
					if(urlArray.length == 1) {
						url = _CONTROLLER_+'&'+_VAR_ACTION_+'='+urlArray[0];
					} else if(urlArray.length == 2) {
						url = _MODULE_+'&'+_VAR_CONTROLLER_+'='+urlArray[0]+'&'+_VAR_ACTION_+'='+urlArray[1];
					} else if(urlArray.length == 3) {
						url = _APP_+'?'+_VAR_MODULE_+'='+urlArray[0]+'&'+_VAR_CONTROLLER_+'='+urlArray[1]+'&'+_VAR_ACTION_+'='+urlArray[2];
					} else {
						alert('传入URL路径出错！');
						return false;
					}
				}
				//附加参数
				if(arguments[1]) {
					$.each(arguments[1],function(k,v){
						url += '&'+k+'='+v;
					});
				}
			}
			return url;
		},
		//获取url中"?"符后的字串 并返回一个新数组
		URLParams:function() {    
		    var url = location.search; //获取url中"?"符后的字串    
		    var theRequest = new Object();    
		    if (url.indexOf("?") != -1) {       
		        var str = url.substr(1);       
		        strs = str.split("&");       
		        for(var i = 0; i < strs.length; i ++) {          
		            theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
		        }
		    }
		    return theRequest;
		},
		//时间和时间戳的转换格式如：2014-05-06 2014-05-06 12:22或2014-05-06 13:01:06
		DateToUnix:function(datetime) {
			var dateTimeArray = datetime.split(' ');
			var dateArray = dateTimeArray[0].split('-');
			var year = dateArray[0];
			var month = dateArray[1];
			var day = dateArray[2];
			if(dateTimeArray[1]) {
				var timeArray = dateTimeArray[1].split(':');
				var hour = timeArray[0];
				var minute = timeArray[1] ? timeArray[1] : 0;
				var second = timeArray[2] ? timeArray[2] : 0;
			} else {
				var hour = 0;
				var minute = 0;
				var second = 0;
			}
			var oDate = new Date(Date.UTC(parseInt(year), parseInt(month), parseInt(day), parseInt(hour), parseInt(minute), parseInt(second)));
			return (oDate.getTime()/1000);
		},
		//搜索
		Search:function (object,params){
			var $form = $(object).closest('form');
			/* 表单URL设置 */
			var url = $form.attr('action');
			/* 附加参数设置 */
			if(!params) {
				params = '1=1';
			}
			url = $.G.RUrlSuffix(url,params);
			window.location.href = url+'&'+$form.serialize();
		}
	};
})(window,jQuery);
/****jQuery自身扩展*****/
//在光标后插入
$.fn.insert = function(value){
	//默认参数
	value=$.extend({"text":""},value);
	var dthis = $(this)[0]; //将jQuery对象转换为DOM元素
	//IE下
	if(document.selection){
		$(dthis).focus();		//输入元素textara获取焦点
		var fus = document.selection.createRange();//获取光标位置
		fus.text = value.text;	//在光标位置插入值
		$(dthis).focus();	///输入元素textara获取焦点
	}
	//火狐下标准	
	else if(dthis.selectionStart || dthis.selectionStart == '0'){
		var start = dthis.selectionStart; 
		var end = dthis.selectionEnd;
		var top = dthis.scrollTop;
		//以下这句，应该是在焦点之前，和焦点之后的位置，中间插入我们传入的值
		dthis.value = dthis.value.substring(0, start) + value.text + dthis.value.substring(end, dthis.value.length);
	}
	//在输入元素textara没有定位光标的情况
	else{
		this.value += value.text;
		this.focus();	
	};
	return $(this);
}
//返回顶部
$.fn.goTop = function(options) {
	var thisObj = this;
	var defaults = {			
		showHeight : 150,
		speed : 100
		//selecter:'#gotoTop'
	};
	var options = $.extend(defaults,options);
	$(window).scroll(function(){$(this).scrollTop()>options.showHeight ? $(thisObj).show() : $(thisObj).hide();});	
	$(thisObj).click(function(){$("html,body").animate({scrollTop: 0}, options.speed);	});
}
//位置滑动固定
$.fn.fixed = function(className,topNum){
	className = className ? className : 'tempClass';
	var obj = this;
	var _marginTop = topNum ? topNum : $(this).offset().top;
	var _marginLeft = $(this).offset().left;
	$(window).scroll(function(){$(this).scrollTop() > _marginTop ? $(obj).addClass(className).css('left',_marginLeft) : $(obj).removeClass(className);});
}
//对像元素倒叙
$.fn.reverseChild = function(child) {
	var mainObj = this;
	var childObj = $(mainObj).find(child);
	 var total = childObj.length;
	 childObj.each(function(i) {
		 $(mainObj).append(childObj.eq((total-1)-i));
	 });    
}	    
//行滚动
$.fn.lineScroll = function(opt,callback){
	//参数初始化
    if(!opt) var opt={};
    var _btnUp = $("#"+ opt.up);//Shawphy:向上按钮
    var _btnDown = $("#"+ opt.down);//Shawphy:向下按钮
    var timerID;
    var _this=this.eq(0).find("ul:first");
    var     lineH=_this.find("li:first").height(), //获取行高
            line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10), //每次滚动的行数，默认为一屏，即父容器高度
            speed=opt.speed?parseInt(opt.speed,10):500; //卷动速度，数值越大，速度越慢（毫秒）
            timer=opt.timer //?parseInt(opt.timer,10):3000; //滚动的时间间隔（毫秒）
    if(line==0) line=1;
    var upHeight=0-line*lineH;
    //滚动函数
    var scrollUp=function(){
            _btnUp.unbind("click",scrollUp); //Shawphy:取消向上按钮的函数绑定
            _this.animate({
                    marginTop:upHeight
            },speed,function(){
                    for(i=1;i<=line;i++){
                            _this.find("li:first").appendTo(_this);
                    }
                    _this.css({marginTop:0});
                    _btnUp.bind("click",scrollUp); //Shawphy:绑定向上按钮的点击事件
            });

    }
    //Shawphy:向下翻页函数
    var scrollDown=function(){
            _btnDown.unbind("click",scrollDown);
            for(i=1;i<=line;i++){
                    _this.find("li:last").show().prependTo(_this);
            }
            _this.css({marginTop:upHeight});
            _this.animate({
                    marginTop:0
            },speed,function(){
                    _btnDown.bind("click",scrollDown);
            });
    }
   //Shawphy:自动播放
    var autoPlay = function(){
            if(timer)timerID = window.setInterval(scrollUp,timer);
    };
    var autoStop = function(){
            if(timer)window.clearInterval(timerID);
    };
     //鼠标事件绑定
    _this.hover(autoStop,autoPlay).mouseout();
    _btnUp.css("cursor","pointer").click( scrollUp ).hover(autoStop,autoPlay);//Shawphy:向上向下鼠标事件绑定
    _btnDown.css("cursor","pointer").click( scrollDown ).hover(autoStop,autoPlay);
}
//获取自身html
jQuery.fn.outerHTML = function (s) {
    return (s) ? this.before(s).remove() : jQuery("<p>").append(this.eq(0).clone()).html();
} 
//加入收藏
function AddFavorite(sURL, sTitle){try{window.external.addFavorite(sURL, sTitle);}catch (e){try{window.sidebar.addPanel(sTitle, sURL, "");}catch (e){alert("加入收藏失败，请使用Ctrl+D进行添加");}}}
//设为首页
function SetHome(obj,vrl){try{obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);NavClickStat(1);}catch(e){if(window.netscape) {try {netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect"); }  catch (e) { alert("抱歉！您的浏览器不支持直接设为首页。请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为“true”，点击“加入收藏”后忽略安全提示，即可设置成功。");  }var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);prefs.setCharPref('browser.startup.homepage',vrl);}}}

