<script type="text/javascript" src="/user/ChangePassword.js" />

<?php
/*
 * This is the controller for the My Account view - myaccount.php
 * 
 * Created on Nov 17, 2007
 * Author: alvinabad@alumni.cmu.edu
 */
 

//--- Initialize include path and session
set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );
session_start();
ob_start();

include("user.php");

//--- Verify if user is logged in
if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/home.php';
    header("Location: $redirect");
	exit;
}

//--- Process request for change of password
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if ( isset($_REQUEST['password']) && isset($_REQUEST['password2']) ) {
		$user = new User();
		$reset_password = $user->changePassword($_REQUEST['password']);
		$change_password_processed = true;
		$error = $reset_password;
	}
}

 
?>