<?php

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
    
ob_start();
require ("user.php");
require ("common/nocache.php");
$user = new User();

$user = $user->_logout();
session_start();
$user = new User();
$username = $_SESSION['username'];
print json_encode($username);

?>