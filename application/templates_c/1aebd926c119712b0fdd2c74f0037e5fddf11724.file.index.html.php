<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 23:23:52
         compiled from "application/views/cms/template/index.html" */ ?>
<?php /*%%SmartyHeaderCode:25668499257ac988802de13-85316285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1aebd926c119712b0fdd2c74f0037e5fddf11724' => 
    array (
      0 => 'application/views/cms/template/index.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25668499257ac988802de13-85316285',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac98880e2301_12904397',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac98880e2301_12904397')) {function content_57ac98880e2301_12904397($_smarty_tpl) {?><style type="text/css">
    td { line-height: 20px; }
</style>
<h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 <a href="template/add?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
" title="添加模板"><img src="img/icons/actions/edit.png" alt="" />添加模板</a></div>
    <div class="content">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th> ID </th>
                    <th> 模板名称 </th>
                    <th> 模板顺序 </th>
                    <th> 操作 </th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($_smarty_tpl->tpl_vars['data']->value['lists'])){?>
                <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value){
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
                <tr>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <a href="content?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a></td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['sortid'], ENT_QUOTES, 'UTF-8');?>
</td>
                    <td class="actions">
                    <a href="tpldesign?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="设计">设计</a>
                    <a href="field?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="域管理">域管理</a>
                    <a href="template/edit?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="编辑">编辑</a>
                    </td>
                </tr>
                <?php } ?>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<?php }} ?>