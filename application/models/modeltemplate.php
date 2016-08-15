<?php

define('KS_CLASS_MODELTEMPLATE', '');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * ------------------------------------------------------------
 * @CLASS    ModelTemplate     CMS站点数据操作类
 * ------------------------------------------------------------
 * @做成    马炳驰    2013-04-09    1.0
 * @变更
 * ------------------------------------------------------------
 */

class ModelTemplate extends CI_Model
{
    /*
     * ------------------------------------------------------------
     * @function        __construct      初始化函数
     * ------------------------------------------------------------
     * @做成    马炳驰    2013-04-09    1.0
     * ------------------------------------------------------------
     */
    function __construct()
    {
	parent::__construct();
    }
    private function _checkTable($siteid)
    {
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	if($db->table_exists('cms_siteinfo')){
	    if(!$db->table_exists('cms_template')){
		$sql = 'CREATE TABLE IF NOT EXISTS `cms_template` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(50) NOT NULL,
			`sortid` int(11) NOT NULL,
			`url` varchar(200) NOT NULL,
			`condition` text NOT NULL,
			`format` int(11) NOT NULL,
			`content` text NOT NULL,
			PRIMARY KEY (`id`)
		      ) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1001 ;';
		$query = $db->query($sql);
		if($query == 1){
		    return TRUE;
		}
		else
		{
		    echo 'cannot create cms_template';
		    exit;
		}
	    }
	    else
	    {
		return TRUE;
	    }
	}
	else
	{
	    echo '无此CMS站点';
	    exit;
	}
    }
    
    private function _createTemplate($siteid,$templateid)
    {
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$tablename_tpl = 'cms_t_'.$templateid;
	$tablename_field = 'cms_f_'.$templateid;
	if($db->table_exists($tablename_tpl) && $db->table_exists($tablename_field)){
	    return FALSE;
	}
	
	$sql = "CREATE TABLE IF NOT EXISTS `".$tablename_tpl."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`siteid` int(11) NOT NULL,
			`templateid` int(11) NOT NULL,
			`otype` varchar(10) NOT NULL,
			`url` varchar(100) NOT NULL,
			`creater` varchar(20) NOT NULL,
			`createtime` datetime NOT NULL,
			`publisher` varchar(20) NOT NULL,
			`publishtime` datetime NOT NULL,
			PRIMARY KEY (`id`)
		      ) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
	
	$query = $db->query($sql);
	$sql = "CREATE TABLE IF NOT EXISTS `".$tablename_field."` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(50) NOT NULL,
		`fieldtype` int(11) NOT NULL,
		`status` int(11) NOT NULL,
		`rules` text NOT NULL,
		`promote` varchar(100) NOT NULL,
		`isdisplay` int(11) NOT NULL,
		`mem` varchar(200) NOT NULL,
		`morder` int(11) NOT NULL,
		PRIMARY KEY (`id`)
	      ) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
	
	$query = $db->query($sql);
	if($query == 1){
	    return TRUE;
	}
	return FALSE;
    }
    
    public function getTemplate($siteid)
    {
	if(!$this->_checkTable($siteid)){
	    echo 'cannot create cms_template';
	    exit;
	}
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$sql = "SELECT `id`,`name`,`condition`,`sortid` FROM `cms_template` ORDER BY sortid";
	$query = $db->query($sql);
	return $query->result_array();
    }
    public function getTemplateByName($siteid,$tplname)
    {
	if(!$this->_checkTable($siteid)){
	    echo 'cannot create cms_template';
	    exit;
	}
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$sql = "SELECT `id`,`name` FROM `cms_template` WHERE name =?";
	$data[] = $tplname;
	$query = $db->query($sql,$data);
	return $query->row_array();
    }
    public function insertData($data)
    {
	$siteid = intval($data['siteid']);
	$sql = "INSERT INTO `cms_template` (`name`,`sortid`) VALUES (?,?)";
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$mdata[] = $data['name'];
	$mdata[] = $data['sortid'];
	$query = $db->query($sql,$mdata);
	
	if($query == 1)
	{
	    $insertid = $db->insert_id();
	    if($insertid>0){
		$this->_createTemplate($siteid,$insertid);
	    }
	    return TRUE;
	}
	return FALSE;
    }
    
    public function updateDesignData($data)
    {

	$siteid = intval($data['siteid']);
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	
	$sql = "UPDATE `cms_template` SET `url`=? ,`format`=?,`condition`=?,`content`=? WHERE `id`=?";
	
	$mdata[] = $data['url'];
	$mdata[] = $data['format'];
	$mdata[] = $data['condition'];
	$mdata[] = $data['content'];
	$mdata[] = $data['id'];
	$query = $db->query($sql,$mdata);
	if($query == 1)
	{
	    return TRUE;
	}
	return FALSE;
    }
    
    public function updateData($data)
    {
	$siteid = intval($data['siteid']);
	$sql = "UPDATE `cms_template` SET `name`=? ,`sortid`=? WHERE `id`=?";
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$mdata[] = $data['name'];
	$mdata[] = $data['sortid'];
	$mdata[] = $data['id'];
	$query = $db->query($sql,$mdata);
	if($query == 1)
	{
	    return TRUE;
	}
	return FALSE;
    }
    public function getData($siteid,$templateid)
    {
	if(!$this->_checkTable($siteid)){
	    echo 'cannot create cms_template';
	    exit;
	}
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$sql = "SELECT `id`,`name`,`sortid`,`url`,`condition`,`format`,`content` FROM `cms_template` WHERE id =?";
	$data[] = $templateid;
	$query = $db->query($sql,$data);
	return $query->row_array();
    }

}
