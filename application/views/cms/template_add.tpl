{=include file="cms/header.tpl" title=test=}
模板管理=>添加<br/>
模板名称<br/>
<form {=if $tplinfo.id gt 0 =}action='/cms/template/edit'{=else=}action='/cms/template/add'{=/if=} method="post">
    模板名称:<input type='text' name='name' value='{=$tplinfo.name=}'/><br/>
    显示顺序:<input type='text' name='sortid' value='{=$tplinfo.sortid=}'/><br/>
    {=if $tplinfo.id gt 0 =}
    <input type='hidden' name='id' value='{=$tplinfo.id=}'/><br/>
    {=/if=}
    <input type='hidden' name='siteid' value='{=$siteid=}'/><br/>
    <input type='submit' name='submit' value='提交'/><br/>
</form>
{=include file="cms/footer.tpl"=}