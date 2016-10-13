;(function(window,$){
	
	$.createForm = function(data,options){
		
		var $self = this,$html = '',$options = {};
		
		var default_options = {
			label:{
				input:['text','password','email','date','color','hidden'],
				checkbox:['checkbox'],
				select:['select'],
				textarea:['textarea'],
				editor:['editor'],
				radio:['radio']
			},
			tpl:'tpl1',
			//form:['method','action','class','id'],
			attr:['type','name','datatype','errormsg','class','multiple','id','style']
		};
		$options = $.extend(true,default_options,options);
		
		
		this.setAttr = function(option,attrObject) {
			attrObject = attrObject ? attrObject : $options.attr;
			var attrString = '';
			//添加erromsg选项
			if(option.datatype != '') {
				option['errormsg'] = option.label_name+'格式不正确！';
			}
			$.each(option,function(k,v){
				if($.inArray(k,attrObject) >= 0 &&v) {
					attrString += (k+'="'+v+'" ');
				}
			});
			return attrString;
		};
		
		this.setTextValueAttr = function() {
			
		}
		
		
		this.input = function(option) {
			//设置默认值
			typeof option.default_value !== 'undefined' ? option['value'] = option.default_value : null;
		//alert();
			//input先写入内嵌
			//return '<input type="'+option.label+'" name="'+option.name+'" datatype="'+option.validator_js+'" />';
			return '<input '+$self.setAttr(option)+' />';
		};
		
		this.radio = function(option) {
			var html = '',checked = null;
			$.each(option.option,function(k,v){
				checked = typeof option.default_value !== 'undefined' && k==option.default_value ? 'checked="checked"' : null;
				html += '<label class="radio-inline"><input '+$self.setAttr(option)+' value="'+k+'" '+checked+' />'+v+'</label>';
			});
			return html;
		};
		
		this.select = function(option) {
			var html = '<select '+$self.setAttr(option)+'>',checked=null;
			$.each(option.option,function(k,v){
				checked = typeof option.default_value !== 'undefined' && k==option.default_value ? 'selected="selected"' : null;
				html += '<option value="'+k+'">'+v+'</option>';
			});
			html += '</select>';
			return html;
		};
//		
		this.checkbox = function (option) {
			option['name'] = option['name']+'[]';//先这样，
			var html = '',checked=null;
			$.each(option.option,function(k,v){
				checked = typeof option.default_value !== 'undefined' && k==option.default_value ? 'checked="checked"' : null;
				html += '<label class="checkbox-inline"><input '+$self.setAttr(option)+' value="'+k+'" />'+v+'</label>';
			});
			return html;
		};
//		
		this.textarea = function () {
			
		};
		
		this.tpl = function(option,formElement) {
			var string = '';
			string += '<div class="form-group">';
			string += '<label class="control-label text-left Validform_label">';
			string += '<span class="set-red mr5">*</span>';
			string += option.label_name;
			option.label_explain = (typeof option.label_explain != 'undefind' && option.label_explain) ? '（'+option.label_explain+'）' : option.label_explain;
			string += 	'<span class="set-title ml5">'+option.label_explain+'</span>';
			string += '</label>';
			string += '<div class="row"><div class="col-sm-12">';
			string += formElement;
			string += '</div><div class="col-md-12 help-block Validform_checktip"></div></div></div>';
			return string;
		};
		
		this.form = function() {
			//设置为默认post提交
			if(typeof $options.form.method == 'undefined') {
				$options.form['method'] = 'post';
			}
			//var html =  '<form '+$self.setAttr($options.form,['method','action','class','id'])+'>';
			var html =  '';
			html += $html;
			html += '<input type="hidden" name="_token" value="'+CSRF_TOKEN+'" />';
			html += '<input type="hidden" name="model" value="admin/admin" />';
			//button
			html += '<div class="form-group"><div class="row"><div class="col-sm-5">';
			html += '<button class="btn btn-default mr20" type="submit">提交</button>';
			html += '<button class="btn btn-default" type="reset">重置</button>';
			html += '</div></div></div>';

			//html += '</form>';
			return html;
	}
		
		
		this.factory = function() {
			var func = null;
			$.each(data,function(key,values){
				$.each($options.label,function(k,v){
					if($.inArray(values.type,v) != -1) {
						func = k;
						return false;
					} else {
						func = null;
					}
				});
				if(func && typeof($self[func])!=='undefined') {
					values['name'] = key;
					$html += $self.tpl(values,$self[func](values));
				} 
			});
			return $html;
		};
		
		return this.factory();
//		return this.form();

		return this;
	};
		

})(window,jQuery);