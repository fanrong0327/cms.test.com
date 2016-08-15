<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 11:22:16
         compiled from "application/views/cms/index.html" */ ?>
<?php /*%%SmartyHeaderCode:83055106357abef68cf3cd6-50582837%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b28079178035a2205aec5bc5a1c4debef1b503a3' => 
    array (
      0 => 'application/views/cms/index.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83055106357abef68cf3cd6-50582837',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57abef68d36582_55979625',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57abef68d36582_55979625')) {function content_57abef68d36582_55979625($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>
</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
        <!--frameset frameborder="0"  rows="40,*">
            <frame name="topframe" src="http://cms.l/index/top"  /-->
            <frameset frameborder="0" cols="150,*">
                <frame name="leftframe" src="/index/left" />
                <frame name="mainframe" src="/index/right" />
            </frameset>
        <!--/frameset-->
</html>
<?php }} ?>