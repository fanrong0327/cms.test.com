<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 资源管理
 */
class Resource extends MY_Controller
{

    private $_uptype;
    public function __construct()
    {
	parent::__construct();
	$this->load->library("UFile");
	$this->_uptype = 'cmyd';
	$this->loginCheck();
    }

    public function delete()
    {
    	$siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;

    	//取得上传目录信息
	if($this->ufile->ft_get_dir($this->_uptype) != $this->ufile->ft_get_root($this->_uptype)){
	    $updir = dirname($this->ufile->ft_get_dir($this->_uptype));
	    $updir = str_replace($this->ufile->ft_get_root($this->_uptype), '', $updir);
	}
	else
	{
	    $updir='';
	}
	
	$dir = $this->ufile->ft_get_dir($this->_uptype);
	if(is_dir($dir)) {
	    rmdir($dir);
	}
	if(is_file($dir)){
	    unlink($dir);
	}
	header("Location: /resource?siteid=".$siteid."&dir=".$updir);
	exit;
	
    }
    public function index()
    {
	$this->smarty->assign('noticemsg',0);
	$this->smarty->assign('noticemsg1','');
	if(!empty($_POST)){
		
		//添加资源
	    if($_POST['submit'] == '添加'){
		$dirname = $this->ufile->ft_get_dir($this->_uptype);
		if($_POST['name'] != '')
		{
		    $dirname.='/'.$_POST['name'];
            Common::debug($dirname);
		    if(!is_dir($dirname)){
			$result = mkdir($dirname);
			if($result === TRUE)
			{
			    $this->smarty->assign('noticemsg',4);
			}
			else{
			    $this->smarty->assign('noticemsg',5);
			}
		    }
		}
	    }
	    if($_POST['submit'] == '上传'){
		$dirname = $this->ufile->ft_get_dir($this->_uptype);

		if(isset($_FILES['file']['tmp_name']))
		{
			//上传文件处理
		    $mext = strtolower($this->ufile->ft_get_ext($_FILES['file']['name']));
		    
		    //zip文件解压缩处理
		    if($mext == 'zip' && $_POST['unzip'] == 'on'){
				$is_exist = FALSE;
				$ziplist = $this->ufile->ft_get_ziplist($_FILES['file']['tmp_name']);
				
				//判断zip文件里和当前目录是否有重名内容
				if(!empty($ziplist)){
				    $result = $this->ufile->ft_get_filelist($this->ufile->ft_get_dir($this->_uptype));
				    foreach($result as $item){
					if(in_array($item['name'], $ziplist))
					{
					    $is_exist = TRUE;
					    break;
					}
				    }
				}
				
				//不重名，解压
				if($is_exist===FALSE){
				    $result = $this->ufile->ft_unzip($_FILES['file']['tmp_name'],$dirname);
				    
				    $result = $this->ufile->ft_rsync($dirname,$this->_uptype);
	
				    $this->smarty->assign('noticemsg1',$result['return']);
				    $this->smarty->assign('noticemsg',1);
				}
				else{
				    echo 'file exist!';
				    exit;
				    $this->smarty->assign('noticemsg',2);
				}
		    }
		    else
		    {//不进行解压处理
				$result = move_uploaded_file($_FILES['file']['tmp_name'], $dirname.'/'.$_FILES['file']['name']);
				if($result === TRUE){
				    $result = $this->ufile->ft_rsync($dirname.'/'.$_FILES['file']['name'],$this->_uptype);
				    $this->smarty->assign('noticemsg1',$result['return']);
				    $this->smarty->assign('noticemsg',3);
				}
				else
				{
				    $this->smarty->assign('noticemsg',31);
				}
			
		    }
		    
		}
	    }
	}
	$siteid = isset($_GET['siteid'])?intval($_GET['siteid']):0;
	$dir = '';
	if(isset($_REQUEST['dir'])){
	    $dir = $_REQUEST['dir'];
	}
	
	//取得文件列表
	$result = $this->ufile->ft_get_filelist($this->ufile->ft_get_dir($this->_uptype));
	$lists = array();
	foreach($result as $item)
	{
	    if($item['type'] =='file'){
		$filename = $this->ufile->ft_get_dir($this->_uptype);
		$filename .= '/'.$item['name'];
		$filename=str_replace('//', '/', $filename);
		
		if(is_file($filename)){
		    $filename = str_replace($this->ufile->ft_get_root($this->_uptype), '', $filename);
		    $item['publishurl'] = $this->ufile->ft_get_rooturl($this->_uptype).$filename;
		}
	    }
	    else{
		$item['publishurl'] = '';
	    }
	    $lists[] = $item;
	}
	if($this->ufile->ft_get_dir($this->_uptype) != $this->ufile->ft_get_root($this->_uptype)){
	    $updir = dirname($this->ufile->ft_get_dir($this->_uptype));
	    $updir = str_replace($this->ufile->ft_get_root($this->_uptype), '', $updir);
	}
	else
	{
	    $updir='';
	}


	//$this->act_verify = 'FIELD_LIST';
	//$this->checkCurrentAction();
	$data = array(
	    'title' => '资源管理',
	    'subtitle' => '资源列表',
	    'siteid' => $siteid,
	    'dir'=>$dir,
	    'updir'=>$updir,
	    'lists' => $lists,
	);
	$this->smarty->assign('data', $data);
	$main = $this->smarty->fetch('cms/resource/index.html');

	$this->smarty->assign('content', $main);
	$this->smarty->display('cms/content.html');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */