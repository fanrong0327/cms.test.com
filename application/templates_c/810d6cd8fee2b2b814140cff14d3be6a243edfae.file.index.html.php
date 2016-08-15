<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 23:33:35
         compiled from "application/views/cms/field/index.html" */ ?>
<?php /*%%SmartyHeaderCode:153511323257ac9acf5fc6b5-27174392%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '810d6cd8fee2b2b814140cff14d3be6a243edfae' => 
    array (
      0 => 'application/views/cms/field/index.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153511323257ac9acf5fc6b5-27174392',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'item' => 0,
    'fieldtype' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac9acf6846b9_09215518',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac9acf6846b9_09215518')) {function content_57ac9acf6846b9_09215518($_smarty_tpl) {?><style type="text/css">
    td { line-height: 20px; }
</style>
<h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 <a href="field/add?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['tplid'], ENT_QUOTES, 'UTF-8');?>
" title="添加域"><img src="img/icons/actions/edit.png" alt="" />添加域</a></div>
    <div class="content">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th> ID </th>
                    <th> 域名称 </th>
                    <th> 域类型 </th>
                    <th> 域状态 </th>
                    <th> 列表显示 </th>
                    <th> 排序 </th>
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
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8');?>
</td>
                    <td> 
                        <?php  $_smarty_tpl->tpl_vars["fieldtype"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["fieldtype"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['fieldtype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["fieldtype"]->key => $_smarty_tpl->tpl_vars["fieldtype"]->value){
$_smarty_tpl->tpl_vars["fieldtype"]->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['item']->value['fieldtype']==$_smarty_tpl->tpl_vars['fieldtype']->value['id']){?>
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fieldtype']->value['name'], ENT_QUOTES, 'UTF-8');?>

                        <?php }?>
                        <?php } ?>
                    </td>
                    <td> <?php if ($_smarty_tpl->tpl_vars['item']->value['status']==2){?>启用<?php }else{ ?>未启用<?php }?></td>
                    <td> <?php if ($_smarty_tpl->tpl_vars['item']->value['isdisplay']==2){?>显示<?php }else{ ?>不显示<?php }?></td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['morder'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td class="actions">
                    <a href="field/edit?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['tplid'], ENT_QUOTES, 'UTF-8');?>
&id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="编辑"><img src="img/icons/actions/edit.png" alt="" /></a>
                    </td>
                </tr>
                <?php } ?>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<?php }} ?>