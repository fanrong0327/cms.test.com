{=include file="cms/header.tpl" title=test=}
模板域管理=>添加<br/>
模板名称【{=$tplinfo.name=}】<br/>
<form {=if $fieldinfo.id gt 0 =}action='/cms/field/edit'{=else=}action='/cms/field/add'{=/if=} method="post">
    模版域名称:<input type='text' name='name' value='{=$fieldinfo.name=}'/><br/>
    模版域类型:<select name="fieldtype">
            <option value="1" {=if $fieldinfo.fieldtype eq 1=}selected{=/if=}>单行文本框</option>
            <option value="2" {=if $fieldinfo.fieldtype eq 2=}selected{=/if=}>多行文本框</option>
            <option value="3" {=if $fieldinfo.fieldtype eq 3=}selected{=/if=}>HTML编辑器</option>
            <option value="">---------------------</option>
            <option value="4" {=if $fieldinfo.fieldtype eq 4=}selected{=/if=}>多选框</option>
            <option value="5" {=if $fieldinfo.fieldtype eq 5=}selected{=/if=}>单选框</option>
            <option value="">---------------------</option>
            <option value="6" {=if $fieldinfo.fieldtype eq 6=}selected{=/if=}>图片文件(上传框)</option>
            <option value="7" {=if $fieldinfo.fieldtype eq 7=}selected{=/if=}>视频文件(上传框)</option>
            <option value="">---------------------</option>
            <option value="8" {=if $fieldinfo.fieldtype eq 8=}selected{=/if=}>跨项目发布</option>
            <option value="">---------------------</option>
            <option value="9" {=if $fieldinfo.fieldtype eq 9=}selected{=/if=}>SQL结果集</option>
            <option value="10" {=if $fieldinfo.fieldtype eq 10=}selected{=/if=}>自定义程序</option>
            </select><br/>
    模版域状态:<select name="status">
              <option value="0" {=if $fieldinfo.status eq 0=}selected{=/if=}>未启用</option>
              <option value="1" {=if $fieldinfo.status eq 1=}selected{=/if=}>启用</option>
              </select><br/>
    模版域算法:<textarea name="rules" cols="70" rows="8">{=$fieldinfo.rules=}</textarea><br/>
    &nbsp;&nbsp;录入提示:<input type='text' name='promote' value='{=$fieldinfo.promote=}'/><br/>
    备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注:<textarea name="mem" cols="70" rows="3">{=$fieldinfo.mem=}</textarea><br/>
    {=if $fieldinfo.id gt 0 =}
    <input type='hidden' name='id' value='{=$fieldinfo.id=}'/><br/>
    {=/if=}
    <input type='hidden' name='siteid' value='{=$siteid=}'/><br/>
    <input type='hidden' name='tplid' value='{=$tplid=}'/><br/>
    <input type='submit' name='submit' value='提交'/><br/>
</form>
{=include file="cms/footer.tpl"=}