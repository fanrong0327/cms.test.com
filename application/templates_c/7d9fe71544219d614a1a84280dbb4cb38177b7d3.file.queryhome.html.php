<?php /* Smarty version Smarty-3.1.13, created on 2016-08-14 22:40:57
         compiled from "application/views/comquery/queryhome.html" */ ?>
<?php /*%%SmartyHeaderCode:177474368257b082f95bd379-80825811%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d9fe71544219d614a1a84280dbb4cb38177b7d3' => 
    array (
      0 => 'application/views/comquery/queryhome.html',
      1 => 1460366863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177474368257b082f95bd379-80825811',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tpllist' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57b082f96065d1_61087278',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b082f96065d1_61087278')) {function content_57b082f96065d1_61087278($_smarty_tpl) {?><html> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/> 
        <script type="text/javascript" src="http://img.kanshu.com/2013/com/jquery-1.10.2.min.js"></script>
        <title>通用查询</title> 
    </head> 
    <style type="text/css"> 
        body { 
            font: normal 11px auto "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
            color: #4f6b72; 
            background: #E6EAE9; 
        } 

        a { 
            color: #c75f3e; 
        } 

        .mytable { 
            width: 900px; 
            padding: 0; 
            margin: 0; 
        } 

        caption { 
            padding: 0 0 5px 0; 
            width: 700px; 
            font: italic 15px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
            text-align: left; 
        } 

        th { 
            font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
            color: #4f6b72; 
            border-right: 1px solid #C1DAD7; 
            border-bottom: 1px solid #C1DAD7; 
            border-top: 1px solid #C1DAD7; 
            letter-spacing: 2px; 
            text-transform: uppercase; 
            text-align: left; 
            padding: 6px 6px 6px 12px; 
            background: #CAE8EA  no-repeat; 
        } 

        th.nobg { 
            border-top: 0; 
            border-left: 0; 
            border-right: 1px solid #C1DAD7; 
            background: none; 
        } 

        td { 
            border-right: 1px solid #C1DAD7; 
            border-bottom: 1px solid #C1DAD7; 
            background: #fff; 
            font-size:11px; 
            padding: 6px 6px 6px 12px; 
            color: #4f6b72; 
        } 


        td.alt { 
            background: #F5FAFA; 
            color: #797268; 
        } 

        th.spec { 
            border-left: 1px solid #C1DAD7; 
            border-top: 0; 
            background: #fff no-repeat; 
            font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
        } 

        th.specalt { 
            border-left: 1px solid #C1DAD7; 
            border-top: 0; 
            background: #f5fafa no-repeat; 
            font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
            color: #797268; 
        } 
        /*---------for IE 5.x bug*/ 
        html>body td{ font-size:11px;} 
        body,td,th { 
            font-family: 宋体, Arial; 
            font-size: 12px; 
        } 
        select {
            // width: 200px;
        }
    </style> 
    <body>
        <table class="mytable" cellspacing="0">
            <caption>查询模板</caption> 
            <tr>
                <th scope="col">
                    <select name="select" id="template_id" onchange="getTempInfo();">
                        <option value="0">请选择:</option>
                        <?php  $_smarty_tpl->tpl_vars["list"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["list"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tpllist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["list"]->key => $_smarty_tpl->tpl_vars["list"]->value){
$_smarty_tpl->tpl_vars["list"]->_loop = true;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['tid'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['tname'], ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php } ?>
                    </select>
                </th>
            </tr>
        </table>
        <br/>
        <form>
            <table class="mytable" id="tablewhere" cellspacing="0"> 
                <caption>筛选条件</caption> 
                <tr>
                    <th scope="col">条件</th>
                    <th scope="col">说明</th> 
                    <th scope="col">运算符</th> 
                    <th scope="col">值</th>
                    <th scope="col">备注</th> 
                </tr>
                <tbody id="whererows">
                    <tr><td colspan="5">请选择模板</td></tr>
                </tbody>
            </table> 
        </form>
        <br/>
        <table class="mytable" cellspacing="0"> 
            <caption>查询结果</caption> 
            <tr id="restr"></tr> 
            <tbody id="resrows">
                <tr> 
                    <td class="row">无记录</td> 
                </tr> 
            </tbody>
        </table> 
        <br/>
        <table class="mytable" cellspacing="0"> 
            <tr> 
                <th scope="col">SQL</th> 
            </tr> 
            <tr> 
                <td class="row" id="sql"></td> 
            </tr> 
        </table> 
    </body> 
</html>
<script>
    //根据模板id获取筛选条件
    function getTempInfo() {
        var tplid = $("#template_id").val();
        if (tplid > 0) {
            var url = "/api/comquery/ajaxwhere?tplid=" + tplid;
            $.getJSON(url, function(json) {
                show_where(json);
            });
        }
    }
    //显示筛选条件
    function show_where(json) {
        var html = "";
        for (var i = 0; i < json.length; i++) {
            var name = json[i].name;
            var cname = json[i].cname;
            var mem = json[i].mem;
            var fid = json[i].fid;
            var tplid = json[i].tid;
            var _input = '<input type="text" name="value[' + i + ']" value="">';
            var _select = '<select name="option[' + i + ']" id="template_id"><option value="0">请选择:</option><option value="gt">></option><option value="egt">>=</option><option value="eq">=</option><option value="neq">!=</option><option value="lt"><</option><option value="elt"><=</option></select>';

            html += '<tr><input type="hidden" name="field[' + i + ']" value="' + name + '">'
                    + '<td class="row">&nbsp;' + name + '</td>'
                    + '	<td class="row">&nbsp;' + cname + '</td> '
                    + '	<td class="row">&nbsp;' + _select + '</td>'
                    + '	<td class="row">&nbsp;' + _input + '</td>'
                    + '	<td class="row">&nbsp;' + mem + '</td> '
                    + '</tr>';
        }

        html += '<tr><td colspan="5"><input type="hidden" name="tplid" value="' + tplid + '"><input type="button"  value="执行"  onclick="sbmt()"></td></tr>';
        $("#whererows").html(html);
    }
    //执行
    function sbmt() {
        var post_url = "/api/comquery/ajaxquery";
        var post_data = $("form").serialize();
        //alert(post_data);
        $.post(post_url, {
            data: post_data
        },
        function(mreturn) {
            showres(mreturn);
        }, "json");//这里返回的类型有：json,html,xml,text
    }
    //查询结果
    function showres(mreturn) {
        html = '';
        var title = mreturn.title;
        for (i = 0; i < title.length; i++) {
            html += '<th scope="col">' + title[i] + '</th> ';
        }
        $("#restr").html(html);
        var mdata = mreturn.data;
        var htmlc = '';
        for (k = 0; k < mdata.length; k++) {
            htmlc += "<tr>";
            for (i in mdata[k]) {
                htmlc += '<td class="row">' + mdata[k][i] + '</td>';
            }
            htmlc += "</tr>"

        }
        $("#resrows").html(htmlc);
        $("#sql").html(mreturn.sql);
    }






</script><?php }} ?>