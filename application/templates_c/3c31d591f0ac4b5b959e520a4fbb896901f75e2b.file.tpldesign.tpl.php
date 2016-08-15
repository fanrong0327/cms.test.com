<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 23:32:00
         compiled from "application/views/cms/tpldesign.tpl" */ ?>
<?php /*%%SmartyHeaderCode:40076289857ac9a70ae0712-84663500%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c31d591f0ac4b5b959e520a4fbb896901f75e2b' => 
    array (
      0 => 'application/views/cms/tpldesign.tpl',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40076289857ac9a70ae0712-84663500',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'siteinfo' => 0,
    'tplinfo' => 0,
    'fieldlist' => 0,
    'globallist' => 0,
    'adlist' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac9a70b97ad7_69704107',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac9a70b97ad7_69704107')) {function content_57ac9a70b97ad7_69704107($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("cms/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'test'), 0);?>

<script type="text/javascript">
//进入目录 

    function addToArea(item) {
        var currentDir = $('#'+item).val();
        if (currentDir == '') {
            alert('请选择项目!');
            return;
        }
        $(rules).insertContent(currentDir);
    }

    $(function() {
        /*  在textarea处插入文本--Start */
        (function($) {
            $.fn
                    .extend({
                insertContent: function(myValue, t) {
                    var $t = $(this)[0];
                    if (document.selection) { // ie  
                        this.focus();
                        var sel = document.selection.createRange();
                        sel.text = myValue;
                        this.focus();
                        sel.moveStart('character', -l);
                        var wee = sel.text.length;
                        if (arguments.length == 2) {
                            var l = $t.value.length;
                            sel.moveEnd("character", wee + t);
                            t <= 0 ? sel.moveStart("character", wee - 2 * t
                                    - myValue.length) : sel.moveStart(
                                    "character", wee - t - myValue.length);
                            sel.select();
                        }
                    } else if ($t.selectionStart
                            || $t.selectionStart == '0') {
                        var startPos = $t.selectionStart;
                        var endPos = $t.selectionEnd;
                        var scrollTop = $t.scrollTop;
                        $t.value = $t.value.substring(0, startPos)
                                + myValue
                                + $t.value.substring(endPos,
                                $t.value.length);
                        this.focus();
                        $t.selectionStart = startPos + myValue.length;
                        $t.selectionEnd = startPos + myValue.length;
                        $t.scrollTop = scrollTop;
                        if (arguments.length == 2) {
                            $t.setSelectionRange(startPos - t,
                                    $t.selectionEnd + t);
                            //this.focus();  
                        }
                    } else {
                        this.value += myValue;
                        //this.focus();  
                    }
                }
            })
        })(jQuery);
        /* 在textarea处插入文本--Ending */
    });
</script>
模板设计<br/>
站点名称【<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['siteinfo']->value['name'], ENT_QUOTES, 'UTF-8');?>
】--模板名称【<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tplinfo']->value['name'], ENT_QUOTES, 'UTF-8');?>
】<br/>
<div>
    模板域列表：
    <select id="selectDir1" size="10" ondblclick="addToArea('selectDir1')">
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['name'] = 'sec1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['fieldlist']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total']);
?>
        <?php if ($_smarty_tpl->tpl_vars['fieldlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id']==10000){?>
        <option value=""><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fieldlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</option>
        <?php }else{ ?>
        <option value="${<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fieldlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
}">${<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fieldlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
}</option>
        <?php }?>
        <?php endfor; endif; ?>
    </select>
    全局变量：
    <select id="selectDir2" size="10" ondblclick="addToArea('selectDir2')">
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['name'] = 'sec1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['globallist']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total']);
?>
        <option value="${<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['globallist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
}">${<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['globallist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
}</option>
        <?php endfor; endif; ?>
    </select>
    广告插件：
    <select id="selectDir3" size="10" ondblclick="addToArea('selectDir3')">
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['name'] = 'sec1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['adlist']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total']);
?>
        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['adlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['adlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</option>
        <?php endfor; endif; ?>
    </select></div>
<form action='/tpldesign/index' method="post">
    页面模板：<textarea id="rules" name="content" cols="70" rows="8"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tplinfo']->value['content'], ENT_QUOTES, 'UTF-8');?>
</textarea><br/>
     默认URL：<input type='text' name='url' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tplinfo']->value['url'], ENT_QUOTES, 'UTF-8');?>
'/><br/>
    发布条件：<textarea id="condition" name="condition" cols="70" rows="8"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tplinfo']->value['condition'], ENT_QUOTES, 'UTF-8');?>
</textarea><br/>
    内容格式：<select name="format">
        <option value="1" <?php if ($_smarty_tpl->tpl_vars['tplinfo']->value['format']==1){?>selected<?php }?>>Text文本</option>
        <option value="2" <?php if ($_smarty_tpl->tpl_vars['tplinfo']->value['format']==2){?>selected<?php }?>>HTML</option>
        <option value="3" <?php if ($_smarty_tpl->tpl_vars['tplinfo']->value['format']==3){?>selected<?php }?>>SHTML</option>
        <option value="4" <?php if ($_smarty_tpl->tpl_vars['tplinfo']->value['format']==4){?>selected<?php }?>>WML</option>
        <option value="5" <?php if ($_smarty_tpl->tpl_vars['tplinfo']->value['format']==5){?>selected<?php }?>>XML</option>
        <option value="6" <?php if ($_smarty_tpl->tpl_vars['tplinfo']->value['format']==6){?>selected<?php }?>>json</option>
    </select><br/>
    <input type='hidden' name='id' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tplinfo']->value['id'], ENT_QUOTES, 'UTF-8');?>
'/><br/>
    <input type='hidden' name='siteid' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['siteinfo']->value['id'], ENT_QUOTES, 'UTF-8');?>
'/><br/>
    <input type='submit' name='submit' value='保存'/><br/>
</form>
<?php echo $_smarty_tpl->getSubTemplate ("cms/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>