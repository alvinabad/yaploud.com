<?php set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);session_start();ob_start();
/*
 * This is the controller (MVC pattern) for the Login page - login.php
 * There shouldn't be HTML in here. Please put them in the view page.
 *
 * Created on Nov 18, 2007
 * Author: alvinabad@alumni.cmu.edu
 */

//--- Initialize include path and session
// set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
// session_start();
// ob_start();

require ("user.php");

$login_status = false;
$result = true;
$message = "XXXX";
$username = "";

// If the user pressed the logout link, end the session
if (isset($_REQUEST['logout']) && $_REQUEST['logout']=="true") {
    $user = new User();
    $user->_logout();
    $redirect = "/user/login.php";
    header("Location: $redirect");
}

if(isset($_POST['action']) && $_POST['action'] == 'login') {
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
        if (!isset($_POST['remember'])) {
        	$_POST['remember'] = '';
        }


        $user = new User();
        $username = $_POST['username'];
        $result = $user->_checkLogin($_POST['username'], $_POST['password'],
                          $_POST['remember']);

        if (!$result) {
            $message = "Invalid username or password. Please try again.";
        }
        else {
            //header("Location: http://www.yaploud.com/home.php");
            if (isset($_SESSION['PREVIOUS_URI'])) {
                $redirect = 'http://' . $_SERVER['HTTP_HOST'] .
                            $_SESSION['PREVIOUS_URI'];
                unset($_SESSION['PREVIOUS_URI']);
            }
            else {
                $redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/home.php';
            }
            header("Location: $redirect");
        }
    }
}?>

