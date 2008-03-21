<?php

/*
 * This is the controller (MVC pattern) for the chat_window.php view
 * There shouldn't be HTML in here. Please put them in the view page.
 *
 * Created on Mar 2, 2008
 * Author: alvinabad@alumni.cmu.edu
 */

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require("common/nocache.php");
require("user.php");

$iframe = false;
$username = 'guestxxx';
$user = new User();
$iframe = false;
$iframe_enabled = "false";  // this is for setting javascript variable

if(isset($_SESSION['logged']) && $_SESSION['logged'] == true && isset($_SESSION['username']) ) {
	$username = $_SESSION['username'];
}
elseif ( isset($_SESSION['guest']) ) {
	$username = $_SESSION['guest'];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['url']) ) {
	$site_url = $_REQUEST['url'];
	if (isset($_REQUEST['title'])) {
	    $site_title = $_REQUEST['title'];
	}
	else {
	    $site_title = $_REQUEST['url'];
	}
	
	if (isset($_REQUEST['iframe'])) {
		$iframe = true;
		$iframe_enabled = "true";
	}
}
else {
	$site_url = "http://cmu.edu";
}
?>

