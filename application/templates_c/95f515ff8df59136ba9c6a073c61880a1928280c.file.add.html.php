<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 23:23:54
         compiled from "application/views/cms/template/add.html" */ ?>
<?php /*%%SmartyHeaderCode:212077431857ac988a587ee2-85567311%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95f515ff8df59136ba9c6a073c61880a1928280c' => 
    array (
      0 => 'application/views/cms/template/add.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212077431857ac988a587ee2-85567311',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac988a5c38e3_61746945',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac988a5c38e3_61746945')) {function content_57ac988a5c38e3_61746945($_smarty_tpl) {?><h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 </div>
    <div class="content">
        <form action="" method="post">
            <div class="input">
                <label for="input1">模板名称</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['name'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="input">
                <label for="input1">显示顺序</label>
                <input type="text" name="sortid" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['sortid'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <div class="submit clear">
                <?php if ($_smarty_tpl->tpl_vars['data']->value['content']['id']>0){?>
                <input type='hidden' name='id' value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['id'], ENT_QUOTES, 'UTF-8');?>
"/><br/>
                <?php }?>
                <input type='hidden' name='siteid' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
'/><br/>
                <input type="submit" name="submit" value="提交">
            </div>
        </form>
    </div>
</div>
<?php }} ?>