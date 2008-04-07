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

$username = "";
$first_name = "";
$last_name = "";
$password = "";
$password = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $userid = $_POST['username'];
        
    $password = $_POST['password'];
    $password = MD5($password);
    $email = $_POST['email'];

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
        require_once 'db.inc';
        $db = new DB();
        $sql = "INSERT INTO dev.user(username, first_name, last_name, " .
               " password, update_timestamp, email, userid) " . 
               " VALUES('$userid', '$first_name', '$last_name', '$password', " . 
               " sysdate(), '$email', '$userid');";

      	$result = $db->mysql_query($sql);

        if ($result) {
            $emailfrom = "info@yaploud.com";
            $message = "Hi $first_name $last_name, \n\n" . 
              "Thank you for signing up. Your account is ready for login. ".
              "Your username is $username. Please follow the link below to login.\n\n" .
              "http://" . $_SERVER['HTTP_HOST'] . "/login_page.php" .
            
              "\n\n" .
              "Thanks, \n" .
              "The Yaploud Team";

              mail($email, "YapLoud Registration", $message, "From: $emailfrom\n");
              
              $message = "Registration successful! Welcome $username!";
              $redirect = '/login_page.php';
              header("Location: $redirect");
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

