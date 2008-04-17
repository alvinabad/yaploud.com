<?php

/*
 * This is the controller (MVC pattern) for the forgotpassword.php view
 * There shouldn't be HTML in here. Please put them in the view page.
 * 
 * Created on Nov 19, 2007
 * Author: alvinabad@alumni.cmu.edu
 */

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require ("user.php");

$email = "";
$valid_captcha = false;	
$status = false;
$post_processed = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = false;
    $email = $_POST['email'];
    
    // validate captcha
    if (isset ($_REQUEST['captcha']) && isset ($_SESSION['captcha'])) {
        $post_processed = true;

        $captcha_string = $_REQUEST['captcha'];
        $captcha_code = $_SESSION['captcha'];
        $captcha_string_md5 = md5($captcha_string);

        if ($captcha_string_md5 == $captcha_code) {
            $valid_captcha = true;
            $status = true;	
        }
    }

    if ($status) {
        $user = new User();
        $valid_email = $user->_forgotPassword2($email);
    }
}
?>

