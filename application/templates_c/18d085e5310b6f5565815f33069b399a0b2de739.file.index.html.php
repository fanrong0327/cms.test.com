<?php /* Smarty version Smarty-3.1.13, created on 2016-08-14 22:33:27
         compiled from "application/views/cms/role/index.html" */ ?>
<?php /*%%SmartyHeaderCode:184378664957ac026de4b292-65095277%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18d085e5310b6f5565815f33069b399a0b2de739' => 
    array (
      0 => 'application/views/cms/role/index.html',
      1 => 1471181935,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '184378664957ac026de4b292-65095277',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac026de992e8_92515496',
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac026de992e8_92515496')) {function content_57ac026de992e8_92515496($_smarty_tpl) {?><style type="text/css">
td { line-height: 20px; }
table{
	table-layput:fixed;
	word-wrap:break-wrod;
	word-break:break-all; 
}
</style>
<h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 <a href="role/add" title="添加角色"><img src="img/icons/actions/edit.png" alt="" />添加角色</a></div>
    <div class="content">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th > ID </th>
                    <th > 用户名 </th>
                    <th > 真实名称 </th>
                    <th > 操作 </th>
                </tr>
            </thead>
            <tbody>
		<?php if (is_array($_smarty_tpl->tpl_vars['data']->value['lists'])){?>
                <?php  $_smarty_tpl->tpl_vars["val"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["val"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["val"]->key => $_smarty_tpl->tpl_vars["val"]->value){
$_smarty_tpl->tpl_vars["val"]->_loop = true;
?>
		    <tr>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['val']->value['id'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['val']->value['username'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['val']->value['name'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td class="actions"><a href="role/edit/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['val']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="编辑"><img src="img/icons/actions/edit.png" /></a>
                        <a href="role/delete/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['val']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="删除" onclick="return confirm('确认删除？');"><img src="img/icons/actions/delete.png" ></a></td>
                    </tr>
		<?php } ?>
                <?php }?>
            </tbody>
        </table>
        <div class="left input">
            <!--select name="action" id="tableaction">
                <option value="">Action</option>
                <option value="delete">Delete</option>
            </select-->
        </div>
        <!--<div class="pagination">
            <a href="#" class="prev">«</a>
            <a href="#">1</a>
            <a href="#" class="current">2</a>
            ...
            <a href="#">21</a>
            <a href="#">22</a>
            <a href="#" class="next">»</a>
        </div>-->
    </div>
</div>

<?php }} ?>