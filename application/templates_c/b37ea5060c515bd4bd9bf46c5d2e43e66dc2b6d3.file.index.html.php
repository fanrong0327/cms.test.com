<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 12:42:48
         compiled from "application/views/cms/ctest/index.html" */ ?>
<?php /*%%SmartyHeaderCode:21164455957ac0248424b20-11205633%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b37ea5060c515bd4bd9bf46c5d2e43e66dc2b6d3' => 
    array (
      0 => 'application/views/cms/ctest/index.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21164455957ac0248424b20-11205633',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac024844bcd4_08643212',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac024844bcd4_08643212')) {function content_57ac024844bcd4_08643212($_smarty_tpl) {?><h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 </div>
    <div class="content">
        <form action="" method="post">
            <div class="input">
                <label for="input1">测试代码</label>
                <textarea name="content" rows="25"></textarea>
            </div>
            
            <div class="submit clear">

                <input type="submit" name="submit" value="提交">
            </div>
        </form>
    </div>
</div>
<?php }} ?>