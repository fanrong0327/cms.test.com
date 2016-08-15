{=include file="cms/header.tpl" title=test=}
文档管理--<a href="/cms/content/add?siteid={=$siteid=}&tplid={=$tplid=}">添加</a><br/>
编号----文档名称----创建时间----发布时间----创建者<br/>
{=section name=sec1 loop=$doclist=}
{=$doclist[sec1].id=}----{=$doclist[sec1].url=}----{=$doclist[sec1].createtime=}----{=$doclist[sec1].publishtime=}----{=$doclist[sec1].creater=}--<a href="/cms/content/edit?siteid={=$doclist[sec1].siteid=}&tplid={=$doclist[sec1].templateid=}&id={=$doclist[sec1].id=}">编辑</a>-<a href="/cms/content/publish?siteid={=$doclist[sec1].siteid=}&tplid={=$doclist[sec1].templateid=}&id={=$doclist[sec1].id=}">发布</a><br/>
{=/section=}
{=include file="cms/footer.tpl"=}