function __get_list($sql)
{
    $_resultArr = array();
    //get conn
    $conn = mysql_connect('localhost:3307', 'root', 'wap.monternet.com');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }
    /*以下是要被替换为db操作的代码*/
    $result = mysql_query($sql,$conn);
    //while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    //    array_push($_resultArr,$row);
    //}
    while ($row = mysql_fetch_row($result)) {
        array_push($_resultArr,$row);
    }    
    mysql_free_result($result);
    mysql_close($conn);
    return $_resultArr;
}
$sql = '/*TAG_SQL*/';

$_resultArr = __get_list($sql);
print_r($_resultArr);
exit;

/*TAG_CGI*/
$_display =<<<HTML
/*TAG_HTML*/
HTML;
return $_display;
