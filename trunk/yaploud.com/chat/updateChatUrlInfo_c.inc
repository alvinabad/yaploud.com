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

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['url']) ) {
	require_once 'db.inc';

	$url = $_GET['url'];
	$url = trim($url);
	if ($url == '') {
		return;
	}
	
	$url = addslashes($url);

	$title = $_GET['title'];
	$title = trim($title);
	$title = strip_tags($title);
	$title = addslashes($title);
	
	$description = $_GET['description'];
	$description = trim($description);
	$description = strip_tags($description);
	$description = addslashes($description);
	
	if ($_GET['update'] == 'Update') {
    	$sql = "UPDATE dev.chat_url SET title='$title', " .
    	       "       description='$description' " .
    	       "WHERE url='$url'";
	}
	else {
    	$sql = "INSERT INTO dev.chat_url (url, title, description, creation_date) " .
	           " values ('$url', '$title', '$description', SYSDATE() )";
	}
	
	$db = new DB();
	$result = $db->mysql_query($sql);
}

?>