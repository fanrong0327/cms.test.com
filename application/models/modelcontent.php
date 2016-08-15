<?php

define('KS_CLASS_MODELCONTENT', '');
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

class ModelContent extends CI_Model {
    /*
     * ------------------------------------------------------------
     * @function        __construct      初始化函数
     * ------------------------------------------------------------
     * @做成    马炳驰    2013-04-09    1.0
     * ------------------------------------------------------------
     */

    function __construct() {
        parent::__construct();
    }

    public function getList($siteid, $templateid, $addfields = '',$limit,$num,$seach='') {
        $db = Common::getDbConnect('default', true, array('database' => 'cms_' . $siteid));
        if (!$db->table_exists('cms_t_' . $templateid)) {
            echo 'cms_t_' . $templateid . ' does not exist';
            exit;
        }
        $sql = "SELECT `id`,`siteid`,`url`,`templateid`,`creater`,`createtime`,`publisher`,`publishtime`" . $addfields . " FROM `cms_t_" . $templateid . "` ".$seach."  ORDER BY id ASC  LIMIT $limit,$num";
        $query = $db->query($sql);
        return $query->result_array();
    }

    public function getListCount($siteid, $templateid, $addfields = '',$seach='') {
        $db = Common::getDbConnect('default', true, array('database' => 'cms_' . $siteid));
        if (!$db->table_exists('cms_t_' . $templateid)) {
            echo 'cms_t_' . $templateid . ' does not exist';
            exit;
        }
        $sql = "SELECT `id`,`siteid`,`url`,`templateid`,`creater`,`createtime`,`publisher`,`publishtime`" . $addfields . " FROM `cms_t_" . $templateid . "` ".$seach;
        $query = $db->query($sql);
        return $query->num_rows();
    }

    public function getData($siteid, $templateid, $id) {
        $db = Common::getDbConnect('default', true, array('database' => 'cms_' . $siteid));
        $sql = "SELECT * FROM `cms_t_" . $templateid . "` WHERE id =?";
        $data[] = $id;
        $query = $db->query($sql, $data);
        return $query->row_array();
    }

    public function insertData($data, $tplinfo) {
        $siteid = intval($data['siteid']);
        $tplid = intval($data['tplid']);

        $tablename = 'cms_t_' . $tplid;
        $db = Common::getDbConnect('default', true, array('database' => 'cms_' . $siteid));

        $insert_field = "`otype`,`siteid`,`templateid`,`creater`,`createtime`";
        $insert_value = "?,?,?,?,?";
        $mdata[] = $data['otype'];
        $mdata[] = $data['siteid'];
        $mdata[] = $data['tplid'];
        $mdata[] = 'admin';
        $mdata[] = date("Y-m-d H:i:s");

        foreach ($data as $key => $value) {
            if (substr($key, 0, 6) == 'field_') {
                $insert_field.= " ,`" . $key . "`";
                $insert_value.= ",?";
                $mdata[] = $value;
            }
        }
        $sql = "INSERT INTO `" . $tablename . "` (" . $insert_field . ") VALUES (" . $insert_value . ")";

        $query = $db->query($sql, $mdata);
        if ($query == 1) {
            $lastid = $db->insert_id();
            if ($lastid > 0) {
                return $lastid;
            }
        }
        return 0;
    }

    public function updateUrl($siteid, $tplid, $id, $url) {

        $db = Common::getDbConnect('default', true, array('database' => 'cms_' . $siteid));
        $sql = "UPDATE `cms_t_" . $tplid . "` SET `url`=?";
        $mdata[] = $url;

        $sql.= " WHERE `id`=?";
        $mdata[] = $id;

        $query = $db->query($sql, $mdata);
        if ($query == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public function updateData($data) {
        $siteid = intval($data['siteid']);
        $tplid = intval($data['tplid']);
        $id = intval($data['id']);
        $db = Common::getDbConnect('default', true, array('database' => 'cms_' . $siteid));
        $sql = "UPDATE `cms_t_" . $tplid . "` SET `otype`=? ,`url`=?"; //" WHERE `id`=?";
        $mdata[] = $data['otype'];
        $mdata[] = $data['url'];
        foreach ($data as $key => $value) {
            if (substr($key, 0, 6) == 'field_') {
                $sql.= " ,`" . $key . "`=?";
                $mdata[] = $value;
            }
        }
        $sql.= " WHERE `id`=?";
        $mdata[] = $id;
        $query = $db->query($sql, $mdata);
        if ($query == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public function updatePublish($data) {
        $siteid = intval($data['siteid']);
        $tplid = intval($data['tplid']);
        $id = intval($data['id']);
        $db = Common::getDbConnect('default', true, array('database' => 'cms_' . $siteid));
        $sql = "UPDATE `cms_t_" . $tplid . "` SET `publisher`=?,`publishtime`=?"; //" WHERE `id`=?";
        $mdata[] = $data['publisher'];
        $mdata[] = date('Y-m-d H:i:s');
        $sql.= " WHERE `id`=?";
        $mdata[] = $id;
        $query = $db->query($sql, $mdata);
        if ($query == 1) {
            return TRUE;
        }
        return FALSE;
    }

    //伍远红于2013-11-13添加deleteData方法
    public function deleteData($siteid, $tplid, $id) {

        $db = Common::getDbConnect('default', true, array('database' => 'cms_' .
                    $siteid));
        $sql = "delete from  `cms_t_" . $tplid . "`";

        $sql.= " WHERE `id`=?";
        $mdata[] = $id;

        $query = $db->query($sql, $mdata);
        if ($query == 1) {
            return TRUE;
        }
        return FALSE;
    }

}
