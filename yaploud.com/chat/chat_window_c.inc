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

session_start();

$title = '';
$description = '';
$url = '';

function updateChatUrlInfo($url, $title, $description) {
    require_once 'db.inc';

    $url = trim($url);
    $url = preg_replace('/([a-zA-Z0-9_-])\/$/', '$1', $url);
    if ($url == '') {
        return;
    }
    
    $url = addslashes($url);

    $title = trim($title);
    $title = strip_tags($title);
    $title = addslashes($title);
    
    $description = trim($description);
    $description = strip_tags($description);
    $description = addslashes($description);
    
    $db = new DB();
    
    if ($_REQUEST['update'] == 'Update') {
        $sql = "UPDATE dev.chat_url SET title='$title', " .
               "       description='$description' " .
               "WHERE url='$url'";
        $result = $db->mysql_query($sql);
    }
    else if ($_REQUEST['update'] == 'View') {
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


if(isset($_SESSION['logged']) && $_SESSION['logged'] && isset($_SESSION['username']) ) {
	$username = $_SESSION['username'];
}
elseif ( isset($_SESSION['guest']) ) {
	$username = $_SESSION['guest'];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['url']) ) {
	$site_url = '';
	$site_title = ''; 
	$site_description = '';
	
	$site_url = trim($_REQUEST['url']);
	
	if (isset($_REQUEST['description'])) {
        $site_description = trim($_REQUEST['description']);
	}
	
	if (isset($_REQUEST['title'])) {
	    $site_title = $_REQUEST['title'];
	}
	else {
	    $site_title = $site_url;
	}
	
	if (isset($_REQUEST['iframe'])) {
		$iframe = true;
		$iframe_enabled = "true";
	}
		
    if (isset($_REQUEST['update'])) {
        updateChatUrlInfo($site_url, $site_title, $site_description);
   	}
}
else {
	$site_url = "http://www.cmu.edu";
}
?>

