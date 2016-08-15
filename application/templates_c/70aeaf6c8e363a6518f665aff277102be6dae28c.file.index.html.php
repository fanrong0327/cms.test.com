<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 12:42:44
         compiled from "application/views/cms/site/index.html" */ ?>
<?php /*%%SmartyHeaderCode:133851110257ac0244be15a5-46954534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70aeaf6c8e363a6518f665aff277102be6dae28c' => 
    array (
      0 => 'application/views/cms/site/index.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '133851110257ac0244be15a5-46954534',
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
  'unifunc' => 'content_57ac0244c6b414_15239680',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac0244c6b414_15239680')) {function content_57ac0244c6b414_15239680($_smarty_tpl) {?><style type="text/css">
    td { line-height: 20px; }
</style>
<h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 <a href="site/add" title="添加站点"><img src="img/icons/actions/edit.png" alt="" />添加站点</a></div>
    <div class="content">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th> ID </th>
                    <th> 站点名称 </th>
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
                    <td> <a href="template?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a></td>
                    <td class="actions"><a href="site/edit?id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="编辑"><img src="img/icons/actions/edit.png" alt="" /></a></td>
                </tr>
                <?php } ?>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<?php }} ?>