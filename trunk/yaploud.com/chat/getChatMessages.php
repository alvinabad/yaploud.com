<?php
//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require("common/nocache.php");
require("user.php");
require("util/Url.inc");
$user = new User();

if ($_SERVER['REQUEST_METHOD'] != 'GET' || !isset($_REQUEST['url']) ||
    !isset($_REQUEST['last_msg_id'])  ) {
    	
	$data = "Incorrect usage";
	print json_encode($data);
	return;
}

$url = normalize_url($_REQUEST['url']);
//$user_ip =$_SERVER['REMOTE_ADDR'];
$last_msg_id = $_REQUEST['last_msg_id'] + 0;
if ($last_msg_id == 0) {
	$last_msg_id = -1;
}

require("./ChatRoom.inc");
require("./ChatMessages.inc");
require("rating/Rating.inc");

$cr = new ChatRoom();
$cm = new ChatMessages();
$rt = new Rating();
$md = new Moderators();

if (isset($_SESSION['username']) && isset($_REQUEST['heartbeat'])) {
    $username = $_SESSION['username'];
    $ip = $_SERVER['REMOTE_ADDR'];
    // check if heartbeat of a user is sent
    $cr->updateUser($url, $username, $ip);
}


$rs = array();
$rs['msgs'] = $cm->getMessages($url, $last_msg_id);
$rs['users'] = $cr->getUsers($url);
$rs['rating'] = $rt->getRating($url);
$rs['votes'] = $rt->getVotes($url);

$domainname = $md->getDomainname($url);
$rs['moderators'] = $md->getModerators($domainname);

if (isset($_SESSION['username'])) {
    $rs['user_session'] = $_SESSION['username'];
}
else {
    $rs['user_session'] = 'guestxxx';
}

if (isset($_REQUEST['embed'])) {
	$js = json_encode($rs);
    print "callback(" . $js . "); ";
}
else {
    print json_encode($rs);
}

?>
