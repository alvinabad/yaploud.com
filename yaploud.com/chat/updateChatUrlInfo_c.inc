<?php

/*
 * This is the controller (MVC pattern) for the updateChatUrlInfo.php
 * There shouldn't be HTML in here. Please put them in the view page.
 *
 * Created on Feb 26, 2008
 * Author: alvinabad@alumni.cmu.edu
 */

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();

require("chat/ChatUrl.inc");
require("util/Url.inc");

$title = '';
$description = '';
$url = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['url']) ) {
	$cu = new ChatUrl();
	
	$url = $_GET['url'];
	$title = $_GET['title'];
	$description = $_GET['description'];
	
	if ($_GET['update'] == 'Update') {
		error_log("Updating: " . $url);
	    $result = $cu->update($url, $title, $description);
	}
	else if ($_GET['update'] == 'View') {
		$result = $cu->get($url);
		
        if (mysql_num_rows($result) != 1) {
        	$res_obj = false;
        	return;
        }

        $res_obj = mysql_fetch_object($result);
        $title = $res_obj->title;
        $description = $res_obj->description;
	}
	else {
		error_log("Adding: " . $url);
		$result = $cu->add($url,$title, $description);
	}
}

?>