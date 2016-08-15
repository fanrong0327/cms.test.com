<?php /* Smarty version Smarty-3.1.13, created on 2016-08-14 22:40:46
         compiled from "application/views/comquery/home.html" */ ?>
<?php /*%%SmartyHeaderCode:70706381257b082eeed8b00-59370210%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6cc3b5025af6411fbd7d234fbd0037e24f9a821b' => 
    array (
      0 => 'application/views/comquery/home.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70706381257b082eeed8b00-59370210',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tpllist' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57b082eef2e431_61282922',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b082eef2e431_61282922')) {function content_57b082eef2e431_61282922($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="/css/style.css" />
    </head>
    <body>
        <link rel="stylesheet" href="/css/settings/style.css" />
        <!-- CONTENT --> 
        <div id="content" class="white">
            <style type="text/css">
                td { line-height: 20px; }
            </style>
            <h1> 模板管理 </h1>
            <div class="bloc">
                <div class="title"> 模板列表 <a href="/api/comquery/tpladd" title="添加模板"><img src="img/icons/actions/edit.png" alt="" />添加模板</a></div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> 模板名称 </th>
                                <th> 操作 </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $_smarty_tpl->tpl_vars["list"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["list"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tpllist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["list"]->key => $_smarty_tpl->tpl_vars["list"]->value){
$_smarty_tpl->tpl_vars["list"]->_loop = true;
?>
                            <tr>
                                <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['tid'], ENT_QUOTES, 'UTF-8');?>
 </td>
                                <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['tname'], ENT_QUOTES, 'UTF-8');?>
</td>
                                <td class="actions" style="width: 150px">
                                    <a href="/api/comquery/fieldslist?tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['tid'], ENT_QUOTES, 'UTF-8');?>
" title="设计">域设计</a>
                                    <a href="/api/comquery/tpledit?tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['tid'], ENT_QUOTES, 'UTF-8');?>
" title="模板编辑">模板编辑</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </body>
</html>
<?php }} ?>