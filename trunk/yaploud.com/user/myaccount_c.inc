<?php

/*
 * This is the controller (MVC pattern) for the My Account view - myaccount.php
 * There shouldn't be HTML in here. Please put them in the view page.
 * 
 * Created on Nov 17, 2007
 * Author: alvinabad@alumni.cmu.edu
 */

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require ("user.php");
//require("user/Token.php");

//--- Process request with password token
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset ($_GET['token'])) {
    $token = $_GET['token'];

    $t = new Token();
    $username = $t->validate($token);
    $user = new User();
    $user->setSessionInDb($username);

    $username = $_SESSION['username'];
    $logged = $_SESSION['logged'];
}

//--- Verify if user is logged in
if (!isset ($_SESSION['logged']) || $_SESSION['logged'] == false) {
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/home.php';
    header("Location: $redirect");
    exit;
}

$username = $_SESSION['username'];
$user = new User();

//--- Process request for change of password or update of user info
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ( isset ($_REQUEST['submit_change_password']) &&
         isset ($_REQUEST['password']) && 
         isset ($_REQUEST['password2'])) {
        $reset_password = $user->changePassword($_REQUEST['password']);
        $change_password_processed = true;
    }
    else if ( isset ($_REQUEST['submit_update_userinfo']) &&
              isset ($_REQUEST['first_name']) && 
              isset ($_REQUEST['last_name']) && 
              isset ($_REQUEST['email'])) {
        $first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $email = $_REQUEST['email'];
        
        $update_userinfo = $user->updateUserInfo($username, $first_name, $last_name, $email);
        $update_userinfo_processed = true;
    }
}

$user_obj = $user->getUserInfo($username);
$first_name = $user_obj->first_name;
$last_name = $user_obj->last_name;
$email = $user_obj->email;

?>
