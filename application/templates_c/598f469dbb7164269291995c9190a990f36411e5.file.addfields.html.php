<?php /* Smarty version Smarty-3.1.13, created on 2016-08-15 00:00:30
         compiled from "application/views/comquery/addfields.html" */ ?>
<?php /*%%SmartyHeaderCode:129663077457b0959e5d2276-33268203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '598f469dbb7164269291995c9190a990f36411e5' => 
    array (
      0 => 'application/views/comquery/addfields.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129663077457b0959e5d2276-33268203',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'tplid' => 0,
    'fid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57b0959e635482_08231556',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b0959e635482_08231556')) {function content_57b0959e635482_08231556($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="/css/style.css" />
    </head>
    <body>
        <link rel="stylesheet" href="/css/settings/style.css" />
        <!-- CONTENT --> 
        <div id="content" class="white">
            <h1> 域管理 </h1>
            <div class="bloc">
                <div class="title"> 修改域 </div>
                <div class="content">
                    <form action="" method="post">
                        <div class="input">
                            <label for="input1">使用字段名称</label>
                            <input type="text" name="realname" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['realname'])){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['realname'], ENT_QUOTES, 'UTF-8');?>
<?php }?>"> <br>
                        </div>
                        <div class="input">
                            <label for="input1">封装字段名称</label>
                            <input type="text" name="name" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['name'])){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['name'], ENT_QUOTES, 'UTF-8');?>
<?php }?>"> <br>
                        </div>
                        <div class="input">
                            <label for="input1">说明</label>
                            <input type="text" name="cname" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['cname'])){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['cname'], ENT_QUOTES, 'UTF-8');?>
<?php }?>"> <br>
                        </div>
                        <div class="input">
                            <label for="input1">注释</label>
                            <input type="text" name="mem" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['mem'])){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['mem'], ENT_QUOTES, 'UTF-8');?>
<?php }?>"> <br>
                        </div>

                        <div class="submit clear">
                            <input type="hidden" name="tplid" value="<?php if (isset($_smarty_tpl->tpl_vars['tplid']->value)){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tplid']->value, ENT_QUOTES, 'UTF-8');?>
<?php }?>"/>
                            <input type="hidden" name="fid" value="<?php if (isset($_smarty_tpl->tpl_vars['fid']->value)){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fid']->value, ENT_QUOTES, 'UTF-8');?>
<?php }?>"/>
                            <input type="submit" name="submit" value="提交">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </body>
</html>

<?php }} ?>