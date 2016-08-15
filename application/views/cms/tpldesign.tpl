{=include file="cms/header.tpl" title=test=}
<script type="text/javascript">
//进入目录 

    function addToArea(item) {
        var currentDir = $('#'+item).val();
        if (currentDir == '') {
            alert('请选择项目!');
            return;
        }
        $(rules).insertContent(currentDir);
    }

    $(function() {
        /*  在textarea处插入文本--Start */
        (function($) {
            $.fn
                    .extend({
                insertContent: function(myValue, t) {
                    var $t = $(this)[0];
                    if (document.selection) { // ie  
                        this.focus();
                        var sel = document.selection.createRange();
                        sel.text = myValue;
                        this.focus();
                        sel.moveStart('character', -l);
                        var wee = sel.text.length;
                        if (arguments.length == 2) {
                            var l = $t.value.length;
                            sel.moveEnd("character", wee + t);
                            t <= 0 ? sel.moveStart("character", wee - 2 * t
                                    - myValue.length) : sel.moveStart(
                                    "character", wee - t - myValue.length);
                            sel.select();
                        }
                    } else if ($t.selectionStart
                            || $t.selectionStart == '0') {
                        var startPos = $t.selectionStart;
                        var endPos = $t.selectionEnd;
                        var scrollTop = $t.scrollTop;
                        $t.value = $t.value.substring(0, startPos)
                                + myValue
                                + $t.value.substring(endPos,
                                $t.value.length);
                        this.focus();
                        $t.selectionStart = startPos + myValue.length;
                        $t.selectionEnd = startPos + myValue.length;
                        $t.scrollTop = scrollTop;
                        if (arguments.length == 2) {
                            $t.setSelectionRange(startPos - t,
                                    $t.selectionEnd + t);
                            //this.focus();  
                        }
                    } else {
                        this.value += myValue;
                        //this.focus();  
                    }
                }
            })
        })(jQuery);
        /* 在textarea处插入文本--Ending */
    });
</script>
模板设计<br/>
站点名称【{=$siteinfo.name=}】--模板名称【{=$tplinfo.name=}】<br/>
<div>
    模板域列表：
    <select id="selectDir1" size="10" ondblclick="addToArea('selectDir1')">
        {=section name=sec1 loop=$fieldlist=}
        {=if $fieldlist[sec1].id eq 10000=}
        <option value="">{=$fieldlist[sec1].name=}</option>
        {=else=}
        <option value="${{=$fieldlist[sec1].name=}}">${{=$fieldlist[sec1].name=}}</option>
        {=/if=}
        {=/section=}
    </select>
    全局变量：
    <select id="selectDir2" size="10" ondblclick="addToArea('selectDir2')">
        {=section name=sec1 loop=$globallist=}
        <option value="${{=$globallist[sec1].name=}}">${{=$globallist[sec1].name=}}</option>
        {=/section=}
    </select>
    广告插件：
    <select id="selectDir3" size="10" ondblclick="addToArea('selectDir3')">
        {=section name=sec1 loop=$adlist=}
        <option value="{=$adlist[sec1].name=}">{=$adlist[sec1].name=}</option>
        {=/section=}
    </select></div>
<form action='/tpldesign/index' method="post">
    页面模板：<textarea id="rules" name="content" cols="70" rows="8">{=$tplinfo.content=}</textarea><br/>
     默认URL：<input type='text' name='url' value='{=$tplinfo.url=}'/><br/>
    发布条件：<textarea id="condition" name="condition" cols="70" rows="8">{=$tplinfo.condition=}</textarea><br/>
    内容格式：<select name="format">
        <option value="1" {=if $tplinfo.format eq 1=}selected{=/if=}>Text文本</option>
        <option value="2" {=if $tplinfo.format eq 2=}selected{=/if=}>HTML</option>
        <option value="3" {=if $tplinfo.format eq 3=}selected{=/if=}>SHTML</option>
        <option value="4" {=if $tplinfo.format eq 4=}selected{=/if=}>WML</option>
        <option value="5" {=if $tplinfo.format eq 5=}selected{=/if=}>XML</option>
        <option value="6" {=if $tplinfo.format eq 6=}selected{=/if=}>json</option>
    </select><br/>
    <input type='hidden' name='id' value='{=$tplinfo.id=}'/><br/>
    <input type='hidden' name='siteid' value='{=$siteinfo.id=}'/><br/>
    <input type='submit' name='submit' value='保存'/><br/>
</form>
{=include file="cms/footer.tpl"=}