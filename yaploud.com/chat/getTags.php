<?php

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
if (!isset($_SESSION['logged'])) session_start();
    
ob_start();
require("common/nocache.php");
require("util.inc");
require("tags/Tags.inc");

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' || 
    $_SERVER['REQUEST_METHOD'] == 'GET' &&
    isset($_REQUEST['url']) ) {
        
    $url = $_REQUEST['url'];
    
    $t = new Tags();
    $tags = $t->getTags($url);
    $js['tags'] = $tags;
    
    print json_encode($js);
}
else {
    print json_encode(false);
}

?>
