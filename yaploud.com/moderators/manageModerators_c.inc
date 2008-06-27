<?php

/*
 * This is the controller (MVC pattern) for the addModerator.php view
 * There shouldn't be HTML in here. Please put them on the view page.
 *
 * Created on June 27, 2008
 * Author: alvinabad@alumni.cmu.edu
 */

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require_once("moderators/Moderators.inc");
require_once('user.php');
require("util/Url.inc");
$user = new User();

$md = new Moderators();
$url_util = new Url();
$isAuthenticated = false;
$moderator = '';
$domainname = '';

//----------------------------------------

if ( isset($_SESSION['username'])) {
    // temporarily hardcoded here for testing
    $admins = array('yapper', 'alvin', 'aman', 'josh', 'mv');
    
    foreach($admins as $admin) {
    	if ($admin == $_SESSION['username']) {
    		$isAuthenticated = true;
    		break;
    	}
    }
}
else {
	return;
}

$md = new Moderators();

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['add']) &&
     isset($_REQUEST['moderator']) && isset($_REQUEST['domainname'])) {
     	
	$moderator = $_REQUEST['moderator'];
	$domainname = $_REQUEST['domainname'];
	
	$moderator = trim($moderator);
	$domainname = $md->getDomainname($domainname);
	$domainname = trim($domainname);
	
	if ($moderator == '' || $domainname == '') {
		return;
	}
	
	if ($domainname == 'ALL') {
        foreach($admins as $admin) {
        	if ($admin == $moderator) {
    	        $md->add($moderator, $domainname);
    	    	break;
    	    }
        }
	}
	else {
    	$md->add($moderator, $domainname);
	}
}
else if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['remove']) &&
	      isset($_REQUEST['moderators']) ){
    foreach($_POST['moderators'] as $m) {
    	$arr = split(',', $m);
    	$moderator = $arr[0];
    	$domainname = $arr[1];
    	$md->remove($moderator, $domainname);
    }
    $moderator = '';
    $domainname = '';
}

$moderators = $md->getAllModerators();

?>

