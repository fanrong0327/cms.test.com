<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 12:43:21
         compiled from "application/views/cms/action/index.html" */ ?>
<?php /*%%SmartyHeaderCode:17403439257ac0269091115-71760979%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f10c88a897f5270d6b1e017256a9cab77f609baa' => 
    array (
      0 => 'application/views/cms/action/index.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17403439257ac0269091115-71760979',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'item' => 0,
    'subact' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac0269103e43_31587076',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac0269103e43_31587076')) {function content_57ac0269103e43_31587076($_smarty_tpl) {?><style type="text/css">
    td { line-height: 20px; }
</style>
<h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 <a href="action/add" title="添加操作"><img src="img/icons/actions/edit.png" alt="" />添加操作</a></div>
    <div class="content">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th> ID </th>
                    <th> 操作名称 </th>
                    <th> 链接地址 </th>
                    <th> 验证字符 </th>
                    <th> 菜单中显示 </th>
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
                    <td> <img src="img/icons/menu/dark/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['icon'], ENT_QUOTES, 'UTF-8');?>
"><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['title'], ENT_QUOTES, 'UTF-8');?>
</strong> </td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['target'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['verify'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['display'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['orderby'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td class="actions"><a href="action/edit/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="编辑"><img src="img/icons/actions/edit.png" alt="" /></a>
                    <a href="action/delete/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="删除" onclick="return confirm('确认删除？');"><img src="img/icons/actions/delete.png" ></a></td>
                </tr>
                <?php if (is_array($_smarty_tpl->tpl_vars['item']->value['subact'])){?>
                <?php  $_smarty_tpl->tpl_vars["subact"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["subact"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['subact']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["subact"]->key => $_smarty_tpl->tpl_vars["subact"]->value){
$_smarty_tpl->tpl_vars["subact"]->_loop = true;
?>
                <tr>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subact']->value['id'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> __  <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subact']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subact']->value['target'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subact']->value['verify'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subact']->value['display'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subact']->value['orderby'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td class="actions"><a href="action/edit/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subact']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="编辑"><img src="img/icons/actions/edit.png" alt="" /></a>
                    <a href="action/delete/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subact']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="删除" onclick="return confirm('确认删除？');"><img src="img/icons/actions/delete.png" ></a></td>
                </tr>
                <?php } ?>
                <?php }?>
                <?php } ?>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<?php }} ?>