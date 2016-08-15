<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 23:32:00
         compiled from "application/views/cms/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:193755146157ac9a70bab320-22949441%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0db44a40474c7d4b0ac57bd3fbad3267d53fc431' => 
    array (
      0 => 'application/views/cms/header.tpl',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193755146157ac9a70bab320-22949441',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'Name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac9a70bb6f14_57625385',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac9a70bb6f14_57625385')) {function content_57ac9a70bb6f14_57625385($_smarty_tpl) {?><HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TITLE><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>
 - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['Name']->value, ENT_QUOTES, 'UTF-8');?>
</TITLE>
<script src="/js/jquery.min.js"></script>
<script src="/css/test.css"></script>
</HEAD>
<BODY bgcolor="#ffffff">
<a href='/cms/site'>站点管理</a>=<a href='/cms/template'>模板管理</a>=<a href='/cms/field'>模板域管理</a>=<a href='/cms/tpldesign'>模板设计</a><br/>
<?php }} ?>