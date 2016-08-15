<?php /* Smarty version Smarty-3.1.13, created on 2016-08-15 21:22:38
         compiled from "application/views/cms/content/index.html" */ ?>
<?php /*%%SmartyHeaderCode:141920737057b1c21e442735-52286318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36da89dffcbd24377330e433e2fb9b3459620ac0' => 
    array (
      0 => 'application/views/cms/content/index.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141920737057b1c21e442735-52286318',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'siteid' => 0,
    'tplid' => 0,
    'querytype' => 0,
    'keywords' => 0,
    'list' => 0,
    'fieldtype' => 0,
    'adddisplay' => 0,
    'item' => 0,
    'ditem' => 0,
    'page_html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57b1c21e568038_76732859',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b1c21e568038_76732859')) {function content_57b1c21e568038_76732859($_smarty_tpl) {?><style type="text/css">
    td { line-height: 20px; }
</style>
<h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php if (isset($_smarty_tpl->tpl_vars['data']->value['subtitle'])){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
<?php }?> <a href="content/add?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['siteid']->value, ENT_QUOTES, 'UTF-8');?>
&tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tplid']->value, ENT_QUOTES, 'UTF-8');?>
" title="添加内容"><img src="img/icons/actions/edit.png" alt="" />添加内容</a>
        &nbsp;&nbsp;&nbsp;
        <?php if (isset($_smarty_tpl->tpl_vars['querytype']->value)&&!empty($_smarty_tpl->tpl_vars['querytype']->value)){?>
        <input type="text" name="keywords" id="keywords" value="<?php if (isset($_smarty_tpl->tpl_vars['keywords']->value)){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['keywords']->value, ENT_QUOTES, 'UTF-8');?>
<?php }?>"/>
        <select name="fieldtype" id="fieldtype">
            <?php  $_smarty_tpl->tpl_vars["list"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["list"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['querytype']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["list"]->key => $_smarty_tpl->tpl_vars["list"]->value){
$_smarty_tpl->tpl_vars["list"]->_loop = true;
?>
            <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['list']->value['id']==$_smarty_tpl->tpl_vars['fieldtype']->value){?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
            <?php } ?>
        </select>
        <input type="button"  value="搜索" onclick="seach()"/>
        <?php }?>
    </div>
    <div class="content">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th> ID </th>
                    <th> URL </th>
                    <th> 创建时间 </th>
                    <th> 创建者 </th>
                    <th> 发布时间 </th>
                    <?php if (is_array($_smarty_tpl->tpl_vars['adddisplay']->value)){?>
                    <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['adddisplay']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value){
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
                    <th><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8');?>
</th>
                    <?php } ?>
                    <?php }?>
                    <th> 操作 </th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($_smarty_tpl->tpl_vars['data']->value['lists'])){?>
                <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value){
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
                <tr>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td> <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['publishurl'], ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['url'], ENT_QUOTES, 'UTF-8');?>
" target="_blank"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['url'], ENT_QUOTES, 'UTF-8');?>
</a></td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['createtime'], ENT_QUOTES, 'UTF-8');?>
</td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['creater'], ENT_QUOTES, 'UTF-8');?>
</td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['publishtime'], ENT_QUOTES, 'UTF-8');?>
</td>
                    <?php if (is_array($_smarty_tpl->tpl_vars['adddisplay']->value)){?>
                    <?php  $_smarty_tpl->tpl_vars["ditem"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["ditem"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['adddisplay']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["ditem"]->key => $_smarty_tpl->tpl_vars["ditem"]->value){
$_smarty_tpl->tpl_vars["ditem"]->_loop = true;
?>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['ditem']->value['value']], ENT_QUOTES, 'UTF-8');?>
</td>
                    <?php } ?>
                    <?php }?>

                    <td class="actions">
                        <?php if ($_smarty_tpl->tpl_vars['siteid']->value==5&&$_smarty_tpl->tpl_vars['tplid']->value==1050){?>
                        <a href="content/delete?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['templateid'], ENT_QUOTES, 'UTF-8');?>
&id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="编辑" onclick="return confirm('确认删除？');">删除</a>
                        <?php }elseif($_smarty_tpl->tpl_vars['siteid']->value==11&&($_smarty_tpl->tpl_vars['tplid']->value==1016||$_smarty_tpl->tpl_vars['tplid']->value==1014)){?>
                        <a href="content/delete?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['templateid'], ENT_QUOTES, 'UTF-8');?>
&id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="编辑" onclick="return confirm('确认删除？');">删除</a>
                        <?php }?>
                        <a href="content/edit?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['templateid'], ENT_QUOTES, 'UTF-8');?>
&id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="编辑">编辑</a>
                        <a href="content/preview?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['templateid'], ENT_QUOTES, 'UTF-8');?>
&id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="预览" target="_blank">预览</a>
                        <a href="content/publish?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&tplid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['templateid'], ENT_QUOTES, 'UTF-8');?>
&id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" title="发布" onclick="return confirm('确认发布？');">发布</a></td>
                </tr>
                <?php } ?>
                <?php }?>
            </tbody>
        </table><br/>
        <?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>

    </div>
</div>

<script>
            function seach() {
            var siteid = <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['siteid']->value, ENT_QUOTES, 'UTF-8');?>
;
                    var tplid = <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tplid']->value, ENT_QUOTES, 'UTF-8');?>
;
                    var fieldtype = $("#fieldtype").val();
                    var keywords = $("#keywords").val();
                    hpage = 1;
                    window.location.href = "/content?page=" + hpage + "&siteid=" + siteid + "&tplid=" + tplid + "&fieldtype=" + fieldtype + "&keywords=" + keywords;
            }
</script>
<?php }} ?>