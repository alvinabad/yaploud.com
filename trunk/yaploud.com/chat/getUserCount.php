<?php

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
    
ob_start();
require("common/nocache.php");
require("chat/ChatRoom.inc");

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' || 
    $_SERVER['REQUEST_METHOD'] == 'GET' &&
    isset($_REQUEST['url']) ) {
        
    $url = $_REQUEST['url'];
    
    $cr = new ChatRoom();
    $yappers = sizeof( $cr->getUsers($url) );
    print $yappers;
}
else {
	print "0";
}

?>
