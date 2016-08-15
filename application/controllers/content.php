<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends MY_Controller
{
    private $TAG_SQL = "/*TAG_SQL*/";
    private $TAG_CGI = "/*TAG_CGI*/";
    private $TAG_HTML = "/*TAG_HTML*/";
    
    //构造函数
    public function __construct()
    {
	parent::__construct();
	$this->load->model('modelsite');
	$this->load->model('modeltemplate');
	$this->load->model('modelfield');
	$this->load->model('modelcontent');
	$this->load->library("Cmstpl");
	$this->load->library("UFile");
	$this->loginCheck();
    }
    
    public function test()
    {
    	$this->loginCheck();
    }

    
    //内容列表
    public function index()
    {
    	$siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
    	$tplid = isset($_GET['tplid'])?intval($_GET['tplid']):0;

        $displayfileds = $this->modelfield->getDisplayFields($siteid,$tplid);
        $addfields='';
        $adddisplay = array();
        foreach($displayfileds as $field)
        {
            $addfields.=",`field_".$field['id']."`";
            $adddisplay[] = array('name'=>$field['name'],'value'=>"field_".$field['id']);
        }

        //搜索
        $fieldtype = isset($_GET['fieldtype'])?intval($_GET['fieldtype']):0;
        $keywords  = isset($_GET['keywords'])? $_GET['keywords'] : '';
        $seach = '';
        if($fieldtype>0 && trim($keywords) != ''){
            $seach = " WHERE field_{$fieldtype} LIKE  '%" . $this->db->escape_like_str($keywords) . "%'";
        }
        
        //分页
        $num = 100;
        $page = isset($_GET['page'])?intval($_GET['page']):1;
        $limit = $num * ($page -1);
        
        $doclistCount = $this->modelcontent->getListCount($siteid,$tplid,$addfields,$seach);
	    $doclist = $this->modelcontent->getList($siteid,$tplid,$addfields,$limit,$num,$seach);
          //分页
        $page_str = $this->setPages("/content", $doclistCount, $page, $num, "siteid={$siteid}&tplid={$tplid}&fieldtype={$fieldtype}&keywords={$keywords}");
        
	    $siteinfo = $this->modelsite->getSiteInfo($siteid);
	
	    //$this->act_verify = 'CONTENT_LIST';
        //$this->checkCurrentAction();
        $data = array(
            'title'=>'内容管理',
            'subtitle'=>'内容列表',
            'publishurl'=>$siteinfo['url'],
        );
	    $data['lists'] = $doclist;
        
        //搜索类型
        $query_type  = $this->getfields($siteid, $tplid);
        $this->smarty->assign("querytype", $query_type);
        $this->smarty->assign("keywords", $keywords);
        $this->smarty->assign("fieldtype", $fieldtype);
        
        
        $this->smarty->assign("page_html", $page_str); //分页
        $this->smarty->assign("siteid", $siteid);
        $this->smarty->assign("tplid", $tplid);
        $this->smarty->assign("adddisplay",$adddisplay);
        $this->smarty->assign('data',$data);
        $main = $this->smarty->fetch('cms/content/index.html');

        $this->smarty->assign('content',$main);
        $this->smarty->display('cms/content.html');
    }
    
    public function getfields($siteid,$tplid) {
        $fieldlist = $this->modelfield->getFields($siteid,$tplid);
        $data = array();
        foreach ($fieldlist as $key => $value) {
            if($value['fieldtype'] == 1 || $value['fieldtype'] == 2 || $value['fieldtype'] == 11){
                $data[$key]['id'] = $value['id'];
                $data[$key]['name'] = $value['name'];
            }
        }
        return $data;
    }
    
    //SQL语句解析
    public function parserSql($siteid,$sql)
    {
	$retarr = array();
	$searcharr = array();
	$replacearr = array();
	$replacearr2 = array();
	$siteinfo = $this->modelsite->getSiteInfo($siteid);
	$tablename = $this->getTableInfo($sql);
	$tplinfo = $this->modeltemplate->getTemplateByName($siteid,$tablename);
	if(is_array($tplinfo) && !empty($tplinfo) && $tplinfo['id']>0){
	    $fields = $this->modelfield->getUsingFields($siteid,$tplinfo['id']);
	    $searcharr[] = '${'.$tablename.'}';
	    $replacearr[] = 'cms_'.$siteid.'.cms_t_'.$tplinfo['id'];
	    $replacearr2[] = '${cms_t_'.$tplinfo['id'].'}';
	    
	    $searcharr[] = '${文档编号}';
		$replacearr[] = 'id';
		$replacearr2[] = '${id}';
		$searcharr[] = '${模板编号}';
		$replacearr[] = 'templateid';
		$replacearr2[] = '${templateid}';
		$searcharr[] = '${项目编号}';
		$replacearr[] = 'siteid';
		$replacearr2[] = '${siteid}';
		$searcharr[] = '${创建者}';
		$replacearr[] = 'creater';
		$replacearr2[] = '${creater}';
		$searcharr[] = '${创建时间}';
		$replacearr[] = 'createtime';
		$replacearr2[] = '${createtime}';
		$searcharr[] = '${发布者}';
		$replacearr[] = 'publisher';
		$replacearr2[] = '${publisher}';
		$searcharr[] = '${发布时间}';
		$replacearr[] = 'publishtime';
		$replacearr2[] = '${publishtime}';
		$searcharr[] = '${URL}';
		$replacearr[] = 'url';
		$replacearr2[] = '${url}';
		
	    
	    foreach($fields as $field)
	    {
		$searcharr[] = '${'.$field['name'].'}';
		$replacearr[] = 'field_'.$field['id'];
		$replacearr2[] = '${field_'.$field['id'].'}';

	    }
	}
	$retarr['sql'] = $sql;
	$retarr['search'] = $searcharr;
	$retarr['replace'] = $replacearr;
	$retarr['replace2'] = $replacearr2;
	return $retarr;
    }
    
    
    //取得数据表信息
    public function getTableInfo($sql)
    {
	$return = '';
	//$sql = 'select ${书名},${图片},${链接},${简介} FROM ${频道} where ${频道名称}=\'奇幻玄幻\' order by ${排序} limit 4;';
	$sqlpos = strpos($sql, ' FROM ${');
	if($sqlpos!==FALSE){
	    $substr = substr($sql,$sqlpos+6);
	    $sqlpos2 = strpos($substr, '} ');
	    if($sqlpos2!==FALSE){
		$return = substr($substr,2,$sqlpos2-2);
	    }
	}
	return $return;
    }
    
    
    //取得模板
    private function gettpl(){
	$filename = dirname(BASEPATH).'/'.APPPATH.'data/cmsfield.tpl';
	if(file_exists($filename)){
	    $this->htmlOutPut = file_get_contents($filename);
	}
    }
    
    
    //编译域
    public function compile($rules,$siteid,$tplid,$contentid)
    {
	$this->htmlOutPut = '';
	$mresult = '';
	$this->gettpl();
	$sqlpos = strpos($rules, '[SQL]');
	$cgipos = strpos($rules, '[CGI]');
	$htmlpos = strpos($rules, '[HTML]');
	$sql = '';
	$cgi = '';
	$html ='';
	
	
	//取得SQL内容
	if($sqlpos !== FALSE){
	    $sql = substr($rules,$sqlpos + 5,$cgipos-5);
	    $mresult = $this->parserSql($siteid,$sql);
	    
	    if(isset($mresult['search']) && !empty($mresult['search'])){
		$sql = str_replace($mresult['search'], $mresult['replace'], $sql);
	    }
	    
	    $this->htmlOutPut = str_replace($this->TAG_SQL, $sql, $this->htmlOutPut);
	}
	
	//取得CGI内容
	if($cgipos !== FALSE){
	    $cgi = substr($rules,$cgipos + 5,$htmlpos-$cgipos-5);
	    if(isset($mresult['search']) && !empty($mresult['search'])){
	    	$cgi = str_replace($mresult['search'], $mresult['replace'], $cgi);
	    }
	    $this->htmlOutPut = str_replace($this->TAG_CGI, $cgi, $this->htmlOutPut);
	    
	}
	
	//取得HTML内容
	if($htmlpos !== FALSE){
	    $html = substr($rules,$htmlpos + 6);
	    $html = str_replace("'","\'",$html);
	    if(isset($mresult['search']) && !empty($mresult['search'])){
		$html = str_replace($mresult['search'], $mresult['replace2'], $html);
	    }
	    $this->htmlOutPut = str_replace($this->TAG_HTML, $html, $this->htmlOutPut);
	    if(isset($_GET['debug']) && $_GET['debug']=='true' ){
	    	echo $this->htmlOutPut.'<br/>';
	    }
	    
	    //执行PHP代码，取得结果
	    $this->htmlOutPut = eval($this->htmlOutPut);
	    $this->htmlOutPut = str_replace("\'","'",$this->htmlOutPut);
	    if(isset($_GET['debug']) && $_GET['debug']=='true' ){
	    	echo "OK<br/>";
	    	//exit;
	    }
	}
	if($cgipos === FALSE || $htmlpos === FALSE)
	{
		$this->htmlOutPut = '';
	}
	
	return $this->htmlOutPut;
    }
    
    
    //添加文档
    public function add()
    {
	$uptype = 'img';
	$this->act_verify = 'CONTENT_ADD';
        $this->checkCurrentAction();
	if(isset($_POST['submit'])){
		//提交入库
	    $siteid = intval($_POST['siteid']);
	    
	    if($siteid == 4){
		$uptype = 'fk_res';
	    }
		if($siteid == 6){
		$uptype = 'vivo_res';
	    }
	    if($siteid == 11){
	    	$uptype = 'pjgame_res';
	    }	    
	    $tplid = intval($_POST['tplid']);
	    $update_data = $_POST;
	    
	    //上传文件和图片
	    foreach($_FILES as $key=>$value){
	    	$msize = $this->_getFieldIdRule($key);
	    	$result = $this->uploadfile($value,$uptype,$msize['X'],$msize['Y']);
			if($result['filename']!=''){
			    $update_data[$key] = str_replace($this->ufile->ft_get_root($uptype), '',$result['filename']);
			}
	    }

	    //存入数据库
	    $tplinfo = $this->modeltemplate->getData($siteid,$tplid);
	    $tmpid = $this->modelcontent->insertData($update_data,$tplinfo);
	    if($tmpid >0 && $update_data['url'] == ''){
	    	$tmp_url = $this->getUrl($siteid, $tplid, $tmpid, $tplinfo['url']);
	    	if($tmp_url!=''){
	    		$this->modelcontent->updateUrl($siteid,$tplid,$tmpid,$tmp_url);
	    	}
	    }
            Common::writeLog('operate.log',array(date('Y-m-d H:i:s'),$this->session->userdata('realname'), $siteid, $tplid,'add'));
	    header('Location: /content?siteid='.$siteid.'&tplid='.$tplid);
	    exit;
	}
	$siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
	$tplid = isset($_GET['tplid'])?intval($_GET['tplid']):0;
	
	//获得模板信息
	$tplinfo = $this->modeltemplate->getData($siteid,$tplid);
	if($tplinfo['id']==0){
	    header('Location: /content?siteid='.$siteid.'&tplid='.$tplid);
	    exit;
	}
	
	//取得模板域列表
	$tmp_fieldlist = $this->modelfield->getFields($siteid,$tplid);
	$fieldlist = array();
	foreach($tmp_fieldlist as $item){
               if($item['fieldtype'] == 5 || $item['fieldtype'] == 12){
			$item['rules'] = json_decode($item['rules'],true);
		}
		$fieldlist[] = $item;
	}
	$contentinfo = array('id'=>0,'siteid'=>$siteid,'templateid'=>$tplid,'otype'=>'UTF-8','url'=>'');
	foreach ($fieldlist as $field){
	    $contentinfo['field_'.$field['id']] = '';
	}
	
	if($siteid == 4){
	    $uptype = 'fk_res';
	}
	if($siteid == 6){
		$uptype = 'vivo_res';
	}
	
	if($siteid == 11){
		$uptype = 'pjgame_res';
	}
	//$this->act_verify = 'CONTENT_LIST';
        //$this->checkCurrentAction();
        $data = array(
            'title'=>'内容管理',
            'subtitle'=>'内容添加',
	    'siteid'=>$siteid,
	    'tplid'=>$tplid,
	    'tplinfo'=>$tplinfo,
	    'fieldlist'=>$fieldlist,
	    'content'=>$contentinfo,
	    'imgurl'=>$this->ufile->ft_get_rooturl($uptype),
        );

	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/content/add.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');

    }
    
    

    //发布文档
    public function publish()
    {
    	set_time_limit(0);
    	error_reporting(E_ALL);
    	$autoreturn = '';
    	$uptype = 'news';
    	$auto = FALSE;
    	$mreturn = array('return'=>'');
    	if(isset($_GET['auto']) && $_GET['auto'] == 'true'){
    		$auto = TRUE;
    	}
    	if(!$auto){
    		$this->act_verify = 'CONTENT_PUBLISH';
    		$this->checkCurrentAction();
    	}
    	
    	$siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
    	$tplid = isset($_GET['tplid'])?intval($_GET['tplid']):0;
    	$id = isset($_GET['id'])?intval($_GET['id']):0;

    	if($siteid == 1){
    		$uptype = 'ly_www';
    	}
    	if($siteid == 2){
    		$uptype = 'ly_wap';
    	}
    	if($siteid == 3){
    		$uptype = 'jw_wap';
    	}    	 
    	//先更新发布时间和发布人
    	if(!$auto)
    	{
    		$publiser = $this->session->userdata('realname');
    	}
    	else {
    		$publiser = 'system';
    	}
    	$update_data = array('siteid'=>$siteid,'tplid'=>$tplid,'id'=>$id,'publisher'=>$publiser);
    	$this->modelcontent->updatePublish($update_data);
    	 
    	//取得发布内容
    	$result  = $this->_getContent($siteid, $tplid, $id);
    	
    	//没有找到模板
    	if($result['result']==1){
    		if(!$auto){
    			header('Location: /content?siteid='.$siteid.'&tplid='.$tplid);
    			exit;
    		}
    		else {
    			$autoreturn = '没有templateid';
    			return $autoreturn;
    		}
    	}
    	
    	
		//没有找到内容
    	if($result['result'] ==2){
    		if(!$auto){
    			header('Location: /content?siteid='.$siteid.'&tplid='.$tplid);
    			exit;
    		}
    		else{
    			$autoreturn = '没有contentid';
    			return $autoreturn;
    		}
    	}
    	
    	
    	
    	$content = $result['content'];
    	$publishname = $result['filename'];
    	if($publishname!='' && $content!='')
    	{
    		//生成文件路径
	    	$rootpath = $this->ufile->ft_get_root($uptype);
	    	$filename = $rootpath.'/'.$publishname;
	    	$filepath = dirname($filename);
	    	if(!is_dir($filepath)){
	    		mkdir($filepath,0755,true);
	    	}
	    	//发布前 复制一份
	    	/*
                if(is_file($filename)){
                    $copy_filename = $filename .'.' .date('Y_m_d_H_i_s');
                    copy($filename, $copy_filename);
                }
             */
	    	//生成文件
	    	if(FALSE !== file_put_contents($filename, $content))
	    	{
	    	  
	    		//同步到生产机并发布到CDN
	    		Common::debug($uptype,'uptype');
	    		$result = $this->ufile->ft_rsync($filename,$uptype,$auto);
	    		//$result2 = $this->ufile->ft_to_cdn($filename,$uptype,$auto);
	    		echo $result;
	    		//echo $result2;
	    		if($auto){
	    			$autoreturn = $result;
	    		}
	    		else{
	    			$mreturn['return'] = '文件建立成功<br/>';
	    			$mreturn['return'].=$result['return'];
	    		}
	    	}
	    	else{
	    		if($auto){
	    			$autoreturn = 'create file failed ';
	    		}
	    		else{
	    			$mreturn['return'] = 'create file failed<br/>';
	    		}
	    	}
    	}
    	else{
    		   if($auto){
	    			$autoreturn = 'no content ';
	    		}
	    		else{
	    			$mreturn['return'] = '文档无内容<br/>';
	    		}
    	}
    	if(!$auto){
    		echo $mreturn['return'];
    		echo '<a href="/content?siteid='.$siteid.'&tplid='.$tplid.'">返回</a>';
    	}
    	else{
    		return $autoreturn;
    	}
    
    }    
    
    
    //取得文档内容
    private function _getContent($siteid,$tplid,$id){
    	$mreturn = array('result'=>0,'filename'=>'','content'=>'');
    	//取得模板信息
    	$tplinfo = $this->modeltemplate->getData($siteid,$tplid);
    	if($tplinfo['id']!=0){
    		
    		//取得域列表
    		$fieldlist = $this->modelfield->getFields($siteid,$tplid);
    		 
    		//取得发布内容
    		$contentinfo = $this->modelcontent->getData($siteid,$tplid,$id);
    		if($contentinfo['id'] !=0){
    			$content = $tplinfo['content'];
    			$search = array('${文档编号}','${模板编号}','${项目编号}','${创建者}','${创建时间}','${发布者}','${发布时间}');
    			$replace   = array($contentinfo['id'],$contentinfo['templateid'],$contentinfo['siteid'],$contentinfo['creater'],$contentinfo['createtime'],$contentinfo['publisher'],$contentinfo['publishtime']);
    			$c_array = array();
    			 
    			//替换模板参数
    			$search_rules=array();
    			$replace_rules=array();
    			foreach ($fieldlist as $key=>$item){
    				if($item['fieldtype'] != 9){
    					$search_rules[] = '${__'.$item['name'].'}';
    					$replace_rules[] = $contentinfo['field_'.$item['id']];
    				}
    			}
    			foreach ($fieldlist as $key=>$item){
    				$search[] = '${'.$item['name'].'}';
    				switch($item['fieldtype'] ){
    					case 9:
    						$tmp_rule = str_replace ( $search_rules , $replace_rules ,$item['rules'] );
    						$result =  $this->compile($tmp_rule,$siteid,$tplid,$id);
    						$replace[] = $result;
    						break;
    					default:
    						$replace[] = $contentinfo['field_'.$item['id']];
    				}
    			}
    			$content = str_replace ( $search , $replace ,$content );
    			 
    			//输出字符转换
    			if($contentinfo['otype']!='' && $contentinfo['otype'] !='UTF-8'){
				$content = iconv ('UTF-8' ,$contentinfo['otype'], $content );
				//$content = mb_convert_encoding ( $content , $contentinfo['otype'],'UTF-8');

    			}
    			$mreturn['filename'] = $contentinfo['url'];
    			$mreturn['content'] = $content;
    		}
    		else {
    			//没有找到文档
    			$mreturn['result'] = 2;
    		}
    		
    	}
    	else{
    		
    		//没有找到模板
    		$mreturn['result'] = 1;
    	}
    	return $mreturn;
    	
    }
    
    //预览文档
    public function preview(){
    	
        $this->act_verify = 'CONTENT_PUBLISH';
        $this->checkCurrentAction();
        
    	//取得基本信息
    	$tplid = isset($_GET['tplid'])?intval($_GET['tplid']):0;
    	$siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
    	$docid = isset($_GET['id'])?intval($_GET['id']):0;

    	
    	//取得文档内容
    	$result = $this->_getContent($siteid, $tplid, $docid);
    	if(isset($result['content']) && $result['content']!=''){
    		echo $result['content'];
    	}
    	else{
    		echo '没有内容输出';
    	}

    }
    
    
    //获取URL
	public function getUrl($siteid,$tplid,$id,$oraurl){
		
		//取得模板信息
		$tplinfo = $this->modeltemplate->getData($siteid,$tplid);
		
		//取得文档信息
		$contentinfo = $this->modelcontent->getData($siteid,$tplid,$id);
		
		//取得域列表
		$fieldlist = $this->modelfield->getFields($siteid,$tplid);
		
		//初始化替换数组
		$search = array('${文档编号}','${模板编号}','${项目编号}','${创建者}','${创建时间}','${发布者}','${发布时间}');
		$replace   = array($contentinfo['id'],$contentinfo['templateid'],$contentinfo['siteid'],$contentinfo['creater'],$contentinfo['createtime'],$contentinfo['publisher'],$contentinfo['publishtime']);
		foreach ($fieldlist as $key=>$item){
			if($item['fieldtype'] != 9){
				$search[] = '${'.$item['name'].'}';
				$replace[] = $contentinfo['field_'.$item['id']];
			}
		}
		return str_replace($search, $replace, $oraurl)	;
		
	}
	
	//更改图片大小
	private function _resizeImg($name,$x,$y){
		if(file_exists($name) ){
			$image = new Imagick($name);
			$result = $image->resizeimage( $x, $y,  imagick::FILTER_LANCZOS, 1, FALSE);
			if($result){
				$image->writeImage($name);
			}
		}
	}
	
	//文件上传
    public function uploadfile($file,$type='img',$imgX=0,$imgY=0)
    {
	$return = array('filename'=>'','result'=>'');
	
	
	//取得目录
	$dirname = $this->ufile->ft_get_dir($type);
	if(isset($file['tmp_name']))
	{
		
		//初始化
	    $mrand = rand(1000,9999);
	    $mext = strtolower($this->ufile->ft_get_ext($file['name']));
	    $newfilename = time().$mrand.'.'.$mext;
	    $newfilepath = $dirname.'/upload/'.date('md').'/';
	    
	    //建立目录
	    $this->ufile->ft_create_alldir($newfilepath);

	    //移动文件
	    $result = move_uploaded_file($file['tmp_name'], $newfilepath.$newfilename);
	    if($result === TRUE){
	    	if($imgX>0 && $imgY>0){
	    		
	    		//修改图片大小
	    		$this->_resizeImg($newfilepath.$newfilename, $imgX, $imgY);
	    	}
	    	
	    	//同步到生产机，CDN
			$return['result'] = $this->ufile->ft_rsync($newfilepath.$newfilename,$type);
			$return['filename'] = $newfilepath.$newfilename;
	    }
	    else{
		$return['result'] = 'move uploadfile failid ';
	    }
	}
	else{
	    $return['result'] = 'uploadfile failid ';
	}
		
	return $return;
    }
    
    
    //取得域规则
    private function _getFieldIdRule($str){
    	$mreturn = array('X'=>0,'Y'=>0);
    	$mids = explode('_', $str);
    	$mid = 0;
    	if(isset($mids[1]) && $mids[1]>0){
    		$mid = intval($mids[1]);
    	}
    	$siteid = isset($_GET['siteid'])?$_GET['siteid']:0;
    	$templateid = isset($_GET['tplid'])?$_GET['tplid']:0;
    	if($mid>0){
    		
    		//取得域字段信息
    		$fieldinfo = $this->modelfield->getData($siteid,$templateid,$mid);
    		if($fieldinfo['rules']!='' && $fieldinfo['fieldtype'] == 6){
    			$tmp_arr = explode(',', $fieldinfo['rules']);
    			if(isset($tmp_arr[0]) && isset($tmp_arr[1])){
    				$mreturn['X'] = intval($tmp_arr[0]);
    				$mreturn['Y'] = intval($tmp_arr[1]);
    			}
    		}
    	}
    	return $mreturn;
    		 
    }
    
    
    //编辑文档
    public function edit()
    {
	$uptype = 'img';
	//检查权限
	$this->act_verify = 'CONTENT_EDIT';
    $this->checkCurrentAction();
    
    //保存文档
	if(isset($_POST['submit'])){
	    $siteid = intval($_POST['siteid']);
	    if($siteid == 4){
		$uptype = 'fk_res';
	    }
		if($siteid == 6){
		$uptype = 'vivo_res';
	    }	   
	    if($siteid == 11){
	    	$uptype = 'pjgame_res';
	    } 
	    $tplid = intval($_POST['tplid']);
	    $update_data = $_POST;

	    
	    //处理文件上传
	    foreach($_FILES as $key=>$value){
	    	$msize = $this->_getFieldIdRule($key);
			$result = $this->uploadfile($value,$uptype,$msize['X'],$msize['Y']);
			if($result['filename']!=''){
			    $update_data[$key] = str_replace($this->ufile->ft_get_root($uptype), '',$result['filename']);
			}
	    }
	    
	    //取得模板信息
	    $tplinfo=$this->modeltemplate->getData($siteid,$tplid);
	    $id = intval($_POST['id']);
	    $this->modelcontent->updateData($update_data);
	    
	    //取得发布URL
	    $tmpurl = $this->getUrl($siteid, $tplid, $id, $tplinfo['url']);
	    if($update_data['url']==''){
			$update_data['url'] = $tmpurl;
	    }
	    else{
	    	if($_POST['url'] !=$tmpurl)
	    	{
	    		//判断是否有权限修改发布URL
		    	$this->act_verify = 'CONTENT_URL_EDIT';
		    	$this->checkCurrentAction();
		    	$update_data['url'] = $_POST['url'];
	    	}
	    }
	    $this->modelcontent->updateData($update_data);
            //加 log   
            Common::writeLog('operate.log',array(date('Y-m-d H:i:s'),$this->session->userdata('realname'), $siteid, $tplid, $id,'edit'));
	    
            header('Location: /content?siteid='.$siteid.'&tplid='.$tplid);
	    exit;
	}
	$siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
	$tplid = isset($_GET['tplid'])?intval($_GET['tplid']):0;
	$id = isset($_GET['id'])?intval($_GET['id']):0;
	
	
	//取得模板信息
	$tplinfo = $this->modeltemplate->getData($siteid,$tplid);
	if($tplinfo['id']==0){
	    header('Location: /content?siteid='.$siteid.'&tplid='.$tplid);
	    exit;
	}
        	
	//取得文档信息
	$contentinfo = $this->modelcontent->getData($siteid,$tplid,$id);
	
	//取得域列表
	$tmp_fieldlist = $this->modelfield->getFields($siteid,$tplid);
        $fieldlist = array();$flag=0;
	foreach($tmp_fieldlist as $item){
		if($item['fieldtype'] == 5 || $item['fieldtype'] == 12){
			$item['rules'] = json_decode($item['rules'],true);
                        if($item['fieldtype'] == 12) {
                            $field_key = 'field_'.$item['id'];
                            $flag = $contentinfo[$field_key];
                        }
		}
                if($item['fieldtype'] == 13 && $flag !== 0){
                      $arr_c =  json_decode($item['rules'],true);
                      $item['rules'] = $arr_c[0][$flag];
                }
                
		$fieldlist[] = $item;
	}
       if($siteid==2 && $tplid==1063) {
	//print_r($contentinfo);
	//print_r($fieldlist);
	}
	if($contentinfo['id'] ==0){
	    header('Location: /content?siteid='.$siteid.'&tplid='.$tplid);
	    exit;
	}
	
	if($siteid == 4){
	    $uptype = 'fk_res';
	}
    if($siteid == 6){
		$uptype = 'vivo_res';
	}	
	if($siteid == 11){
		$uptype = 'pjgame_res';
	}    
	//$this->act_verify = 'CONTENT_LIST';
        //$this->checkCurrentAction();
        $data = array(
            'title'=>'内容管理',
            'subtitle'=>'内容编辑',
	    'siteid'=>$siteid,
	    'tplid'=>$tplid,
	    'tplinfo'=>$tplinfo,
	    'fieldlist'=>$fieldlist,
	    'content'=>$contentinfo,
	    'imgurl'=>$this->ufile->ft_get_rooturl($uptype),
        );
        
	$this->smarty->assign('data',$data);
	$main = $this->smarty->fetch('cms/content/add.html');

	$this->smarty->assign('content',$main);
	$this->smarty->display('cms/content.html');

    }
    
    function delete($id)
    {
    	$siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
    	$tplid = isset($_GET['tplid'])?intval($_GET['tplid']):0;
    	$id = isset($_GET['id'])?intval($_GET['id']):0;
    	$this->modelcontent->deleteData($siteid,$tplid,$id);
    	header('Location: /content?siteid='.$siteid.'&tplid='.$tplid);
    	exit;
    }
    
    function getajax(){
        $siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
    	$tplid = isset($_GET['tplid'])?intval($_GET['tplid']):0;
    	$id = isset($_GET['id'])?intval($_GET['id']):0;
        $tmp_fieldlist = $this->modelfield->getFields($siteid,$tplid);
        $fieldlist = array();
	foreach($tmp_fieldlist as $item){
		if($item['fieldtype'] == 13){
			$rules= json_decode($item['rules'],true);
                        $fieldlist[] = $rules[0];
		}
		
	}
        echo isset($fieldlist[0][$id]) && !empty($fieldlist[0][$id]) ? json_encode($fieldlist[0][$id]) : 0;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */