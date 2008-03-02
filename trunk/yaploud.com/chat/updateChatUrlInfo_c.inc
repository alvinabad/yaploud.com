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

$title = '';
$description = '';
$url = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['url']) ) {
	require_once 'db.inc';

	$url = $_GET['url'];
	$url = trim($url);
	$url = preg_replace('/([a-zA-Z0-9_-])\/$/', '$1', $url);
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
	
	$db = new DB();
	
	if ($_GET['update'] == 'Update') {
    	$sql = "UPDATE dev.chat_url SET title='$title', " .
    	       "       description='$description' " .
    	       "WHERE url='$url'";
    	$result = $db->mysql_query($sql);
	}
	else if ($_GET['update'] == 'View') {
        $sql = "SELECT * FROM dev.chat_url WHERE url='$url';";
        $result = $db->mysql_query($sql);

        $title = '';
        $description = '';
        if (mysql_num_rows($result) != 1) {
        	$res_obj = false;
        	return;
        }

        $res_obj = mysql_fetch_object($result);
        $title = $res_obj->title;
        $description = $res_obj->description;
	}
	else {
    	$sql = "INSERT INTO dev.chat_url (url, title, description, creation_date) " .
	           " values ('$url', '$title', '$description', SYSDATE() )";
    	$result = $db->mysql_query($sql);
	}
}

?>