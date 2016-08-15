{=include file="example/header.tpl" title=csrf=}

<script type="text/javascript">
$(document).ready(function(){
	$(".csrf_fail").click(function(){
		$(this).load('/example/test/csrf_data', {'r':Math.random()}, function(data){
			alert("csrf");
			return false;
		});
	});
  
	$(".csrf_succ").click(function(){
		$(this).load('/example/test/csrf_data', {'r':Math.random(), 'csrf_test_name': $.cookie('csrf_cookie_name')}, function(data){
			alert("csrf: " + data);
			return false;
		});
	});
});
</script>

<pre>
<a href="javascript:void(0);" class="csrf_fail">csrf_fail_post</a>
</pre>

<pre>
<a href="javascript:void(0);" class="csrf_succ">csrf_succ_post</a>
</pre>

<pre>
<img src="/images/accept.png" />
</pre>
{=include file="example/footer.tpl"=}