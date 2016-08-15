<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 22:47:45
         compiled from "application/views/cms/site/add.html" */ ?>
<?php /*%%SmartyHeaderCode:184237010657ac9011d9b056-41278784%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '838273f6c44750d02a27177eeff6381bd8de63eb' => 
    array (
      0 => 'application/views/cms/site/add.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '184237010657ac9011d9b056-41278784',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac9011e68597_08111026',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac9011e68597_08111026')) {function content_57ac9011e68597_08111026($_smarty_tpl) {?><h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 </div>
    <div class="content">
        <form action="" method="post">
            <div class="input">
                <label for="input1">站点名称</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['name'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="input">
                <label for="input1">发布地址</label>
                <input type="text" name="url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['url'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="input">
                <label for="input1">数据库主机</label>
                <input type="text" name="dbhost" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['dbhost'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="input">
                <label for="input1">数据库端口</label>
                <input type="text" name="dbport" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['dbport'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="input">
                <label for="input1">数据库用户</label>
                <input type="text" name="dbuser" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['dbuser'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="input">
                <label for="input1">数据库密码</label>
                <input type="text" name="dbpass" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['dbpass'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="input">
                <label for="input1">是否启用</label>
                <select name="isuse">
                <option value="1" <?php if ($_smarty_tpl->tpl_vars['data']->value['content']['isuse']==1){?>selected<?php }?>>是</option>
                <option value="0" <?php if ($_smarty_tpl->tpl_vars['data']->value['content']['isuse']==0){?>selected<?php }?>>否</option>
                </select>
            </div>
            <div class="input">
                <label for="input1">是否隐藏</label>
                <select name="ishide">
                <option value="1" <?php if ($_smarty_tpl->tpl_vars['data']->value['content']['ishide']==1){?>selected<?php }?>>是</option>
                <option value="0" <?php if ($_smarty_tpl->tpl_vars['data']->value['content']['ishide']==0){?>selected<?php }?>>否</option>
                </select>

            </div>
            <div class="submit clear">
                <?php if ($_smarty_tpl->tpl_vars['data']->value['content']['id']>0){?>
                <input type='hidden' name='id' value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['id'], ENT_QUOTES, 'UTF-8');?>
"/><br/>
                <?php }?>
                <input type="submit" name="submit" value="提交">
            </div>
        </form>
    </div>
</div>
<?php }} ?>