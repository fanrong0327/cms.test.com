<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 11:13:40
         compiled from "application/views/cms/login.html" */ ?>
<?php /*%%SmartyHeaderCode:138044894557abed6430c974-56885748%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d324778887c44248afa7ad7e0c0c5c3ef2b5fb6' => 
    array (
      0 => 'application/views/cms/login.html',
      1 => 1460445960,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138044894557abed6430c974-56885748',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'baseurl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57abed64345714_80583170',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57abed64345714_80583170')) {function content_57abed64345714_80583170($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['baseurl']->value, ENT_QUOTES, 'UTF-8');?>
">
        <title>草木乐动阅读运营平台</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <link rel="stylesheet" href="/css/style.css" />
        <link rel="stylesheet" href="/js/jwysiwyg/jquery.wysiwyg.old-school.css" />

        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/min.js"></script>
		<script>
            $(function(){
                $(".placeholder input").bind('click',function(){
                    $(this).siblings().css("display","none");
                });
                $(".placeholder input").keyup(function(event){
                    var key = event.keyCode;
                    if(key == 9){
                        $(this).siblings().css("display","none");
                    }
                });
            });
        </script>
    </head>
    <body>

        <div id="content" class="login">

            <h1><img src="/img/icons/lock-closed.png" alt="" />草木乐动阅读运营平台</h1>
            <form action="account/login" method="post">

                <div class="input placeholder">
                    <label for="login">用户名</label>
                    <input type="text" name='username' id="login"/>
                </div>
                <div class="input placeholder">
                    <label for="pass">密码</label>
                    <input type="password" name='password' id="pass" value=""/>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="remember"/>
                    <label class="inline" for="remember">记住我</label>
                </div>
                <div class="submit">
                    <input type="submit" value="登录"/>
                </div>
            </form>
            <div style="color: red; margin-top: 50px;font-size: 15px">注：请用公司邮箱前缀与公司邮箱密码登陆</div>

        </div>

    </body>
</html>

<?php }} ?>