<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 11:22:17
         compiled from "application/views/cms/left.html" */ ?>
<?php /*%%SmartyHeaderCode:201833474657abef6905af80-33699259%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '34b86f52a2f4d1b6904737974b99dd73b5f09885' => 
    array (
      0 => 'application/views/cms/left.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201833474657abef6905af80-33699259',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'baseurl' => 0,
    'title' => 0,
    'all_act_arr' => 0,
    'act' => 0,
    'subact' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57abef690c7094_44114770',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57abef690c7094_44114770')) {function content_57abef690c7094_44114770($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['baseurl']->value, ENT_QUOTES, 'UTF-8');?>
">
        <title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>
</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <link rel="stylesheet" href="/css/jquery.treeview.css" />
        <link rel="stylesheet" href="/css/left.css" />

        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery.treeview.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#browser").treeview({
                    toggle: function() {
                        console.log("%s was toggled.", $(this).find(">span").text());
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="main">
            <ul id="browser" class="filetree treeview-famfamfam">
                <?php if (is_array($_smarty_tpl->tpl_vars['all_act_arr']->value)){?>
                <?php  $_smarty_tpl->tpl_vars["act"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["act"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['all_act_arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["act"]->key => $_smarty_tpl->tpl_vars["act"]->value){
$_smarty_tpl->tpl_vars["act"]->_loop = true;
?>
                <?php if ($_smarty_tpl->tpl_vars['act']->value['display']!='no'){?>
                <li class="closed"><span class="folder"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['act']->value['title'], ENT_QUOTES, 'UTF-8');?>
</span>
                    <?php if (is_array($_smarty_tpl->tpl_vars['act']->value['subact'])){?>
                    <ul>
                        <?php  $_smarty_tpl->tpl_vars["subact"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["subact"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['act']->value['subact']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["subact"]->key => $_smarty_tpl->tpl_vars["subact"]->value){
$_smarty_tpl->tpl_vars["subact"]->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['subact']->value['display']=='yes'){?>
                        <li><span class="file"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subact']->value['target'], ENT_QUOTES, 'UTF-8');?>
" target="mainframe"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subact']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </a></span></li>
                        <?php }?>
                        <?php } ?>
                    </ul>                    
                    <?php }?>
                </li>
                <?php }?>
                <?php } ?>
                <?php }?>
                <li class="closed"><span class="folder">系统管理</span>
                    <ul>
                        <li><span class="file"><a href="javascript:void(0);" onclick="window.top.location='/account/logout';" class=""> 退出登录 </a></span></li>
                    </ul>                    
                </li>
            </ul>
        </div>
     </body>
</html><?php }} ?>