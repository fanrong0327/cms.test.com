{=include file="example/header.tpl" title=xss=}
<pre>
{=$test1=}
</pre>

<pre>
{=$test2 nofilter=}
</pre>
{=include file="example/footer.tpl"=}