<?php /* Smarty version Smarty-3.1.13, created on 2016-08-14 23:53:57
         compiled from "application/views/comquery/addtpl.html" */ ?>
<?php /*%%SmartyHeaderCode:170032964457b09415459fc6-65172234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39c4eab13922892d2983ea6b5613f88217eb4b95' => 
    array (
      0 => 'application/views/comquery/addtpl.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170032964457b09415459fc6-65172234',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'dbs' => 0,
    'db_id' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57b09415554339_77690097',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b09415554339_77690097')) {function content_57b09415554339_77690097($_smarty_tpl) {?><!DOCTYPE html>
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
            <h1> 站点管理 </h1>
            <div class="bloc">
                <div class="title"> 修改模板 </div>
                <div class="content">
                    <form action="" method="post">
                        <div class="input">
                            <label for="input1">模板名称</label>
                            <input type="text" name="tname" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['tname'])){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['tname'], ENT_QUOTES, 'UTF-8');?>
<?php }?>"> <br>
                        </div>
                        <div class="input">
                            <label for="input1">表名</label>
                            <input type="text" name="table" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['table'])){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['table'], ENT_QUOTES, 'UTF-8');?>
<?php }?>"> <br>
                        </div>
                        <div class="input">
                            <label for="input1">数据来源(必选)</label>
                            <select name="from">
                                <?php  $_smarty_tpl->tpl_vars["list"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["list"]->_loop = false;
 $_smarty_tpl->tpl_vars["db_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['dbs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["list"]->key => $_smarty_tpl->tpl_vars["list"]->value){
$_smarty_tpl->tpl_vars["list"]->_loop = true;
 $_smarty_tpl->tpl_vars["db_id"]->value = $_smarty_tpl->tpl_vars["list"]->key;
?>
                                <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['db_id']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if (isset($_smarty_tpl->tpl_vars['data']->value['from'])){?><?php if ($_smarty_tpl->tpl_vars['db_id']->value==$_smarty_tpl->tpl_vars['data']->value['from']){?> selected <?php }?><?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input">
                            <label for="input1">缓存时间</label>
                            <input type="text" name="mctime" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['mctime'])){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['mctime'], ENT_QUOTES, 'UTF-8');?>
<?php }?>"> <br>
                        </div>

                        <div class="submit clear">
                            <input type="submit" name="submit" value="提交">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </body>
</html>

<?php }} ?>