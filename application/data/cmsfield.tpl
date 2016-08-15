if(!function_exists ('__getApi')){
function __getApi($url)
{       
    list($usec, $sec) = explode(" ", microtime());
    $starttime = ((float) $usec + (float) $sec);
    for ($i = 0; $i < 3; $i ++) {
        $mreturn = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $data = curl_exec($ch);
        curl_close($ch);
        if (empty($data) && $i < 3) {
             continue;
        }else{
            break;         
        } 
    }
    $data1 = json_decode($data,true);
    __getlog($url,$data,$data1,$starttime);
    $siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
    $tplid = isset($_GET['tplid'])?intval($_GET['tplid']):0;
    $id = isset($_GET['id'])?intval($_GET['id']):0;
    if(is_array($data1) && $data1['result']['status']['msg'] == 'succ'){
        //$mreturn = $data1['result']['data'];
        $mreturn = __rowsflag($url, $data1['result']['data']);  
        if(empty($mreturn)){
          $content = date('Y-m-d H:i:s') .' call api is empty '."\t".$siteid ."\t".$tplid."\t".$id."\t".$url ."\n";
          //error_log($content,3,'/data/cmslog/apicall_error.log');
          //__sendEmail($content);
          //die('获取数据失败请联系技术人员!<br>'.$content);
        }
    }else{
          $content = date('Y-m-d H:i:s') . ' call api is fail '."\t".$siteid ."\t".$tplid."\t".$id."\t".$url ."\n";
          //error_log($content,3,'/data/cmslog/apicall_error.log');
          //__sendEmail($content);
         // die('获取数据失败请联系技术人员!<br>'.$content);
    }
    return $mreturn;
}
}

if (!function_exists('__rowsflag')) {

    function __rowsflag($url, $mreturn) {
        $num = count($mreturn);
        $parse_url = parse_url($url);
        parse_str($parse_url['query'], $param);
        if (isset($param['num'])) {
            if ($param['num'] != $num) {
                //echo 'api param num is error! ';
                //$mreturn = '';
            }
        } else if (isset($param['number'])) {
            if ($param['number'] != $num) {
                //echo 'api param number is error!';
                //$mreturn = '';
            }
        }
        return $mreturn;
    }

}



if (!function_exists('__sendEmail')) {
    function __sendEmail($content){
        $email = "ekliu@126.com;benzma@qq.com;benzma@139.com;411324026@qq.com";
        $title = 'CMS Warning';
        $command = "/data/www/rsync/warnning.sh "."'{$email}'"." "."'{$content}'"." "."'{$title}'";
        $tresult = shell_exec($command);
    }
}

if (!function_exists('__getlog')) {
    function __getlog($url,$data,$data1,$starttime) {
        $len = strlen($data);
        $time = date('Y-m-d H:i:s');
        if(is_array($data1['result']['data'])){
            $isarray = 1;
        }else{
            $isarray = 0;
        }
        list($usec, $sec) = explode(" ", microtime());
        $endtime = ((float) $usec + (float) $sec) - $starttime;
        $content = $time . "\t". $len. "\t" .$isarray."\t". $endtime ."\t".$url . "\n";
        
        error_log($content,3,'/data/cmslog/apicall.log');
    }
}


if (!function_exists('__getCategory')) {
    function __getCategory($name) {
        $category_arr = array(
            '玄幻奇幻' => 'http://xuanhuan.kanshu.com/',
            '仙幻奇缘' => 'http://xuanhuan.kanshu.com/',
            '武侠仙侠' => 'http://wuxia.kanshu.com/',
            '都市言情' => 'http://dushi.kanshu.com/',
            '历史军事' => 'http://lishi.kanshu.com/',
            '历史时空' => 'http://lishi.kanshu.com/',
            '网游竞技' => 'http://wangyou.kanshu.com/',
            '网游灵异' => 'http://wangyou.kanshu.com/',
            '科幻灵异' => 'http://kehuan.kanshu.com/',
            '现代言情' => 'http://mm.kanshu.com/',
            '古代言情' => 'http://mm.kanshu.com/',
            '耽美同人' => 'http://mm.kanshu.com/',
            '青春校园' => 'http://mm.kanshu.com/',
        );
        if (isset($category_arr[$name])) {
            return $category_arr[$name];
        } else {
            return;
        }
    }
}

