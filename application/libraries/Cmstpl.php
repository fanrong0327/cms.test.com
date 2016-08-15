<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
define("TAG_SQL", "/*TAG_SQL*/");
define("TAG_CGI", "/*TAG_CGI*/");
define("TAG_HTML", "/*TAG_HTML*/");
$_sqlCode = '';
$_cgiCode = '';

/**
 * Common Class
 *
 * @Copyright
 * @author
 */
class Cmstpl
{

    private function gettpl(){
	$filename = dirname(BASEPATH).'/'.APPPATH.'data/cmsfield.tpl';
	if(file_exists($filename)){
	    $this->htmlOutPut = file_get_contents($filename);
	}
    }
    
    public function compile($rules)
    {
	$this->gettpl();
	$sqlpos = strpos($rules, '[SQL]');
	$cgipos = strpos($rules, '[CGI]');
	$htmlpos = strpos($rules, '[HTML]');
	$sql = '';
	$cgi = '';
	$html ='';
	if($sqlpos !== FALSE){
	    $sql = substr($rules,$sqlpos + 5,$cgipos-5);
	    $this->htmlOutPut = str_replace(TAG_SQL, $sql, $this->htmlOutPut);
	    //$this->compile($sql, 'SQL');
	}
	if($cgipos !== FALSE){
	    $cgi = substr($rules,$cgipos + 5,$htmlpos-$cgipos-5);
	    $this->htmlOutPut = str_replace(TAG_CGI, $cgi, $this->htmlOutPut);
	    //$this->compile($cgi, 'CGI');
	    
	}
	if($htmlpos !== FALSE){
	    $html = substr($rules,$htmlpos + 6);
	    $html = str_replace("'","\'",$html);
	    $this->htmlOutPut = str_replace(TAG_HTML, $html, $this->htmlOutPut);
	    //$this->compile($html, 'HTML');
	    $this->htmlOutPut = eval($this->htmlOutPut);
	    $this->htmlOutPut = str_replace("\'","'",$this->htmlOutPut);
	}
	return $this->htmlOutPut;
    }

}

// END Common Class

/* End of file Common.php */
/* Location: ./application/libraries/Common.php */