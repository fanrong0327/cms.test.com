<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Codedeployexec extends CI_Controller {
	private $svn_root_dir = NULL;
    private $publish_log_file = NULL;
	public function __construct()
	{
		parent::__construct();

        //加载代码发布路径
        $this->config->load('codedeploy/config');
        $this->svn_root_dir = $this->config->item('code_root_dir');
        $this->publish_log_file = $this->config->item('publish_log_file');
	}

    /**
     *
     * 执行部署命令
     */
    function execRsync() {
        $post = $this->input->post();
        $this->load->helper('file');
        $currentDirs = $post['currentDir'];

        $innerTest = $post['innerTest'];
        $externalTest = $post['externalTest'];
        $externalProduction = $post['externalProduction'];
        $result = '';

        $dir_count = 0;

        foreach ($currentDirs as $currentDir) {
            $file = $this->svn_root_dir . $currentDir;
            if (is_dir($file)) {
                $dir_count += 1;
            }
        }

        if ($dir_count < 2) {
            foreach ($currentDirs as $currentDir) {
                $currentDir = substr($currentDir, 1);
                $result.=self::execOneRsync($currentDir, $innerTest, $externalTest, $externalProduction);
            }
        }
        else{
            $result .= "你要小心了，不可同时选择多个目录，注意不要部署别人的代码 ！！！\n\n\n";
        }

        //保持原命令行格式输出
        echo "<pre>{$result}</pre>";
    }

    /**
     *
     * 执行部署命令
     */
    function execOneRsync($currentDir = '', $innerTest = 0, $externalTest = 0, $externalProduction = 0) {

        if ($innerTest == 0 && $externalTest == 0 && $externalProduction == 0) {
            $res = "参数错误！";
            return $res;
        }
        Common::debug("innerTest:$innerTest, $externalTest:externalTest, externalProduction:$externalProduction");

        $root = dirname(BASEPATH);
        //$logFile = $root . '/logs/push.log';
        $logFile = $this->publish_log_file;

        $post = $this->input->post();


        $this->load->helper('file');
        $cmd = '';
        $res = '';
        //内部测试机
        if ($innerTest == 1) {
            $cmd = $this->createCmd($currentDir, 'intra');
            Common::debug("currentDir:$currentDir, cmd:$cmd");
            $res .= $cmd . "\n";
            $res .= self::runCommand($cmd);
        }
        
        //外部测试机
        if ($externalTest == 1) {
            $cmd = $this->createCmd($currentDir, 'beta');
            $res .= $cmd . "\n";
            $res .= self::runCommand($cmd);
        }
        //外部生产机
        if ($externalProduction == 1) {
            $cmd = $this->createCmd($currentDir, 'release');
            $res .= $cmd . "\n";
            $res .= self::runCommand($cmd);
        }

        $content = date('Y-m-d H:i:s') . ' ' . $cmd . "\n";
        if (!write_file($logFile, $content, 'a+')) {
            echo 'Unable to write the file ' . $logFile;
        }

        return $res;
    }

    //生成命令
    function createCmd($currentDir, $type) {

        $file = '';
        $dirArr = explode('/', $currentDir);
        $cmd = '';

        if ($dirArr[0] == 'Common') {

            if (!isset($dirArr[0]) || !isset($dirArr[1])) {
                return FALSE;
            }
          
            $cmdFile = $this->rsyncConfig($dirArr[0], $dirArr[1], $type);
            unset($dirArr[0]);
            unset($dirArr[1]);
            $dir = implode('/', $dirArr);
            $file = array_pop($dirArr);
        
        }else if ($dirArr[0] == 'zhongheng') {
            if (!isset($dirArr[0]) || !isset($dirArr[1])) {
                return FALSE;
            }

            $cmdFile = $this->rsyncConfig($dirArr[0], $dirArr[1], $type);
            unset($dirArr[0]);
            unset($dirArr[1]);
            $dir = implode('/', $dirArr);
            $file = array_pop($dirArr);
        }else if ($dirArr[0] == 'fsbook') {
            if (!isset($dirArr[0]) || !isset($dirArr[1])) {
                return FALSE;
            }

            $cmdFile = $this->rsyncConfig($dirArr[0], $dirArr[1], $type);
            unset($dirArr[0]);
            unset($dirArr[1]);
            $dir = implode('/', $dirArr);
            $file = array_pop($dirArr);
        }else if ($dirArr[0] == 'lybook') {
            if (!isset($dirArr[0]) || !isset($dirArr[1])) {
                return FALSE;
            }

            $cmdFile = $this->rsyncConfig($dirArr[0], $dirArr[1], $type);
            unset($dirArr[0]);
            unset($dirArr[1]);
            $dir = implode('/', $dirArr);
            $file = array_pop($dirArr);
        }else if ($dirArr[0] == 'cmyd') {
            if (!isset($dirArr[0]) || !isset($dirArr[1])) {
                return FALSE;
            }

            $cmdFile = $this->rsyncConfig($dirArr[0], $dirArr[1], $type);
            unset($dirArr[0]);
            unset($dirArr[1]);
            $dir = implode('/', $dirArr);
            $file = array_pop($dirArr);
        }else{
        	Common::debug($dirArr,'dirArr');
        	if (!isset($dirArr[0]) || !isset($dirArr[1])) {
        		return FALSE;
        	}
        	$cmdFile = $this->rsyncConfig($dirArr[0], $dirArr[1], $type);
        	Common::debug($cmdFile,'cmdfile');
        	//unset($dirArr[0]);
        	//unset($dirArr[1]);
        	$dir = implode('/', $dirArr);
        	$file = array_pop($dirArr);
        }
        //$cmdFile = $this->rsyncConfig($dirArr[0], $dirArr[1], $type);
        //unset($dirArr[0]);
        //unset($dirArr[1]);
        //$dir = implode('/', $dirArr);
        //$file = array_pop($dirArr);
        if (stripos($file, '.') === false) {
            if (!empty($dir)) {
                $cmd = $cmdFile . ' ' . $dir . '/';
            }
        }
        else {
            $cmd = $cmdFile . ' ' . $dir;
        }

		echo $cmd;
        return $cmd;
    }

    /**
     *
     * 同步程序到 内部测试服务器，外部测试服务器， 生产机
     * @param string $site  // 域名
     * @param string $server   表明是 内部测试 ， 外部测试 , 还是生产机
     */
    function rsyncConfig($dir, $site, $server) {
    	$root = dirname(BASEPATH);

        return $root.'/shell/' . $dir . '/' . $server . '.' . $site . '.sh';
        //return $root.'/shell/' . $server . '.sh';
        
    }

    /**
     *
     * 运行命令的函数
     */
    function runCommand($cmd) {
        
        $cmd = $cmd . ' 2>&1';
        $handle = popen($cmd, 'r');
        $cmd_out = '';
        while (!feof($handle)) {
            $cmd_out .= fread($handle, 8192);
        }
        pclose($handle);

        return $cmd_out;
    }

}