if (!function_exists('__getCategoryInfo')) {
    function __getCategoryInfo($category_id) {
        $url = "http://open.kanshu.com/ks_book/category/lists/?app_key=4037461542&parent_id={$category_id}";
        $res = __getApi($url);
        if (isset($res) && !empty($res)) {
            //$retun = $res[1][0]['next_category'];
            $retun = isset($res[1][0]['next_category']) ? $res[1][0]['next_category'] :$res[2][0]['next_category'];
            $ids = $category_id . ',';
            foreach($retun as $key=>$value) {
                $ids .=$value['id'].',';
            }
            return substr($ids,0,strlen($ids)-1);
        }
    }
}

if(!function_exists ('getBookInfoByNewId')){
function getBookInfoByNewId($bookId,$str,$debug=false)
{
    $_APP_KEY = '4037461542';
    $_APP_SECRET = 'c0d349ef59e2a66e6582d17d4ee3913c';
    $token = md5($bookId.'#'.$_APP_SECRET);
    $url = "http://open.kanshu.com/ks_book/book/info_book/?book_id={$bookId}&access_token={$token}&app_key={$_APP_KEY}&book_fields_str={$str}";
    if($debug==true){
    echo $url.'<br/>';
    }
    return __getApi($url);
}
}
if(!function_exists ('getBookInfo')){
function getBookInfo($bookId,$str,$companyid=2,$debug=false)
{
    $_APP_KEY = '4037461542';
    $_APP_SECRET = 'c0d349ef59e2a66e6582d17d4ee3913c';
    $token = md5($bookId.'#'.$_APP_SECRET);
    //$url = "http://open.kanshu.com/ks_book/book/info_book/?original_book_id={$bookId}&company_id={$companyid}&access_token={$token}&app_key={$_APP_KEY}&book_fields_str={$str}";
     $url = "http://open.kanshu.com/ks_book/book/info_book/?book_id={$bookId}&access_token={$token}&app_key={$_APP_KEY}&book_fields_str={$str}";
    
    if($debug==true){
    echo $url.'<br/>';
    }
    return __getApi($url);
}
}
if(!function_exists ('__get_list')){
function __get_list($sql)
{
    $_resultArr = array();
    if(strlen($sql)>10){
    $link = mysql_connect( 'dbm1.intra.cmyd','cmldcms', 'cmldcms2016mysql');
    mysql_select_db('cms_admin', $link);
    $result = mysql_query($sql,$link);
    while($row=mysql_fetch_array($result)) {
        array_push($_resultArr,$row);
    }
    mysql_close($link);
    }
    return $_resultArr;
}
}
$_BEFORE_HTML = '';
$_display = '/*TAG_HTML*/';
$_AFTER_HTML = '';

$sql = "/*TAG_SQL*/";
$_resultArr = __get_list($sql);
/*TAG_CGI*/
if(count($_resultArr) == 1)
{
    $_resultArr = $_resultArr[0];
    $search = array();
    $replace = array();
    foreach($_resultArr as $key=>$val)
    {
        $search[] = '${'.$key.'}';
        $replace[] = $val;
    }
    $result = str_replace($search,$replace,$_display);
}
else
{
    $result = '';
    foreach($_resultArr as $item)
    {
        $search = array();
        $replace = array();
        foreach($item as $key=>$val)
        {
            $search[] = '${'.$key.'}';
            $replace[] = $val;
        }
        $result .= str_replace($search,$replace,$_display);
    }
}
return $_BEFORE_HTML.$result.$_AFTER_HTML;