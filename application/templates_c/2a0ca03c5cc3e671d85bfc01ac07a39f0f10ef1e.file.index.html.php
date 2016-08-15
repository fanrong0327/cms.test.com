<?php /* Smarty version Smarty-3.1.13, created on 2016-08-11 12:43:03
         compiled from "application/views/cms/resource/index.html" */ ?>
<?php /*%%SmartyHeaderCode:23123905257ac0257a1a195-43007123%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a0ca03c5cc3e671d85bfc01ac07a39f0f10ef1e' => 
    array (
      0 => 'application/views/cms/resource/index.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23123905257ac0257a1a195-43007123',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'noticemsg' => 0,
    'noticemsg1' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57ac0257adf806_85473160',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57ac0257adf806_85473160')) {function content_57ac0257adf806_85473160($_smarty_tpl) {?><style type="text/css">
    td { line-height: 20px; }
</style>
<h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
    <?php if ($_smarty_tpl->tpl_vars['noticemsg']->value==1){?>
    <div class="notif success bloc">
        <strong>成功 :</strong>上传解压zip文件成功 <?php if ($_smarty_tpl->tpl_vars['noticemsg1']->value!=''){?><br/><?php echo $_smarty_tpl->tpl_vars['noticemsg1']->value;?>
<?php }?>
        <a href="#" class="close">x</a>
    </div>
    <?php }elseif($_smarty_tpl->tpl_vars['noticemsg']->value==2){?>
    <div class="notif success bloc">
        <strong>失败 :</strong>文件或目录存在，不能解压  <?php if ($_smarty_tpl->tpl_vars['noticemsg1']->value!=''){?><br/><?php echo $_smarty_tpl->tpl_vars['noticemsg1']->value;?>
<?php }?>
        <a href="#" class="close">x</a>
    </div>
    <?php }elseif($_smarty_tpl->tpl_vars['noticemsg']->value==3){?>
    <div class="notif success bloc">
        <strong>成功 :</strong>文件上传成功  <?php if ($_smarty_tpl->tpl_vars['noticemsg1']->value!=''){?><br/><?php echo $_smarty_tpl->tpl_vars['noticemsg1']->value;?>
<?php }?>
        <a href="#" class="close">x</a>
    </div>
    <?php }elseif($_smarty_tpl->tpl_vars['noticemsg']->value==4){?>
    <div class="notif success bloc">
        <strong>成功 :</strong>目录创建成功  <?php if ($_smarty_tpl->tpl_vars['noticemsg1']->value!=''){?><br/><?php echo $_smarty_tpl->tpl_vars['noticemsg1']->value;?>
<?php }?>
        <a href="#" class="close">x</a>
    </div>
    <?php }elseif($_smarty_tpl->tpl_vars['noticemsg']->value==5){?>
    <div class="notif success bloc">
        <strong>失败 :</strong>目录创建失败  <?php if ($_smarty_tpl->tpl_vars['noticemsg1']->value!=''){?><br/><?php echo $_smarty_tpl->tpl_vars['noticemsg1']->value;?>
<?php }?>
        <a href="#" class="close">x</a>
    </div>
    <?php }?>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 </div>
    <div class="content">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th> 名称 </th>
                    <th> 文件数 </th>
                    <th> 链接 </th>
                    <th> 操作 </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <a href='resource?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&dir=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['updir'], ENT_QUOTES, 'UTF-8');?>
'>..返回</a> </td>
                    <td></td>
                    <td></td>
                    <td class="actions"></td>
                </tr>
                <?php if (is_array($_smarty_tpl->tpl_vars['data']->value['lists'])){?>
                <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value){
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
                <tr>
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['type']=='dir'){?>
                    <td> <a href='resource?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&dir=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['dir'], ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8');?>
'><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a> </td>
                    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['size'], ENT_QUOTES, 'UTF-8');?>
</td>
                    <td></td>
                    <?php }else{ ?>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8');?>
 </td>
                    <td>1</td>
                    <td> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['publishurl'], ENT_QUOTES, 'UTF-8');?>
</td>
                    <?php }?>
                    <td class="actions">
                        <!--a href="field/edit?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
=}" title="编辑"><img src="img/icons/actions/edit.png" alt="" /></a-->
                        <a href="resource/delete?siteid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
&dir=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['dir'], ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8');?>
" title="删除" onclick="return confirm('确认删除？');"><img src="img/icons/actions/delete.png" ></a>
                    </td>
                </tr>
                <?php } ?>
                <?php }?>
            </tbody>
        </table>
    </div>

</div>
<div class="bloc left">
    <div class="title">添加目录</div>
    <div class ="content">
        <form action="" method="post">
            <div class="input">
                <input type="text" name="name" value="">
            </div>
            <div class="submit clear">
                <input type='hidden' name='siteid' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
'/>
                <input type='hidden' name='dir' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['dir'], ENT_QUOTES, 'UTF-8');?>
'/>
                <input type="submit" name="submit" value="添加">
            </div>
        </form>
    </div>
</div>
<div class="bloc right">
    <div class="title">上传文件</div>
    <div class ="content">
        <form action="" method="post" enctype="multipart/form-data">
            <div class='input'>
            <input type="file" id="file" name="file"><br/>
            上传后解压zip文件：<input type="checkbox" name='unzip' class='checkbox'>
            </div>
            <div class="submit clear">
                <input type='hidden' name='siteid' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
'/>
                <input type='hidden' name='dir' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['dir'], ENT_QUOTES, 'UTF-8');?>
'/>
                <input type="submit" name="submit" value="上传">
            </div>
        </form>
    </div>
</div><?php }} ?>