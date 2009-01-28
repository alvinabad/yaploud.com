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
$petalert= 1;
$ylml= 1;
$dtm= 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $userid = $_POST['username'];
    $petalert = ((is_null($_POST['petalert'])) ? 0 : 1);
    $ylml = ((is_null($_POST['ylml'])) ? 0 : 1);
    $dtm = ((is_null($_POST['dtm'])) ? 0 : 1);

    $password = $_POST['password'];
    $password = MD5($password);
    $email = $_POST['email'];
    $yaploud_client = $_POST['yaploud_client'];
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
        $sql = "INSERT INTO user(username, first_name, last_name, " .
               " password, update_timestamp, email, userid,partner, petalert, ylml, dtm) " .
               " VALUES('$userid', '$first_name', '$last_name', '$password', " .
               " sysdate(), '$email', '$userid','$yaploud_client','$petalert','$ylml','$dtm');";

      	$result = $db->mysql_query($sql);

        if ($result) {
            $emailfrom = "info@yaploud.com";
            $message = "Hi $first_name $last_name, \n\n" .
              "Thank you for signing up. Your account is ready for login. ".
              "Your username is $username. Please follow the link below to login.\n\n" .
              "http://" . $_SERVER['HTTP_HOST'] . "/user/login.php" .

              "\n\n" .
              "Thanks, \n" .
              "The Yaploud Team";

              mail($email, "YapLoud Registration", $message, "From: $emailfrom\n");

              $message = "Registration successful! Welcome $username!";
              $redirect = '/user/login.php';
              header("Location: $redirect");
        }
        else {
            $status = false;
	        $message = "Registration has failed! ".
	        	    "Username or email is already taken. " .
	        	    "Please try again.";
        }
    }
}
?>

