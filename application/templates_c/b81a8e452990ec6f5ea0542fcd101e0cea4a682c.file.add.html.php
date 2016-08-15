<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 12:43:28
         compiled from "application/views/cms/role/add.html" */ ?>
<?php /*%%SmartyHeaderCode:59611233857ac027042b3d1-57019698%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b81a8e452990ec6f5ea0542fcd101e0cea4a682c' => 
    array (
      0 => 'application/views/cms/role/add.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59611233857ac027042b3d1-57019698',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'value' => 0,
    'v1' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac02704a5ae0_75191988',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac02704a5ae0_75191988')) {function content_57ac02704a5ae0_75191988($_smarty_tpl) {?><h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 </div>
    <div class="content">
        <form action="" method="post">
            <div class="input">
                <label for="input1">登录名称</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['role']['username'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="input">
                <label for="input1">登录密码</label>
                <input type="text" name="password" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['role']['password'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>            
            <div class="input">
                <label for="input1">真实名称</label>
                <input type="text" name="roleName" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['role']['name'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="input">
                <label for="input2">权限分配</label>
                <table>
                <?php if (is_array($_smarty_tpl->tpl_vars['data']->value['act'])){?>
                <?php  $_smarty_tpl->tpl_vars["val"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["val"]->_loop = false;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['act']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["val"]->key => $_smarty_tpl->tpl_vars["val"]->value){
$_smarty_tpl->tpl_vars["val"]->_loop = true;
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["val"]->key;
?>
                <tr><td> <strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['val']->value['title'], ENT_QUOTES, 'UTF-8');?>
</strong> </td><td>
                    <?php  $_smarty_tpl->tpl_vars["value"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["value"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['val']->value['subact']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["value"]->key => $_smarty_tpl->tpl_vars["value"]->value){
$_smarty_tpl->tpl_vars["value"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["value"]->key;
?>
                        <div class="left" style="padding:5px 0;width:25%">
                            <label for="iphonecheck" class="inline"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['value']->value['title'], ENT_QUOTES, 'UTF-8');?>
</label>
                            <input type="checkbox" name="roleAct[]" class="iphone"
                                   <?php  $_smarty_tpl->tpl_vars["v1"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v1"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['role']['act']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v1"]->key => $_smarty_tpl->tpl_vars["v1"]->value){
$_smarty_tpl->tpl_vars["v1"]->_loop = true;
?>
                                   <?php if ($_smarty_tpl->tpl_vars['value']->value['id']==$_smarty_tpl->tpl_vars['v1']->value){?> checked <?php }?>
                                   <?php } ?>
                                    value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['value']->value['id'], ENT_QUOTES, 'UTF-8');?>
">
                        </div>
                    <?php } ?>
                </td></tr>
                <?php } ?>
                <?php }?>
                </table>
            </div>

            <div class="submit clear">
                <br> <br>
                <input type="submit" name="submit" value="提交">
            </div>
        </form>
    </div>
</div>
<?php }} ?>