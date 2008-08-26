<?php

/*
 * Community moderation endpoint
 *
 * Usage: /community/moderate.php
 *			?url={yap url}
 *			&user={username to ban or unban}
 *			&ban={if 1 then ban, else unban}
 *
 * Created on June 29, 2008
 * Author: joshua.correa@yaploud.com
 */

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require_once("moderators/Moderators.inc");
require_once('chat/BannedUsers.inc');
require_once('chat/ChatRoom.inc');

$md = new Moderators();
$bu = new BannedUsers();
$cr = new ChatRoom();
$voter = '';
$yap_url = '';
$ip = '';

if (isset($_SESSION['username']) && isset($_REQUEST['url']) && isset($_REQUEST['user']) && isset($_REQUEST['ban'])) {
    $voter = $_SESSION['username'];
    $domainname = $md->getDomainname($_REQUEST['url']);
	$users = $cr->getUsers($_REQUEST['url']);
	foreach($users as $user){
		if ($user['name'] == $_REQUEST['user']) {
			$ip = $user['ip'];
		}
	}
}

if ( $ip != '' ) {
	if ($_REQUEST['ban'] == 1) {
		$bu->addIp($ip, $voter, $domainname);		
	} else {
		$bu->removeIp_community($ip, $voter, $domainname);
	}
	print "success";
} else {
	print "failure";
}


?>