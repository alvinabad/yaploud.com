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

require("./common/nocache.php");
require ("user.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['url']) ) {
	$site_url = $_REQUEST['url'];
	if (isset($_REQUEST['title'])) {
	    $site_title = $_REQUEST['title'];
	}
	else {
	    $site_title = $_REQUEST['url'];
	}
}
else {
	$site_url = "http://cmu.edu";
}
?>

