<?php

define('KS_CLASS_MODELSITE', '');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * ------------------------------------------------------------
 * @CLASS    ModelSite     CMS站点数据操作类
 * ------------------------------------------------------------
 * @做成    马炳驰    2013-04-09    1.0
 * @变更
 * ------------------------------------------------------------
 */

class ModelSite extends CI_Model
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
    
    private function _existSite($siteid)
    {
        $mreturn = 0;
        $db = Common::getDbConnect('default', true);
        $sql = "SHOW DATABASES LIKE 'cms_".$siteid."'";
        $query = $db->query($sql);
        $query_array = $query->row_array();
        if(!empty($query_array))
        {
            $db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
            if($db->table_exists('cms_siteinfo'))
            {
            //存在CMS站点
            $mreturn = 1;
            }
            else
            {
            //数据库存在，cms_siteinfo表不存在
            $mreturn = 2;
            }
        }
        else
        {
            //数据库不存在
            $mreturn = 3;
        }
        return $mreturn;
    }

    private function _createDatabase($siteid)
    {
        $db = Common::getDbConnect('default', true);
        $sql = "CREATE DATABASE IF NOT EXISTS `cms_?`";
        $data[] = $siteid;
        $query = $db->query($sql,$data);
        if($query == 1){
            return TRUE;
        }
        return FALSE;
    }

    private function _createTable($siteid,$data)
    {
        $db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));

        $sql = "CREATE TABLE IF NOT EXISTS `cms_siteinfo` (
            `name` varchar(30) NOT NULL,
            `url` varchar(100) NOT NULL,
            `dbhost` varchar(20) NOT NULL,
            `dbport` int(11) NOT NULL,
            `dbuser` varchar(50) NOT NULL,
            `dbpass` varchar(50) NOT NULL,
            `isuse` int(11) NOT NULL,
            `ishide` int(11) NOT NULL
          ) DEFAULT CHARSET=utf8;";
        $query = $db->query($sql);
        if($query == 1){
            echo 'create table';
        }

        $sql = "INSERT INTO `cms_siteinfo` (`name`,`url`,`dbhost`,`dbport`,`dbuser`,`dbpass`,`isuse`,`ishide`) VALUES (?,?,?,?,?,?,?,?);";
        $mdata[] = $data['name'];
        $mdata[] = $data['url'];
        $mdata[] = $data['dbhost'];
        $mdata[] = $data['dbport'];
        $mdata[] = $data['dbuser'];
        $mdata[] = $data['dbpass'];
        $mdata[] = $data['isuse'];
        $mdata[] = $data['ishide'];

        $query = $db->query($sql,$mdata);
        if($query == 1){
            echo 'insert table';
        }
        return FALSE;
    }
    
    public function getSiteInfo($siteid)
    {
        if(!$this->_existSite($siteid)){
            echo 'database cms_'.$siteid.' does not exist';
            exit;
        }
        $dbname = 'cms_'.$siteid;
        $db = Common::getDbConnect('default', true,array('database'=>$dbname));
        if(!$db->table_exists('cms_siteinfo')){
            echo 'table cms_siteinfo does not exist';
            exit;
        }
        $sql = 'SELECT `name`,`url`,`dbhost`,`dbport`,`dbuser`,`dbpass`,`isuse`,`ishide` FROM `cms_siteinfo` LIMIT 1';
        $query = $db->query($sql);

            $siteinfo = $query->row_array();
            Common::debug($siteinfo, 'siteinfo');
        if($siteinfo['name']!=''){
            $siteinfo['id'] = $siteid;
        }
        return $siteinfo;
    }
    
    public function createSite($data)
    {
        $siteid = $this->_getMaxSiteId();
        $mreturn = $this->_existSite($siteid);
        switch($mreturn)
        {
            case 1:
            break;
            case 2:
            echo '存在同名数据库';
            break;
            case 3:
            $this->_createDatabase($siteid);
            $this->_createTable($siteid,$data);
            break;
        }
    }

    public function getSite()
    {
        $sitelist = array();
        $db = Common::getDbConnect('default', true);
        $sql = "show databases";
        $query = $db->query($sql);
        $query_array = $query->result_array();
        //$pattern = '/^cms_[\d]/';
        $pattern = '/^cms_[\d]*$/';
        foreach ($query_array as $item)
        {
            preg_match($pattern, $item['Database'], $matches);
            if(isset($matches[0]) && $matches[0]!=''){
                $db = Common::getDbConnect('default', true,array('database'=>$matches[0]));
                if($db->table_exists('cms_siteinfo')){
                    $sql = 'SELECT name FROM `cms_siteinfo` limit 1';
                    $query = $db->query($sql);
                    $siteinfo = $query->row_array();
                    $sitelist[] = array('id'=>intval(substr($matches[0],4)),'name'=>$siteinfo['name'],'dbname'=>$matches[0]);
                }
            }
        }
        Common::debug($sitelist, '$sitelist');
        return $sitelist;
    }
    
    private function _getMaxSiteId()
    {
        $maxid = 0;
        $db = Common::getDbConnect('default', true);
        $sql = "show databases";
        $query = $db->query($sql);
        $query_array = $query->result_array();
        $pattern = '/^cms_[\d]/';
        foreach ($query_array as $item){
            preg_match($pattern, $item['Database'], $matches);
            if(isset($matches[0]) && $matches[0]!=''){
            if(intval(substr($matches[0],4) > $maxid)){
                $maxid = intval(substr($matches[0],4));
            }
            }
        }
        $maxid = $maxid + 1;
        return $maxid;
    }

    public function updateData($data)
    {
        $siteid = $data['id'];
        if(!$this->_existSite($siteid)){
            echo 'db does not exist';
            exit;
        }
        $db = Common::getDbConnect('default', true,array('database'=>'cms_'.$siteid));
        $sql = "UPDATE `cms_siteinfo` SET `name`=?,`url`=?,`dbhost`=?,`dbport`=?,`dbuser`=?,`dbpass`=?,`isuse`=?,`ishide`=?";
        $mdata[] = $data['name'];
        $mdata[] = $data['url'];
        $mdata[] = $data['dbhost'];
        $mdata[] = $data['dbport'];
        $mdata[] = $data['dbuser'];
        $mdata[] = $data['dbpass'];
        $mdata[] = $data['isuse'];
        $mdata[] = $data['ishide'];
        $query = $db->query($sql,$mdata);
        if($query == 1)
        {
            return TRUE;
        }
        return FALSE;
    }

}
