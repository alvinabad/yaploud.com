<?php

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
//if (!isset($_SESSION['logged'])) session_start();
    
ob_start();
require ("common/nocache.php");
require("./invite_friend.inc");

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' || 
    $_SERVER['REQUEST_METHOD'] == 'GET' &&
    isset($_SESSION['logged']) && 
    $_SESSION['logged'] && 
    isset($_REQUEST['email']) && 
    isset($_REQUEST['url']) && 
    isset($_REQUEST['msg']) ) {
        
       
    $email = $_REQUEST['email'];
    $message = $_REQUEST['msg'];
    $url = $_REQUEST['url'];
    $username = $_SESSION['username'];
    
    $js['email'] = $email;
    //$js['message'] = $message;
    $js['username'] = $username;
    
    $result = sendInviteFriendEmail($url, $email, $username, $message);
    if ($result) {
        print json_encode($js);
    }
    else {
        print json_encode(false);
	}
}
else {
    print json_encode(false);
}

?>
