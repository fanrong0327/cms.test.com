{=include file="cms/header.tpl" title=test=}
站点管理--<a href="/cms/site/add">添加</a><br/>
编号----名称<br/>
{=section name=sec1 loop=$contacts=}
{=$contacts[sec1].id=}----{=$contacts[sec1].name=}--<a href="/cms/template?siteid={=$contacts[sec1].id=}">模板管理</a>--<a href="/cms/site/edit?id={=$contacts[sec1].id=}">修改站点</a><br/>
{=/section=}
{=include file="cms/footer.tpl"=}