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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = false;
    
    // validate captcha
    if (isset ($_REQUEST['captcha']) && isset ($_SESSION['captcha'])) {
        $post_processed = true;
        $valid_captcha = false;	

        $captcha_string = $_REQUEST['captcha'];
        $captcha_code = $_SESSION['captcha'];
        $captcha_string_md5 = md5($captcha_string);

        if ($captcha_string_md5 == $captcha_code) {
            $valid_captcha = true;
            $status = true;	
        }
    }

    if ($status) {
    	    $email = $_POST['email'];
    	    $user = new User();
        //$valid_email = $user->_forgotUsername($email);
        $valid_email = false;
    }
}
?>

