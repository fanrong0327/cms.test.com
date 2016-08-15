//控制页面宽度自适应
$(function(){
	var mc = $("#main_content"), mw = $("#main_wraper"), sm = $("#side_menu");
	$(window).resize(function(){
		wrapresize()
	})
	function wrapresize(){
		var a = getViewWidth(), b = sm.width(), c = a-b-20;
		mc.width(a); mw.width(c)
	}
	function getViewWidth(){
		var a = document,
		b = a.compatMode == "BackCompat" ? a.body: a.documentElement;
		return b.clientWidth
	}
	wrapresize()
})