<?php /* Smarty version Smarty-3.1.13, created on 2016-08-15 21:32:18
         compiled from "application/views/cms/content/add.html" */ ?>
<?php /*%%SmartyHeaderCode:78286621857b1c4627e7943-25898757%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb85ceb392e15afc02b3935da3d4d7c7d7871029' => 
    array (
      0 => 'application/views/cms/content/add.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78286621857b1c4627e7943-25898757',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'iszt' => 0,
    'id' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57b1c4629ea699_69069739',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b1c4629ea699_69069739')) {function content_57b1c4629ea699_69069739($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Users/lyy/Documents/www-git-batch/fanrong0327/cms.test.com/application/libraries/smarty/plugins/modifier.date_format.php';
?><?php $_smarty_tpl->tpl_vars["iszt"] = new Smarty_variable(0, null, 0);?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['name'] = 'sec1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['data']->value['fieldlist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==14){?>
<?php $_smarty_tpl->tpl_vars["iszt"] = new Smarty_variable(1, null, 0);?>
<?php }?>
<?php endfor; endif; ?>
<?php if ($_smarty_tpl->tpl_vars['iszt']->value!=1){?>
<script src="/js/ckeditor/ckeditor.js"></script>
<link href="/js/ckeditor/sample.css" rel="stylesheet">
<?php }?>
<h1> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </h1>
<div class="bloc">
    <div class="title"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['subtitle'], ENT_QUOTES, 'UTF-8');?>
 </div>
    <div class="content">
        <form action="" method="post" enctype="multipart/form-data">
            
            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['name'] = 'sec1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['data']->value['fieldlist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable("field_".((string)$_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id']), null, 0);?>
            <?php if ($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==1){?>
            <div class="input">
            <label for="input1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</label>
            <input type="text" name="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value], ENT_QUOTES, 'UTF-8');?>
"/>
            </div>
            <?php }elseif($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==2){?>
            <div class="input">
            <label for="input1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</label>
            <textarea name="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" rows="12"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value], ENT_QUOTES, 'UTF-8');?>
</textarea>
            </div>
            <?php }elseif($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==3){?>
            <div class="input">
            <label for="input1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</label>
            <textarea id="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" name="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" rows="12"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value], ENT_QUOTES, 'UTF-8');?>
</textarea>
            <script>
			CKEDITOR.replace('field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
');
		</script>
            </div>
            <?php }elseif($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==4){?>
            <div class="input">
            <label for="input1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</label>
        <!-- 专题需要的 -->
		<link href="/css/common.css" rel="stylesheet" type="text/css" />
		<link href="/css/pop.css" rel="stylesheet"type="text/css" />
		<link href="/css/public.css" rel="stylesheet"type="text/css" />

<div class="edit_head">
    <div class="edit_bar fl"><span><input type="button" name="tmpl_section" id="tmpl_section" value="选择横切"/></span><span><input type="button" name="tmpl_save" id="tmpl_save" value="保存模板"/></span></div>
</div>
<div class="edit_content">
    <div id="tmplcontainer" contenteditable="true" class="edit_tmpl clearfix"><?php echo $_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value];?>
</div>
</div>
<textarea name="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" id="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" style="display:none"></textarea>    

           
			<!-- 横切列表 begin -->
			<div id="NewSection">
			 	<div class="popWin">
			  		<h2 class="popTitle">选择横切</h2>
			     	<div class="popCont">
			            <!-- content begin -->
			            <div id="SectionList">
			            	<ul class="clearfix"></ul>
			            </div>
			            <!-- content end -->
			        </div>
			    </div>
			</div>
			<!-- 横切列表 end -->
			<!-- 添加模块 begin -->
			<div id="NewBlock">
			 <div class="popWin">
			  <h2 class="popTitle">添加模块 - <span>图片仅为示例，内容需要手动填充</span></h2>
			  <div class="popCont">
			   <!-- content begin -->
			   <div id="NewBlockList">
			    	<ul class="clearfix"></ul>
			   </div>
			   <!-- content end -->
			  </div>
			 </div>
			</div>
			<!-- 添加模块 end -->
			<script type="text/javascript">
			var editor = CKEDITOR.inline( document.getElementById( 'tmplcontainer' ),{
				allowedContent: 'div[*](*); p h1 h2 h3 h4[*](*);ul[*](*);li[*](*); a[*](*);img[*](*); span[*](*)'
			} );
			</script>
			<script src="/js/artDialog/jquery.artDialog.js"></script>
			<script type="text/javascript" src="/js/tempdata.js"></script>
			<script type="text/javascript" src="/js/tempmod.js"></script>
			<script type="text/javascript">
			_TempPage.init("field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
");
			</script>
            </div>
            <?php }elseif($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==14){?>
            <div class="input">
            <label for="input1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</label>
        <!-- 专题需要的 -->
<link href="http://img.kanshu.com/2013/flzt/css/common.css" rel="stylesheet" type="text/css" />
<link href="http://img.kanshu.com/2013/flzt/css/default.css" rel="stylesheet" type="text/css" />
<link href="http://img.kanshu.com/2013/flzt/css/pop20141128.css" rel="stylesheet" type="text/css" />
<link href="http://img.kanshu.com/2013/flzt/css/public.css" rel="stylesheet" type="text/css" />
<link href="http://img.kanshu.com/2013/flzt/css/medal.css" rel="stylesheet" type="text/css" />
<link href="http://img.kanshu.com/2013/flzt/js/artDialog/skins/idialog.css" rel="stylesheet" />
<script src="http://img.kanshu.com/2013/flzt/js/jquery.js"></script>
<script>
		var systime = "<?php echo htmlspecialchars(smarty_modifier_date_format(strtotime("-1 month"),"%Y-%m"), ENT_QUOTES, 'UTF-8');?>
";
		<?php if ($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id']>0){?>
		var editpage=true;
		<?php }else{ ?>
		var editpage=false;
		<?php }?>
</script>

<div class="edit_head">
    <div class="edit_bar fl"><span><input type="button" name="tmpl_section" id="tmpl_section" value="插入横切"/></span><span><input type="button" name="tmpl_save" id="tmpl_save" value="保存模板"/></span></div>
</div>
<div class="edit_content">
    <div id="tmplcontainer" contenteditable="true" class="edit_tmpl clearfix"><?php echo $_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value];?>
</div>
</div>
<textarea name="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" id="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" style="display:none"></textarea>  

<!-- 风格列表 begin -->
<div id="NewStyle">
 <div class="popWin">
  <h2 class="popTitle">更换风格</h2>
  <div class="popCont">
   <!-- content begin -->
   <div id="StyleList">
   
   </div>
   <!-- content end -->
   </div>
 </div>
</div>
<!-- 风格列表 end -->
<!-- 横切列表 begin -->
<div id="NewSection">
 	<div class="popWin">
  		<h2 class="popTitle">选择横切</h2>
     	<div class="popCont">
            <!-- content begin -->
            <div id="SectionList">
            	<ul class="clearfix"></ul>
            </div>
            <!-- content end -->
        </div>
    </div>
</div>
<!-- 横切列表 end -->
<!-- 添加模块 begin -->
<div id="NewBlock">
 <div class="popWin">
  <h2 class="popTitle">添加模块 - <span>图片仅为示例，内容需要手动填充</span></h2>
  <div class="popCont">
   <!-- content begin -->
   <div id="NewBlockList">
    	<ul class="clearfix"></ul>
   </div>
   <!-- content end -->
  </div>
 </div>
</div>
<!-- 添加模块 end -->
<!-- 编辑模块 begin -->
<div id="EditBlock">
 <div class="popWin">
  <h2 class="popTitle">编辑模块 - <span>图片仅为示例，内容需要手动填充</span></h2>
  <div class="popCont">
  	  <!-- content begin -->
      <div class="searchForm">
      	  
          <span>书id: <input type="text" value="" class="t_i" id="bookbid"/></span>
          <span>榜单类型: 
         <select id="medeltype"  class="t_s selector">
         <option selected="selected">默认</option>
		<option value="vip_xinshu">vip新书人气榜</option>
		<option value="vip_jingpin">vip精品人气榜</option>
</select>
          </span>
          <span><input type="button" id="search_btn" class="t_b" value="查询" /></span>
          <span><input type="button" id="hide_btn" class="t_b" value="隐藏" /></span>
       </div>
       <div class="searchList">
            <textarea id="search_ta" class="t_a"></textarea>
       </div>
     
       <div id="EditBlockList" class="mt10">
       		<div class="editarea"><textarea id="edit_ta" class="t_a"></textarea></div>
            <ul class="clearfix"></ul>
            <div class="editbtn mt10"><input type="button" id="EditConfirm" value="提 交" /></div>
       </div>
       <!-- content end -->
  </div>
 </div>
</div>
<!-- 编辑模块 end -->

<script src="http://img.kanshu.com/2013/flzt/js/artDialog/jquery.artDialog.js"></script>
<script src="http://img.kanshu.com/2013/flzt/js/htmlFormat.js"></script>
<script src="http://img.kanshu.com/2013/flzt/js/packer.js"></script> 
<script src="http://img.kanshu.com/2013/flzt/js/tempdata.js"></script>
<script src="http://img.kanshu.com/2013/flzt/js/tempmod.js"></script>
<script src="http://img.kanshu.com/2013/flzt/js/page.js"></script>
<script>
$(function(){
	_TempPage.init("field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
");
})
</script>
</div>
         
            
            <?php }elseif($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==5){?>
            <div class="input">
            <label for="input1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</label>
            <select name="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
">
            <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['rules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value){
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
            <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['id']==$_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value]){?> selected <?php }?>> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </option>
            <?php } ?>
            </select>
            </div>
            <?php }elseif($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==6){?>
            <div class="input">
            <label for="input1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</label>
            <?php if ($_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value]!=''){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['imgurl'], ENT_QUOTES, 'UTF-8');?>
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value], ENT_QUOTES, 'UTF-8');?>
<br/><?php }?>
            <input type="file" name="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" id="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
">
            </div>
            <?php }elseif($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==10){?>
            <div class="input">
            <label for="input1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</label>
            <textarea name="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" rows="30"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value], ENT_QUOTES, 'UTF-8');?>
</textarea>
            </div>
            <?php }elseif($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==11){?>
            <div class="input">
            <label for="input1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</label>
            <input type="text" name="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value], ENT_QUOTES, 'UTF-8');?>
"/>
            </div>
            <!-- 单选关联 -->
            <?php }elseif($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==12){?>
            <div class="input">
            <label for="input1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</label>
            <select name="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" id="mast">
            <option value="0">请选择</option>
            <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['rules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value){
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
            <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['id']==$_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value]){?> selected <?php }?>> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </option>
            <?php } ?>
            </select>
            </div>
            <?php }elseif($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['fieldtype']==13){?>
            <div class="input">
            <label for="input1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['name'], ENT_QUOTES, 'UTF-8');?>
</label>
            <select name="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['id'], ENT_QUOTES, 'UTF-8');?>
" id="slave">
             <option value="0">请选择</option>
             <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['fieldlist'][$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['rules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value){
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
             <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['id']==$_smarty_tpl->tpl_vars['data']->value['content'][$_smarty_tpl->tpl_vars['id']->value]){?> selected <?php }?>> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['title'], ENT_QUOTES, 'UTF-8');?>
 </option>
             <?php } ?> </select>
            </div>
            <script>
                $(document).ready(function(){
                    $("#mast").change(function(){
                    $.getJSON("/content/getajax?siteid="+<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
+"&tplid="+<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['tplid'], ENT_QUOTES, 'UTF-8');?>
+"&id="+ $("#mast").val(), function(json){
                    num =json.length;
                    $("#slave").empty();
                    if(num>0){
                    for(i=0;i<num;i++){
                        $("#slave").append("<option value='"+ json[i].id+"'>"+json[i].title+"</option>");  
                    }
                    }else{
                         $("#slave").append("<option value=''>请选择</option>");  
                    }
                });
                  });
                });
             </script>
            <?php }?>
            <?php endfor; endif; ?>
            <?php if ($_smarty_tpl->tpl_vars['data']->value['content']['id']>0){?>
            <div class="input">
                <label for="input1">URL</label>
                <input type="text" name="url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['url'], ENT_QUOTES, 'UTF-8');?>
"> <br>
            </div>
            <?php }?>
            <div class="input">
                <label for="input1">输出类型</label>
                <select name="otype">
                <option value="UTF-8" <?php if ($_smarty_tpl->tpl_vars['data']->value['content']['otype']=='UTF-8'){?>selected<?php }?>>UTF-8</option>
                <option value="GB2312" <?php if ($_smarty_tpl->tpl_vars['data']->value['content']['otype']=='GB2312'){?>selected<?php }?>>GB2312</option>
                <option value="GB18030" <?php if ($_smarty_tpl->tpl_vars['data']->value['content']['otype']=='GB18030'){?>selected<?php }?>>GB18030</option>
                </select>
            </div>
            <div class="submit clear">
                <?php if ($_smarty_tpl->tpl_vars['data']->value['content']['id']>0){?>
                <input type='hidden' name='id' value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']['id'], ENT_QUOTES, 'UTF-8');?>
"/><br/>
                <?php }?>
                <input type='hidden' name='siteid' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['siteid'], ENT_QUOTES, 'UTF-8');?>
'/><br/>
                <input type='hidden' name='tplid' value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['tplid'], ENT_QUOTES, 'UTF-8');?>
'/><br/>
                <input type="submit" name="submit" value="提交">
            </div>
        </form>
    </div>
</div>
<?php }} ?>