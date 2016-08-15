{=include file="cms/header.tpl" title=test=}
模板管理--<a href="/cms/template/add?siteid={=$siteid=}">添加</a><br/>
编号----模板名称----模板排序<br/>
{=section name=sec1 loop=$templates=}
{=$templates[sec1].id=}----{=$templates[sec1].name=}----{=$templates[sec1].sortid=}--<a href="/cms/content?siteid={=$siteid=}&tplid={=$templates[sec1].id=}">内容管理</a>-<a href="/cms/tpldesign?siteid={=$siteid=}&tplid={=$templates[sec1].id=}">模板设计</a>-<a href="/cms/field?siteid={=$siteid=}&tplid={=$templates[sec1].id=}">模板域管理</a>-<a href="/cms/template/edit?siteid={=$siteid=}&id={=$templates[sec1].id=}">模板编辑</a><br/>
{=/section=}
{=include file="cms/footer.tpl"=}