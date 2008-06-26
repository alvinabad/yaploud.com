<?php

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();
require_once('BannedUsers.inc');

if ( isset($_REQUEST['url']) && 
     isset($_SESSION['username']) &&
     isset($_REQUEST['banned_ip'])  ) {
    
    $url = $_REQUEST['url'];
    $voter = $_SESSION['username'];
    $ip = $_REQUEST['banned_ip'];
    
    $bu = new BannedUsers();
    $domainname = $bu->getDomainname($url);
    $bu->addIp($ip, $voter, $domainname);
    print json_encode($ip);
}
else {
    print json_encode(-1);
}


?>