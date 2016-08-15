{=include file="cms/header.tpl" title=test=}
站点管理=>添加<br/>
站点名称<br/>
<form {=if $siteinfo.id gt 0 =}action='/cms/site/edit'{=else=}action='/cms/site/add'{=/if=} method="post">
    站点名称<input type='text' name='name' value='{=$siteinfo.name=}'/><br/>
    发布地址<input type='text' name='url' value='{=$siteinfo.url=}'/><br/>
    ============================================<br/>
    数据库主机<input type='text' name='dbhost' value='{=$siteinfo.dbhost=}'/><br/>
    数据库端口<input type='text' name='dbport' value='{=$siteinfo.dbport=}'/><br/>
    数据库用户<input type='text' name='dbuser' value='{=$siteinfo.dbuser=}'/><br/>
    数据库密码<input type='text' name='dbpass' value='{=$siteinfo.dbpass=}'/><br/>
    ============================================<br/>
    是否启用<select name="isuse">
            <option value="1" {=if $siteinfo.isuse eq 1=}selected{=/if=}>是</option>
            <option value="0" {=if $siteinfo.isuse eq 0=}selected{=/if=}>否</option>
            </select><br/>
    是否隐藏<select name="ishide">
              <option value="0" {=if $siteinfo.ishide eq 0=}selected{=/if=}>否</option>
              <option value="1" {=if $siteinfo.ishide eq 1=}selected{=/if=}>是</option>
              </select><br/>
    {=if $siteinfo.id gt 0 =}
    <input type='hidden' name='id' value='{=$siteinfo.id=}'/><br/>
    {=/if=}
    <input type='submit' name='submit' value='提交'/><br/>
</form>
{=include file="cms/footer.tpl"=}