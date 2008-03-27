<?php
//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require("common/nocache.php");
require("user.php");

function normalize_url($url) {
	// trim spaces
	$url = trim($url);
	
	// remove trailing slash
    $url = preg_replace('/([a-zA-Z0-9_-])\/$/', '$1', $url);
    
    // append http if not present
    if ( !preg_match('/^http:/', $url) ) {
    	$url = 'http://' . $url;
    }
    return $url;
}


if ($_SERVER['REQUEST_METHOD'] != 'GET' || !isset($_REQUEST['url']) ||
    !isset($_REQUEST['last_msg_id'])  ) {
    	
	$data = "Incorrect usage";
	print json_encode($data);
	return;
}

$url = normalize_url($_REQUEST['url']);
$last_msg_id = $_REQUEST['last_msg_id'] + 0;
if ($last_msg_id == 0) {
	$last_msg_id = -1;
}

require("./ChatRoom.inc");
require("./ChatMessages.inc");

$cr = new ChatRoom();
$cm = new ChatMessages();

if (isset($_SESSION['username']) && isset($_REQUEST['heartbeat'])) {
    $username = $_SESSION['username'];
    
    // check if heartbeat of a user is sent
    $cr->updateUser($url, $username);
}


$rs = array();
$rs['msgs'] = $cm->getMessages($url, $last_msg_id);
$rs['users'] = $cr->getUsers($url);
$rs['user_session'] = $_SESSION['username'];

print json_encode($rs);

?>
