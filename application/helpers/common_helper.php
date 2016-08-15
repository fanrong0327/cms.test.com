<?php
function isLegalId($id)
{
    $id = (int) $id;
    if ( $id < 1 ) {
        exit('参数非法');
    }
    else {
        return $id;
    }
}

function listActionIcon()
{
    $result = array();
    $CI = & get_instance();
    $icon_dir = realpath($CI->config->item('icon_directory'));
    $dh = opendir($icon_dir);
    while ( ($file = readdir($dh)) !== false ) {
        if ( $file != '.' && $file != '..' && $file != '.DS_Store' ) {
            $result[] = $file;
        }
    }
    closedir($dh);
    return $result;
}


?>
