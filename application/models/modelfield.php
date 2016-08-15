<?php

define('KS_CLASS_MODELFIELD', '');
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

class ModelField extends CI_Model
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
	    return TRUE;
	}
	else
	{
	    echo '无此CMS站点';
	    exit;
	}
    }
    public function getFieldtype()
    {
	$mreturn =  array(
	    array('id'=>1,'name'=>'单行文本框'),
	    array('id'=>2,'name'=>'多行文本框'),
	    array('id'=>9,'name'=>'SQL结果集'),
            array('id'=>3,'name'=>'HTML编辑器'),
	    array('id'=>4,'name'=>'专题编辑器'),
		array('id'=>14,'name'=>'福利专题编辑器' ),
	    array('id'=>5,'name'=>'单选框'),
	    array('id'=>6,'name'=>'图片文件(上传框)'),
	    //array('id'=>7,'name'=>'视频文件(上传框)'),
	    //array('id'=>8,'name'=>'跨项目发布'),
	    //array('id'=>10,'name'=>'自定义程序'),
            array('id'=>11,'name'=>'INT类型'),
            array('id'=>12,'name'=>'关联单选框主'),
            array('id'=>13,'name'=>'关联单选框从'),
	);
	return $mreturn;
    }
    public function getAllFields($siteid,$templateid)
    {
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$tablename_tpl = 'cms_t_'.$templateid;
	if(!$db->table_exists($tablename_tpl)){
	    echo $tablename_tpl.'不存在';
	    exit;
	}
	$tablename_field = 'cms_f_'.$templateid;
	if(!$db->table_exists($tablename_field)){
	    echo $tablename_field.'不存在';
	    exit;
	}
	$sql = "SELECT `id`,`name`,`fieldtype`,`rules`,`isdisplay`,`status`,`morder` FROM `".$tablename_field."` ORDER BY `morder`";
	$query = $db->query($sql);
	return $query->result_array();
    }
    public function getFields($siteid,$templateid)
    {
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$tablename_tpl = 'cms_t_'.$templateid;
	if(!$db->table_exists($tablename_tpl)){
	    echo $tablename_tpl.'不存在';
	    exit;
	}
	$tablename_field = 'cms_f_'.$templateid;
	if(!$db->table_exists($tablename_field)){
	    echo $tablename_field.'不存在';
	    exit;
	}
	$sql = "SELECT `id`,`name`,`fieldtype`,`rules`,`isdisplay`,`status`,`morder` FROM `".$tablename_field."` WHERE `status`='2' ORDER BY `morder`";
	$query = $db->query($sql);
	return $query->result_array();
    }
    
    public function getUsingFields($siteid,$templateid)
    {
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$tablename_tpl = 'cms_t_'.$templateid;
	if(!$db->table_exists($tablename_tpl)){
	    echo $tablename_tpl.'不存在';
	    exit;
	}
	$tablename_field = 'cms_f_'.$templateid;
	if(!$db->table_exists($tablename_field)){
	    echo $tablename_field.'不存在';
	    exit;
	}
	//$sql = "SELECT `id`,`name` FROM `".$tablename_field."` WHERE `status`='2' AND fieldtype NOT IN ('8','9','10')";
	$sql = "SELECT `id`,`name` FROM `".$tablename_field."` WHERE `status`='2'  ORDER BY `morder`";
	$query = $db->query($sql);
	return $query->result_array();
    }
    
    public function getData($siteid,$templateid,$id)
    {
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$sql = "SELECT `id`,`name`,`fieldtype`,`rules`,`status`,`isdisplay`,`mem`,`promote`,`morder` FROM `cms_f_".$templateid."` WHERE id =?";
	$data[] = $id;
	$query = $db->query($sql,$data);
	return $query->row_array();
    }
    public function getDisplayFields($siteid,$templateid){
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$tablename_tpl = 'cms_t_'.$templateid;
	if(!$db->table_exists($tablename_tpl)){
	    echo $tablename_tpl.'不存在';
	    exit;
	}
	$tablename_field = 'cms_f_'.$templateid;
	if(!$db->table_exists($tablename_field)){
	    echo $tablename_field.'不存在';
	    exit;
	}
	$sql = "SELECT `id`,`name` FROM `".$tablename_field."` WHERE `isdisplay`='2'  ORDER BY `morder`";
	$query = $db->query($sql);
	return $query->result_array();
    }
    public function insertData($data){
	$siteid = intval($data['siteid']);
	$tplid = intval($data['tplid']);
	$tablename = 'cms_f_'.$tplid;
	$sql = "INSERT INTO `".$tablename."` VALUES (NULL,?,?,?,?,?,?,?,?)";
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$mdata[] = $data['name'];
	$mdata[] = intval($data['fieldtype']);
	$mdata[] = intval($data['status']);
	$mdata[] = $data['rules'];
	$mdata[] = $data['promote'];
	$mdata[] = $data['isdisplay'];
	$mdata[] = $data['mem'];
	$mdata[] = $data['morder'];
	
	$query = $db->query($sql,$mdata);
	if($query == 1)
	{
	    $insertid = $db->insert_id();
	    echo $insertid;
	    
	    if($insertid>0){
		$this->_addField($siteid,$tplid,$insertid,intval($data['fieldtype']));
	    }
	    return TRUE;
	}
	return FALSE;
	
    }
    
    public function updateData($data)
    {
	$siteid = intval($data['siteid']);
	$tplid = intval($data['tplid']);
	$id = intval($data['id']);
	$filedtype = intval($data['fieldtype']);
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$sql = "UPDATE `cms_f_".$tplid."` SET `name`=? ,`fieldtype`=?,`rules`=?,`status`=?,`mem`=?,`isdisplay`=?,`promote`=?,`morder`=? WHERE `id`=?";
	$mdata[] = $data['name'];
	$mdata[] = $filedtype;
	$mdata[] = $data['rules'];
	$mdata[] = $data['status'];
	$mdata[] = $data['mem'];
	$mdata[] = $data['isdisplay'];
	$mdata[] = $data['promote'];
	$mdata[] = $data['morder'];
	$mdata[] = $id;
	if($_GET['debug'] == 1){
		echo $sql;
		print_r($mdata);
		exit;
	}
	$query = $db->query($sql,$mdata);
	if($query == 1)
	{
	    $this->_alterField($siteid, $tplid, $id, $filedtype);
	    return TRUE;
	}
	return FALSE;
    }
    
    private function _addField($siteid,$templateid,$fieldid,$filedtype)
    {
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$tablename = 'cms_t_'.$templateid;
	$fieldname = 'field_'.$fieldid;
	if(!$db->table_exists($tablename)){
	    return FALSE;
	}
	echo $filedtype.'<br/>';
	$addsql = $this->_getFieldSql($filedtype);
	$sql = "ALTER TABLE `".$tablename."` ADD `".$fieldname."` ".$addsql;
	echo $sql;
	
	$query = $db->query($sql);
	if($query == 1){
	    return TRUE;
	}
	return FALSE;
    }
    
    private function _alterField($siteid,$templateid,$fieldid,$filedtype)
    {
	$db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
	$tablename = 'cms_t_'.$templateid;
	$fieldname = 'field_'.$fieldid;
	if(!$db->table_exists($tablename)){
	    return FALSE;
	}
	$addsql = $this->_getFieldSql($filedtype);
	$sql = "ALTER TABLE `".$tablename."` CHANGE `".$fieldname."` `".$fieldname."` ".$addsql;
	$query = $db->query($sql);
	if($query == 1){
	    return TRUE;
	}
	return FALSE;
    }
    
    private function _getFieldSql($type)
    {
	$mreturn = '';
	switch ($type){
	    case 1://单行文本框
		$mreturn = 'VARCHAR( 100 ) NOT NULL';
		break;
	    case 2://多行文本框
		$mreturn = 'LONGTEXT NOT NULL';
		break;
	    case 3://HTML编辑器
		$mreturn = 'LONGTEXT NOT NULL';
		break;
	    case 4://专题编辑器
		$mreturn = 'LONGTEXT NOT NULL';
	    case 14://福利专题编辑器
		$mreturn = 'LONGTEXT NOT NULL';
		break;
	    case 6://图片上传框
		$mreturn = 'VARCHAR( 100 ) NOT NULL';
		break;
	    case 9://SQL结果集
		$mreturn = 'INT NOT NULL';
	    case 11://排序
		$mreturn = 'INT NOT NULL';
	    default:
		$mreturn = 'INT NOT NULL';
	}
	return $mreturn;
    }
}
