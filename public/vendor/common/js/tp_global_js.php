<?php if (!defined('CR')) exit();?>
<script>
//URL_MODE  APP兼容性检查
var _APP_ = '__APP__' ? '__APP__' : '<?php echo $_SERVER['SCRIPT_NAME'];?>';
var WEB_URL = '<?php echo WEB_URL;?>',
_PUBLIC_ = '__PUBLIC__',_ROOT_ = '__ROOT__',
_VAR_MODULE_='<?php echo C('VAR_MODULE') ;?>',
_VAR_CONTROLLER_='<?php echo C('VAR_CONTROLLER') ;?>',
_VAR_ACTION_='<?php echo C('VAR_ACTION') ;?>',
_MODULE_NAME_='<?php echo MODULE_NAME;?>',
_CONTROLLER_NAME_='<?php echo CONTROLLER_NAME;?>',
_ACTION_NAME_='<?php echo ACTION_NAME;?>',
_MODULE_ = _APP_+'?'+_VAR_MODULE_+'='+_MODULE_NAME_,
_CONTROLLER_ = _URL_ = _MODULE_+'&'+_VAR_CONTROLLER_+'='+_CONTROLLER_NAME_,////_MODULE_ =
_ACTION_ = _URL_+'&'+_VAR_ACTION_+'='+_ACTION_NAME_,_VAR_AJAX_SUBMIT_='<?php echo C('VAR_AJAX_SUBMIT'); ?>',_VAR_JSONP_HANDLER_='<?php echo C('VAR_JSONP_HANDLER');?>',_DEFAULT_JSONP_HANDLER_='<?php echo C('DEFAULT_JSONP_HANDLER');?>';//document.domain='<?php echo substr(C('WEB_URL'), 7);?>';
//document.domain='crc.cs';

</script>

<link rel="stylesheet" href="__PUBLIC__/static/common/css/global.css" style="stylesheet" type="text/css" />
