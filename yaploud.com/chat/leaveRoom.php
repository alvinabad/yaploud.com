<?php

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
    
ob_start();
require ("common/nocache.php");
require("./ChatRoom.inc");
require("util/Url.inc");

// leave chat room
if (isset($_REQUEST['url']) && isset($_SESSION['username'])) {
    $url = $_REQUEST['url'];
    $username = $_SESSION['username'];
    $cr = new ChatRoom();
    $cr->removeUser($url, $username);
}

print json_encode($username);

?>