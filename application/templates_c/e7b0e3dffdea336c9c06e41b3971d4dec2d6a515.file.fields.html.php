<?php /* Smarty version Smarty-3.1.13, created on 2016-08-15 00:00:27
         compiled from "application/views/comquery/fields.html" */ ?>
<?php /*%%SmartyHeaderCode:49584434557b0959b183f36-79540319%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7b0e3dffdea336c9c06e41b3971d4dec2d6a515' => 
    array (
      0 => 'application/views/comquery/fields.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49584434557b0959b183f36-79540319',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tplid' => 0,
    'data' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57b0959b2012c4_71970542',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b0959b2012c4_71970542')) {function content_57b0959b2012c4_71970542($_smarty_tpl) {?><!DOCTYPE html>
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
            <h1> 域管理 </h1>
            <div class="bloc">
                <div class="title"> 域列表 
                    <a href="/api/comquery/addfields?tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tplid']->value, ENT_QUOTES, 'UTF-8');?>
" title="添加域"><img src="img/icons/actions/edit.png" alt="" />添加域</a>&nbsp;|&nbsp;
                    <a href="/api/comquery/home" title="模板列表">返回模板</a>
                </div>
                <div class="content">
                    <table cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> 使用字段名称 </th>
                                <th> 封装字段名称 </th>
                                <th> 说明 </th>
                                <th> 注释 </th>
                                <th> 操作 </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $_smarty_tpl->tpl_vars["list"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["list"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["list"]->key => $_smarty_tpl->tpl_vars["list"]->value){
$_smarty_tpl->tpl_vars["list"]->_loop = true;
?>
                            <tr>
                                <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['fid'], ENT_QUOTES, 'UTF-8');?>
</td>
                                <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['realname'], ENT_QUOTES, 'UTF-8');?>
</td>
                                <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['name'], ENT_QUOTES, 'UTF-8');?>
</td>
                                <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['cname'], ENT_QUOTES, 'UTF-8');?>
</td>
                                <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['mem'], ENT_QUOTES, 'UTF-8');?>
</td>
                                <td class="actions" style="width: 150px">
                                    <a href="/api/comquery/editfields?tplid=<?php ob_start();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['tid'], ENT_QUOTES, 'UTF-8');?>
<?php $_tmp1=ob_get_clean();?><?php echo htmlspecialchars($_tmp1, ENT_QUOTES, 'UTF-8');?>
&fid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['fid'], ENT_QUOTES, 'UTF-8');?>
" title="域编辑">域编辑</a>
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