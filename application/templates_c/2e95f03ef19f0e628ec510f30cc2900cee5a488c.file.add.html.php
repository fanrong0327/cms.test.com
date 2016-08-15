<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 12:43:22
         compiled from "application/views/cms/action/add.html" */ ?>
<?php /*%%SmartyHeaderCode:48101567157ac026a16d6f6-99921702%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e95f03ef19f0e628ec510f30cc2900cee5a488c' => 
    array (
      0 => 'application/views/cms/action/add.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '48101567157ac026a16d6f6-99921702',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'icon_arr' => 0,
    'icon' => 0,
    'key' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac026a1ecca3_40778635',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac026a1ecca3_40778635')) {function content_57ac026a1ecca3_40778635($_smarty_tpl) {?><h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 </div>
    <div class="content">
        <form action="" method="post">
            <div class="input">
                <label for="input1">操作名称</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['act']['title'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>

            <div class="input">
                <label for="input1">icon图标</label>
                <?php  $_smarty_tpl->tpl_vars["icon"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["icon"]->_loop = false;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['icon_arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["icon"]->key => $_smarty_tpl->tpl_vars["icon"]->value){
$_smarty_tpl->tpl_vars["icon"]->_loop = true;
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["icon"]->key;
?>
                <input name="icon" type="radio" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['icon']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value['act']['icon']==$_smarty_tpl->tpl_vars['icon']->value){?>checked<?php }?>> 
                <img src="img/icons/menu/dark/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['icon']->value, ENT_QUOTES, 'UTF-8');?>
" style="margin-right:20px;">
                <?php if (($_smarty_tpl->tpl_vars['key']->value+1)%5==0){?><br/><?php }?>
                <?php } ?>
            </div>

            <div class="input">
                <label for="input1">链接地址</label>
                <input type="text" name="target" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['act']['target'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>

            <div class="input">
                <label for="input1">验证字符</label>
                <input type="text" name="verify" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['act']['verify'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>

            <div class="input">
                <label for="input1">父级操作</label>
                <select name="pid">
                    <option value="0"> 顶级操作 </option>
                    <?php  $_smarty_tpl->tpl_vars["val"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["val"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['top_act']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["val"]->key => $_smarty_tpl->tpl_vars["val"]->value){
$_smarty_tpl->tpl_vars["val"]->_loop = true;
?>
                    <?php if ($_smarty_tpl->tpl_vars['val']->value['id']!=$_smarty_tpl->tpl_vars['data']->value['act']['id']){?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['val']->value['id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['val']->value['id']==$_smarty_tpl->tpl_vars['data']->value['act']['pid']){?> selected <?php }?>> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['val']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </option>
                    <?php }?>
                    <?php } ?>

                </select>
            </div>

            <div class="input">
                <label for="input1">是否显示</label>
                <input type="radio" name="display" value="yes" <?php if ($_smarty_tpl->tpl_vars['data']->value['act']['display']=='yes'){?> checked <?php }?>> YES &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="display" value="no" <?php if ($_smarty_tpl->tpl_vars['data']->value['act']['display']=='no'){?> checked <?php }?>> NO
            </div>

            <div class="input">
                <label for="input1">排序</label>
                <input type="text" name="orderby" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['act']['orderby'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>

            <div class="submit clear">
                <input type="submit" name="submit" value="提交">
            </div>
        </form>
    </div>
</div>
<?php }} ?>