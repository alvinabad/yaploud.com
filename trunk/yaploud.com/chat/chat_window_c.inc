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
require("util/Url.inc");

$iframe = false;
$user = new User();
$username = $_SESSION['username'];
$iframe = false;
$iframe_enabled = "false";  // this is for setting javascript variable

//session_start();

$title = '';
$description = '';
$url = '';

function updateChatUrlInfo($url, $title, $description) {
    require_once 'db.inc';
    
    $u = new Url();
    $url = $u->normalize($url);
    $url = $u->addslashes($url);
    
    if ($url == '') {
        return;
    }
    
    $title = strip_tags($title);
    $title = $u->addslashes($title);
    
    $description = strip_tags($description);
    $description = $u->addslashes($description);
    
    $db = new DB();
    
    if ($_REQUEST['update'] == 'Update') {
        $sql = "UPDATE chat_url SET title='$title', " .
               "       description='$description' " .
               "WHERE url='$url'";
        $result = $db->mysql_query($sql);
    }
    else if ($_REQUEST['update'] == 'View') {
        $sql = "SELECT * FROM chat_url WHERE url='$url';";
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
        $sql = "INSERT INTO chat_url (url, title, description, creation_date) " .
               " values ('$url', '$title', '$description', SYSDATE() )";
        $result = $db->mysql_query($sql);
        
        // if cannot insert, that means it already exists. Update then
        if (!$result) {
            $sql = "UPDATE chat_url SET title='$title', " .
                   "       description='$description' " .
                   "WHERE url='$url'";
            $result = $db->mysql_query($sql);
        }
    }
}


if(isset($_SESSION['logged']) && $_SESSION['logged'] && isset($_SESSION['username']) ) {
	$username = $_SESSION['username'];
}
elseif ( isset($_SESSION['guest']) ) {
	$username = $_SESSION['guest'];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['url']) ) {
   	$u = new Url();
	$site_url = '';
	$site_title = ''; 
	$site_description = '';
	
	$site_url = trim($_REQUEST['url']);
	
    if (stripos($site_url, $_SERVER['HTTP_HOST'])) {
        $redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/home.php';
        header("Location: $redirect");
    }
	
	if (isset($_REQUEST['description'])) {
        $site_description = trim($_REQUEST['description']);
	}
	
	if (isset($_REQUEST['title'])) {
	    $site_title = $_REQUEST['title'];
        $site_title = $u->decode($site_title);
	}
	else {
	    $site_title = $site_url;
        $site_title = $u->decode($site_title);
	}
	
	if (isset($_REQUEST['iframe'])) {
		$iframe = true;
		$iframe_enabled = "true";
	}
		
    if (isset($_REQUEST['update'])) {
        updateChatUrlInfo($site_url, $site_title, $site_description);
   	}
   	
    $url_encoded = $u->encode($site_url);
    $title_encoded = $u->encode($site_title);
}    
else {
	$site_url = "http://www.cmu.edu";
}
?>

