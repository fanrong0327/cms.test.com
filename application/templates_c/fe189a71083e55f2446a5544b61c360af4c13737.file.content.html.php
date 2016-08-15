<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 11:22:17
         compiled from "application/views/cms/content.html" */ ?>
<?php /*%%SmartyHeaderCode:193620503457abef69bbad27-86324251%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fe189a71083e55f2446a5544b61c360af4c13737' => 
    array (
      0 => 'application/views/cms/content.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193620503457abef69bbad27-86324251',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'baseurl' => 0,
    'data' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57abef69be15e9_15899835',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57abef69be15e9_15899835')) {function content_57abef69be15e9_15899835($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['baseurl']->value, ENT_QUOTES, 'UTF-8');?>
">
        <title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <link rel="stylesheet" href="/css/style.css" />
        <link rel="stylesheet" href="/js/jwysiwyg/jquery.wysiwyg.old-school.css" />

        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <?php if (isset($_smarty_tpl->tpl_vars['data']->value['subtitle'])&&$_smarty_tpl->tpl_vars['data']->value['subtitle']!='内容列表'){?>
        <script type="text/javascript" src="/js/jquery-ui.min.js"></script> 
        <script type="text/javascript" src="/js/min.js"></script>
        <?php }?>
        <script type="text/javascript" src="/js/jquery.json.min.js"></script>
        <!-- 专题需要的 -->
        <link href="/js/artDialog/skins/idialog.css" rel="stylesheet" />

    </head>
    <body>

        <script type="text/javascript" src="/css/settings/main.js"></script>
        <link rel="stylesheet" href="/css/settings/style.css" />

        <!-- CONTENT --> 
        <div id="content" class="white">
            <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

        </div>
    </body>
</html>
<script type="text/javascript">
    $('li[class="current"]').parent().parent().addClass('current');

    for (i = 0; i < $('#sidebar ul').length; i++) {
        if (!$($('#sidebar ul')[i]).html()) {
            $($('#sidebar ul')[i]).remove();
        }
    }
</script>
<?php }} ?>