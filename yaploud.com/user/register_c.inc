<?php

/*
 * This is the controller (MVC pattern) for the Registration page - register.php
 * There shouldn't be HTML in here. Please put them in the view page.
 * 
 * Created on Nov 18, 2007
 * Author: alvinabad@alumni.cmu.edu
 */

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require ("user.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // validate captcha
    if (isset ($_REQUEST['captcha']) && isset ($_SESSION['captcha'])) {
        $registration_processed = true;
        $status = false;

        $captcha_string = $_REQUEST['captcha'];
        $captcha_code = $_SESSION['captcha'];
        $captcha_string_md5 = md5($captcha_string);

        if ($captcha_string_md5 == $captcha_code) {
            $status = true;
            $message = "Welcome! ";
        } else {
            $status = false;
            $message = "Incorrect captcha text. Please try again.";
        }
    }

    if ($status) {
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $userid = $_POST['username'];
        
        $password = $_POST['password'];
        $password = MD5($password);
        $email = $_POST['email'];

        require_once 'db.inc';
        $db = new DB();
        $sql = "INSERT INTO dev.user(username, first_name, last_name, " .
               " password, update_timestamp, email, userid) " . 
               " VALUES('$userid', '$first_name', '$last_name', '$password', " . 
               " sysdate(), '$email', '$userid');";

        	$result = $db->mysql_query($sql);
        	//$result = false;

	        if ($result) {
	        	    $message = "Registration successful! Welcome $username!";
        		}
        		else {
        			    $status = false;
	        	    $message = "Registration has failed! ". 
	        	               "Username or email is already taken. <br>" . 
	        	               "Please try again.";
        		}
    }
}
?>

