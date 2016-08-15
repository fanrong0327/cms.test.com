<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Common Class
 *
 * @Copyright
 * @author
 */
class UFile extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function ft_get_root($type = 'cmyd') {
        $return = '';
        switch ($type) {
            case 'cmyd':
                $return = '/data/test';
                break;
            case 'ly_www':
                $return = '/data/www/web/lybook/www.lingyun5.com';
                break;
            case 'ly_wap':
                $return = '/data/www/web/lybook/m.lingyun5.com';
                break;
            case 'jw_wap':
            	$return = '/data/www/web/zhongheng/zh.lingyun5.com';
            	break;
            default:
                $return = '/data/test';
        }
        return $return;
    }
    function ft_get_pub_root($type = 'cmyd') {
    	$return = '';
    	switch ($type) {
    		case 'ly_www':
    			$return = '/data/www/web/';
    			break;
    		case 'ly_wap':
    			$return = '/data/www/web/';
    			break;
    		case 'jw_wap':
    			$return = '/data/www/web/';
    			break;
    	}
    	return $return;
    }
    function ft_get_rooturl($type = 'cmyd') {
        $return = '';
        switch ($type) {
            case 'cmyd':
                $return = 'http://static.lingyun5.com';
                break;
            case 'ly_www':
                $return = 'http://www.lingyun5.com';
                break;
            case 'ly_wap':
                $return = 'http://m.lingyun5.com';
                break;
            case 'jw_wap':
                $return = 'http://lingyun.m1book.com';
                break;
            default:
                $return = 'http://static.lingyun5.com';
        }
        return $return;
    }

    function ft_get_ext($name) {
        if (strstr($name, ".")) {
            $ext = str_replace(".", "", strrchr($name, "."));
        } else {
            $ext = "";
        }
        return $ext;
    }

    function ft_create_alldir($dir) {
        $dir_array = explode("/", $dir);
        $DirName = "";
        for ($i = 0; $i < count($dir_array); $i++) {
            if ($dir_array[$i] != "") {
                $DirName .= "/" . $dir_array[$i];
                $tmp = is_dir($DirName);
                if (!$tmp) {
                    @mkdir($DirName, 0755, true);
                }
            }
        }
    }
    /*
    function ft_rsync($name, $type = 'img', $auto = FALSE) {
    	$autoreturn = '';
    	$mreturn = array('result' => 1, 'return' => '');
    
    	$mreturn['return'].='file sync success!<br/>';
    	if (!$auto) {
    		return $mreturn;
    	} else {
    		return $autoreturn;
    	}
    }
    */
    function ft_rsync($name, $type = 'img', $auto = FALSE) {
    	$autoreturn = '';
    	$mreturn = array('result' => 1, 'return' => '');
    
    	$tname = $name;
    	$command = '';
    	switch ($type) {
    		case 'ly_www':
    			$command = '/data/www/web/Common/cms.lingyun5.com/shell/lybook/release.www.lingyun5.com.sh ';
    			break;
    		case 'ly_wap':
    			$command = '/data/www/web/Common/cms.lingyun5.com/shell/lybook/release.m.lingyun5.com.sh ';
    			break;
    		case 'jw_wap':
    			$command = '/data/www/web/Common/cms.lingyun5.com/shell/zhongheng/release.zh.lingyun5.com.sh ';
    			break;
    	}
    
    	$command.=str_replace($this->ft_get_root($type) . '/', '', $name);
    	if (!$auto) {
    		echo $command . '<br/>';
    	}
    	echo $command;
    	$tresult = shell_exec($command);
    	$tresult = explode("\n", $tresult);
    	$mreturn['return'].='file sync success!<br/>';
    	foreach ($tresult as $item) {
    		$mreturn['return'].=$item . '<br/>';
    	}
    
    	if (!$auto) {
    		return $mreturn;
    	} else {
    		return $autoreturn;
    	}
    }
    function ft_rsync1($name, $type = 'img', $auto = FALSE) {
        $autoreturn = '';
        $mreturn = array('result' => 1, 'return' => '');

        $tname = $name;
        $command = '/data/www/web/Common/cms.lingyun5.com/shell/release.sh ';
        $pubroot = $this->ft_get_pub_root($type);
		if($pubroot != ''){
			$command.=str_replace($pubroot , '', $name);
	        if (!$auto) {
	            echo $command . '<br/>';
	        }
	        $tresult = shell_exec($command);
	        $tresult = explode("\n", $tresult);
	        $mreturn['return'].='file sync success!<br/>';
	        foreach ($tresult as $item) {
	            $mreturn['return'].=$item . '<br/>';
	        }
		}
        
        if (!$auto) {
            return $mreturn;
        } else {
            return $autoreturn;
        }
    }
    
	function ft_to_cdn($name, $type = 'cmyd', $auto = FALSE){
		if (file_exists($name)) {
			$url = str_replace($this->ft_get_root($type), $this->ft_get_rooturl($type), $name);
			$result = $this->ft_to_cdn_ks($url, 1,$type, $auto);
		} elseif (is_dir($name)) {
			$url = str_replace($this->ft_get_root($type), $this->ft_get_rooturl($type), $name);
			$result = $this->ft_to_cdn_ks($url, 0,$type, $auto);
		} else {
			$result = 'can not to cdn';
		}
		if ($auto) {
			$autoreturn = $result;
		}
		return $result . '<br/>';
	}
    function ft_to_cdn_ks($url, $type = 0,$source, $auto = FALSE) {//0为目录，1为文件
    	
        $autoreturn = '';
        $puburl = 'http://open.kanshu.com/cms/publish/ins?url=' . urlencode($url) . '&type=' . $type;
        if($source=='people_html' || $source=='fk_html' || $source == 'fk_res'){
        	$puburl = 'http://open.kanshu.com/cms/publish/ins?url=' . urlencode($url) . '&type=' . $type.'&source=lanxun';
        }
        $this->load->library("Http");
        $result = $this->http->get($puburl);
        $result = json_decode($result, true);

        if (isset($result['result']['status']['msg']) && $result['result']['status']['msg'] == 'succ') {
            $mreturn = 'CDN推送成功！<br/>';
            $autoreturn = 'success';
        } else {
            $mreturn = 'CDN推送失败，请重新发布！<br/>';
            $autoreturn = 'cdn failed';
        }
        if (!$auto) {
            return $mreturn;
        } else {
            return $autoreturn;
        }
    }

    function ft_get_filelist($dir, $sort = 'name') {
        $filelist = array();
        $subdirs = array();
        if ($dirlink = @opendir($dir)) {
            // Creates an array with all file names in current directory.
            while (($file = readdir($dirlink)) !== false) {
                if ($file != "." && $file != ".." && ((!is_dir("{$dir}/{$file}")) || is_dir("{$dir}/{$file}"))) { // Hide these two special cases and files and filetypes in blacklists.
                    $c = array();
                    $c['name'] = $file;
                    $c['type'] = "file";
                    //$c['ext'] = strtolower($this->ft_get_ext($file));
                    $c['size'] = @filesize("{$dir}/{$file}");
                    if (is_dir("{$dir}/{$file}")) {
                        $c['size'] = 0;
                        $c['type'] = "dir";
                        if ($sublink = @opendir("{$dir}/{$file}")) {
                            while (($current = readdir($sublink)) !== false) {
                                if ($current != "." && $current != "..") {
                                    $c['size'] ++;
                                }
                            }
                            closedir($sublink);
                        }
                        $subdirs[] = $c;
                    } else {
                        $filelist[] = $c;
                    }
                }
            }
            closedir($dirlink);

            $name = array();
            $size = array();
            foreach ($filelist as $key => $row) {
                $name[$key] = strtolower($row['name']);
                $size[$key] = $row['size'];
            }

            // Sort by file name.
            array_multisort($name, SORT_ASC, $filelist);
            // Always sort dirs by name.
            sort($subdirs);
            return array_merge($subdirs, $filelist);
        } else {
            return "dirfail";
        }
    }

    function ft_get_dir($type = 'img') {
        $mreturn = $this->ft_get_root($type);
        if (!empty($_REQUEST['dir'])) {
            if (substr($_REQUEST['dir'], 0, 1) != '/') {
                $mreturn = $mreturn . '/' . $_REQUEST['dir'];
            } elseif ($_REQUEST['dir'] != '/') {
                $mreturn = $this->ft_get_root($type) . $_REQUEST['dir'];
            }
        }
        return $mreturn;
    }

    function ft_unzip($file, $dir) {
        $mreturn = FALSE;
        $zip = new ZipArchive();
        $rs = $zip->open($file);
        if ($rs) {
            $mreturn = $zip->extractTo($dir);
            $zip->close();
        }
        return $mreturn;
    }

    function ft_get_ziplist($zipfile) {
        $mreturn = array();
        if (file_exists($zipfile)) {
            $zip = zip_open(realpath($zipfile));
            if (is_resource($zip)) {
                while ($zip_entry = zip_read($zip)) {
                    $tmpname = zip_entry_name($zip_entry);
                    $tmpname = rtrim($tmpname, '/');
                    $mreturn[] = $tmpname;
                }
                zip_close($zip);
            }
        }
        return $mreturn;
    }

}

// END Common Class

/* End of file Common.php */
/* Location: ./application/libraries/Common.php */