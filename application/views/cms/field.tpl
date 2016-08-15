{=include file="cms/header.tpl" title=test=}
模板域管理--<a href="/cms/field/add?siteid={=$siteid=}&tplid={=$tplid=}">添加</a><br/>
域编号----域名称----域类型----域状态----备注<br/>
{=section name=sec1 loop=$fieldlist=}
{=$fieldlist[sec1].id=}----{=$fieldlist[sec1].name=}----{=$fieldlist[sec1].fieldtype=}----{=$fieldlist[sec1].status=}--<a href="/cms/field/edit?siteid={=$siteid=}&tplid={=$tplid=}&id={=$fieldlist[sec1].id=}">模板域编辑</a><br/>
{=/section=}
{=include file="cms/footer.tpl"=}