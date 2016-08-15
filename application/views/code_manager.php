<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Code_manager</title>
        <link href="/css/codeploy/reset.css" type="text/css" rel="stylesheet">
        <link href="/css/codeploy/style.css" type="text/css" rel="stylesheet">
        <script src="/js/jquery.min.js"></script>
        <script src="/js/jquery-ui.min.js"></script>
    </head>

    <body>
        <div class="wrap">
            <div class="code_box clearfix">
                <div class="code_server">
                    <span class="title">代码部署</span>
                    <?php foreach ($right as $key=>$value) { ?>
                    <span class="server-item">
                        <input id="<?php echo $key?>" name="server" type="radio" /><label for="<?php echo $key?>"><?php echo $value?></label>
                    </span>

                    <?php } ?>
                </div>
                <div class="dir_box">
                    <div class="dir_title">
                        <h3 class="fl">当前路径:</h3>
                        <p class="dir_path" id="path"><span>/root</span></p>
                    </div>
                    <div class="dir_cont clearfix">
                        <div class="dir_left fl">
                            <h3>目录列表:</h3>
                            <select id="selectDir" ondblclick="enterDirFun()"  multiple>
                                <?php foreach ($dirs as $key => $val) { ?>
                                    <OPTION value="<?php echo $key ?>"><?php echo $val['files'] ?></OPTION>
                                <?php } ?>
                                <?php foreach ($files as $key => $val) { ?>
                                    <OPTION  value="."><?php echo $val['files'] ?></OPTION>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="code_tip fr">
                            <h3>命令行输出:</h3>
                            <div class="tip_box">
                                <div id="result" class="tip_txt">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dir_btn">
                        <input id="enterDir" type="button" value="进入目录" onClick="enterDirFun()">
                        <input id="publishDir" type="button" value="部署所选"  onClick="deployFun()" >
                    </div>
                    <div class="code_intro">
                        <h3>新功能说明：</h3><br/>
                        <p>1、显示的当前路径的各级目录可点击进行快捷切换目录；<br/><br/>
                            2、要同步的文件可进行多选，但不能对目录进行多选进行部署；<br/><br/>
                            3、内部测试机、外部测试机、生产机不可复选，只能单独进行部署。<br/><br/>
                        </p>
                    </div>
                </div>

            </div>
        </div>
        <script type="text/javascript">

            //进入目录 
            function enterDirFun() {
                var currentDir = $('#selectDir').val();
                if (currentDir == '.') {
                    alert('请选择目录!');
                    return;
                }
                if (currentDir[1] != undefined) {
                    alert('同时只能选择一个目录！');
                    return;
                }
                currentDir = currentDir[0];
                dirArr = currentDir.split("/");
                file = dirArr.pop();

                
                if (dirArr.length >= 2 && file.indexOf('.') > 0 &&file.indexOf('.lingyun5.com') <= 0 && file.indexOf('.fensebook.com') <= 0 && file.indexOf('.fensebook.net') <= 0) {
                    alert('你选择了文件，进入目录的时候只能选择目录！');
                    return;
                }
                
                $.get('/codedeploy/loadFiles', {'activepath': currentDir}, function(data) {
                    $('#selectDir').html(data);
                    processPath(currentDir)
                });
            }

            //生成路径
            function processPath(path) {
                var arr = path.slice(1).split("/"), newpath = [], html = "";
                var i = 0, l = arr.length;
                for (; i <= l - 1; i++) {
                    newpath[i] = "<span class=\"sub\">" + arr[i] + "</span>"
                    if (i == l - 1) {
                        newpath[i] = arr[i]
                    }
                }
                html = '<span>/root</span>/' + newpath.join("/");
                //alert(newpath.join("/"))
                $('#path').html(html);
                $('#path span').bind("click", function() {
                    var j = 0, n = $(this).index(), np = [], rp = "";

                    if (n == 0) {
                        rp = "";
                    } else {
                        for (; j < n; j++) {
                            np[j] = arr[j]
                        }
                        rp = "/" + np.join("/");
                    }
                    $.get('/codedeploy/loadFiles', {'activepath': rp}, function(data) {
                        $('#selectDir').html(data);
                        processPath(rp)
                    });
                })
            }


            //部署
            function deployFun() {
                var innerTest = 0, externalTest = 0, externalProduction = 0,
                        currentDir = $('#selectDir').val();
                if (!currentDir)
                    return;

                var i = 0, l = currentDir.length;
                if (currentDir.length > 0) {
                    for (; i < l; i++) {
                        var txt = $('#selectDir option:selected').eq(i).text();
                        if ('.' == txt || '..' == txt) {
                            alert("请选择正确的目录或文件!");
                            return
                        }
                    }
                }
                if ($("#innerTest").attr('checked') == 'checked') {
                    innerTest = 1
                }

                if ($("#externalTest").attr('checked') == 'checked') {
                    externalTest = 1
                }

                if ($("#externalProduction").attr('checked') == 'checked') {
                    externalProduction = 1
                }
                $.post('/codedeployexec/execRsync', {innerTest: innerTest, externalTest: externalTest, externalProduction: externalProduction, currentDir: currentDir}, function(data) {
                    $('#result').html(data);
                    $(".tip_box").show()
                });

            }

//            $(function() {
//                $(".tip_box .close").click(function() {
//                    $(this).parent().slideUp()
//                })
//            });

        </script>
    </body>
</html>
