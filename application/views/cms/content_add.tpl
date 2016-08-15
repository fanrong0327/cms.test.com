{=include file="cms/header.tpl" title=test=}
文档管理=>添加<br/>
文档名称【{=$tplinfo.name=}】<br/>
<form {=if $contentinfo.id gt 0 =}action='/cms/content/edit'{=else=}action='/cms/content/add'{=/if=} method="post">
    {=if $contentinfo.id gt 0 =}
    名称:<input type='text' name='name' value='{=$contentinfo.name=}'/><br/>
    URL:<input type='text' name='url' value='{=$contentinfo.url=}'/><br/>
    {=/if=}
    {=section name=sec1 loop=$fieldlist=}
    {=assign var="id" value="field_{=$fieldlist[sec1].id=}"=}
    {=$fieldlist[sec1].name=}:
    {=if $fieldlist[sec1].fieldtype eq 1=}
    <input type="text" name="field_{=$fieldlist[sec1].id=}" value="{=$contentinfo[$id]=}"/>
    {=elseif $fieldlist[sec1].fieldtype eq 2=}
    <textarea name="field_{=$fieldlist[sec1].id=}" cols="70" rows="8">{=$contentinfo[$id]=}</textarea>
    {=/if=}
    <br/>
    {=/section=}
    {=if $contentinfo.id gt 0 =}
    <input type='hidden' name='id' value='{=$contentinfo.id=}'/><br/>
    {=/if=}
    <input type='hidden' name='siteid' value='{=$siteid=}'/><br/>
    <input type='hidden' name='tplid' value='{=$tplid=}'/><br/>
    <input type='submit' name='submit' value='提交'/><br/>
</form>
{=include file="cms/footer.tpl"=}