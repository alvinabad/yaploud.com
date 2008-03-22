<?php

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
if (!isset($_SESSION['logged'])) session_start();
    
ob_start();
require ("user.php");
$user = new User();

$username = '';
$password = '';
$remember = '';

// Returns false in json format of login fails
// Returns username of login if successful

if ($_SERVER['REQUEST_METHOD'] == 'POST' || 
    $_SERVER['REQUEST_METHOD'] == 'GET' &&
    isset($_REQUEST['username']) && 
    isset($_REQUEST['password']) ) {
    	
    if (isset($_REQUEST['remember'])) {
        $remember = $_REQUEST['remember'];
    }
       
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    
    $user = $user->login($username, $password, $remember);
    print json_encode($user);
}
else {
	print json_encode(false);
}

?>