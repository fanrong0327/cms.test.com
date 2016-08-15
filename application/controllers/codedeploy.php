<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Codedeploy extends MY_Controller {
	private $svn_root_dir = NULL;
	public function __construct()
	{
		parent::__construct();
		$this->loginCheck();

        //加载代码发布路径
        $this->config->load('codedeploy/config');
        $this->svn_root_dir = $this->config->item('code_root_dir');
	}
    public function admin() {
    	$this->act_verify = 'CODE_DEPLOY_ADMIN';
    	$this->checkCurrentAction();

        $data = $this->getFiles();
        $data['right'] = array('externalProduction'=>'外部生产机','externalTest'=>'外部测试机','innerTest'=>'内部测试机');
        //print_r($data);exit;
        $this->load->view('code_manager', $data);
    }
    public function test() {
    	$this->act_verify = 'CODE_DEPLOY_TEST';
    	$this->checkCurrentAction();
    
    	$data = $this->getFiles();
        $data['right'] = array('externalTest'=>'外部测试机','innerTest'=>'内部测试机');
    	$this->load->view('code_manager', $data);
    }
    
    /**
      点击目录的时候 ajax 加载下级目录
     */
    function loadFiles() {
        $data = $this->getFiles();
//        var_export($data);exit;
        $html = '';
        foreach ($data['dirs'] as $key => $val) {
            if ($key === 0)
                $key = '';

            $html .= '<option value="' . $key . '">' . $val['files'] . '</option>';
        }
        foreach ($data['files'] as $key => $val) {
            $html .= '<option value="' . $key . '">' . $val['files'] . '</option>';
        }
        echo $html;
    }

    /**

      获取目录   项目根目录为/data/svncheckout
     */
    public function getFiles() {
        $data = array();
        $root = $this->svn_root_dir;
        $up = array(); //上一级目录
        $get = $this->input->get();
        if (isset($get['activepath'])) {
            $activepath = $get['activepath'];
        }
        else {
            $activepath = '';
        }
        $inpath = "";
        $activepath = str_replace("..", "", $activepath);
        $activepath = preg_replace("#^\/{1,}#", "/", $activepath);

        if ($activepath == "") {
            $inpath = $root;
        }
        else {
            $inpath = $root . $activepath;
        }

        if (!is_dir($inpath)) {
            die('publish dir not exist!');
        }

        $dh = dir($inpath);

        $files = $dirs = array();

        //付晓君添加排序处理
        $files_arr = array();
        while (($file = $dh->read()) !== false) {
            $files_arr[] = $file;
        }
        $dh->close();
        asort($files_arr, SORT_STRING);
        //付晓君添加排序处理结束

        foreach ($files_arr as $file) {
            if ($file == ".") {
                continue;
            }
            else if ($file == "..") {
                if ($activepath == "") {
                    continue;
                }
                $tmp = preg_replace("#[\/][^\/]*$#i", "", $activepath);

                $up["$tmp"]['files'] = '..';
            }
            else if (is_dir("$inpath/$file")) {
                if (preg_match("#^_(.*)$#i", $file))
                    continue;#屏蔽FrontPage扩展目录和linux隐蔽目录
                if (preg_match("#^\.(.*)$#i", $file))
                    continue;
                $dirs["$activepath/$file"]['files'] = $file;
            }else {
                $files["$activepath/$file"]['files'] = $file;
            }
        }


        $dirs = array_merge($up, $dirs);

        $data['dirs'] = $dirs;
        $data['files'] = $files;

        return $data;
    }


}


