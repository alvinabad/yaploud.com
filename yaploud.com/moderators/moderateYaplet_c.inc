<?php

/*
 * This is the controller (MVC pattern) for the moderateYaplet.php view
 * There shouldn't be HTML in here. Please put them on the view page.
 *
 * Created on June 23, 2008
 * Author: alvinabad@alumni.cmu.edu
 */

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require_once("moderators/Moderators.inc");
require_once('chat/BannedUsers.inc');
require_once('chat/ChatMessages.inc');
require_once('chat/ChatRoom.inc');
require_once('user.php');
require("util/Url.inc");
$user = new User();

$md = new Moderators();
$bu = new BannedUsers();
$cm = new ChatMessages();
$cr = new ChatRoom();
$isModerator = false;
$voter = '';
$yap_url = '';
$url_util = new Url();

//----------------------------------------

if ( isset($_SESSION['username'])) {
    $voter = $_SESSION['username'];
}
else {
	return;
}

if (preg_match('/^guest/', $voter)) {
	return;
}

if ( isset($_REQUEST['url']) ) {
    $yap_url = $_REQUEST['url'];        
    $domainname = $md->getDomainname($yap_url);
    $isModerator = $md->isModerator($voter, $domainname);
}
else {
	return;
}

if ( isset($_REQUEST['delete_yaps_of_this_user']) && $_REQUEST['delete_yaps_of_this_user'] != "") {
    $cm->deleteMessagesOfUser($_REQUEST['delete_yaps_of_this_user'], $_REQUEST['url']);
}
else if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['ban_users']) ) {
    $ips = array();  // ip => ban or unban
    $ipUser = array();
    $users = $_POST['users'];
    
    foreach($users as $u) {
        $arr = split(',', $u);
        $ips[$arr[1]] = 'unban';
        $ipUser[$arr[1]] = $arr[0];
    }
    
    if (isset($_POST['banned_users'])) {
        $banned_users = $_POST['banned_users'];
        foreach($banned_users as $u) {
            $arr = split(',', $u);
            $ips[$arr[1]] = 'ban';
        }
    }
    
    foreach($ips as $ip => $value) {
        if ($value == 'ban') {
            $bu->addIp($ip, $voter, $domainname);
            if (isset($_REQUEST['delete_yaps'])) {
            	
            	$cm->deleteLastMessages($ipUser[$ip],"Interval 60 minute");
            }
        }
        else {
            $bu->removeIp($ip, $domainname);
        }
    }
}
    
$yap_messages = array_reverse($cm->getMessages($yap_url, -1));
$yappers = $cr->getUsers($yap_url);


?>

