<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 23:33:37
         compiled from "application/views/cms/field/add.html" */ ?>
<?php /*%%SmartyHeaderCode:103082402257ac9ad1645827-73178171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5880f19344d1b98360e3290a59ec0b7ec9f543fd' => 
    array (
      0 => 'application/views/cms/field/add.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103082402257ac9ad1645827-73178171',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'fieldtype' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac9ad16d38f7_47728897',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac9ad16d38f7_47728897')) {function content_57ac9ad16d38f7_47728897($_smarty_tpl) {?><h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 </div>
    <div class="content">
        <form action="" method="post">
            <div class="input">
                <label for="input1">模版域名称</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['name'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="input">
                <label for="input1">模版域类型</label>
                <select name="fieldtype">
                <?php  $_smarty_tpl->tpl_vars["fieldtype"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["fieldtype"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['fieldtype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["fieldtype"]->key => $_smarty_tpl->tpl_vars["fieldtype"]->value){
$_smarty_tpl->tpl_vars["fieldtype"]->_loop = true;
?>
                <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fieldtype']->value['id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['fieldtype']==$_smarty_tpl->tpl_vars['fieldtype']->value['id']){?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fieldtype']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                <?php } ?>
                </select><br/>
            </div>
            <div class="input">
                <label for="input1">模版域状态</label>
                <select name="status">
                <option value="1" <?php if ($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['status']==1){?>selected<?php }?>>未启用</option>
                <option value="2" <?php if ($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['status']==2){?>selected<?php }?>>启用</option>
                </select>
                <br/>
            </div>
            <div class="input">
                <label for="input1">模版域算法</label>
                <textarea name="rules" rows="8"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['rules'], ENT_QUOTES, 'UTF-8');?>
</textarea>
                <br/>
            </div>
            <div class="input">
                <label for="input1">录入提示</label>
                <input type="text" name="promote" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['promote'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="input">
                <label for="input1">是在列表页显示</label>
                <select name="isdisplay">
                <option value="1" <?php if ($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['isdisplay']==1){?>selected<?php }?>>不显示</option>
                <option value="2" <?php if ($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['isdisplay']==2){?>selected<?php }?>>显示</option>
                </select>
                <br/>
            </div>
             <div class="input">
                <label for="input1">排序</label>
                <input type="text" name="morder" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['morder'], ENT_QUOTES, 'UTF-8');?>
"> <br>
                <br/>
            </div>
            <div class="input">
                <label for="input1">备注</label>
                <textarea name="mem" rows="3"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['mem'], ENT_QUOTES, 'UTF-8');?>
</textarea>
                <br/>
            </div>
            <div class="submit clear">
                <?php if ($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['id']>0){?>
                <input type='hidden' name='id' value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldinfo']['id'], ENT_QUOTES, 'UTF-8');?>
"/><br/>
                <?php }?>
                <input type='hidden' name='siteid' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
'/><br/>
                <input type='hidden' name='tplid' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['tplid'], ENT_QUOTES, 'UTF-8');?>
'/><br/>
                <input type="submit" name="submit" value="提交">
            </div>
        </form>
    </div>
</div>
<?php }} ?>