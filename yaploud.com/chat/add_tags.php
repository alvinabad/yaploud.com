<?php

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
if (!isset($_SESSION['logged'])) session_start();
    
ob_start();
require ("user.php");
require ("common/nocache.php");

$user = new User();

$username = '';
$tags = '';

// Returns false in json format of login fails
// Returns username of login if successful

function sendEmail($to, $from, $subject, $message) {
	$from = "From: $from\n";
	
    $result = mail($to, $subject, $message, $from);
    return $result;
}

function appendHttp2Url($url) {
    if (substr($url,0,5) != "http:") {
    	$url = "http://" . $url;	
    }
    return $url;
}

function sendInviteFriendEmail($url, $email, $username, $message) {
    $email = addslashes($email);
    $username = addslashes($username);
    
    $user = new User();
    $db = new DB();
    
    $sql = "SELECT * FROM dev.user WHERE username ='$username';";
    $result = $db->mysql_query($sql);
    if (mysql_num_rows($result) != 1) {
        return false;
    }

    $res_obj = mysql_fetch_object($result);
    $username = $res_obj->username;
    $first_name = $res_obj->first_name;
    $last_name = $res_obj->last_name;

    $emailfrom = "info@yaploud.com";
    $subject = "Invitation from $first_name $last_name";
    
    $message_header = "You've been invited by $first_name $last_name ($email) to chat on this site:\n";
    $url = appendHttp2Url($url);
    $url = urlencode($url);
    $url = "http://www.yaploud.com/chat/chat_window.php?url=$url" .
                "&iframe=yes";
    $message_header .= "$url\n\n";
    
    $message = $message_header . $message;
    $message .= "\n\n" . "$first_name $last_name\n$email";

    $result = sendEmail($email, $emailfrom, $subject, $message);	
    return $result;
}

function addTags2Db($url, $tags) {
    return true;	
}

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' || 
    $_SERVER['REQUEST_METHOD'] == 'GET' &&
    isset($_SESSION['logged']) && 
    $_SESSION['logged'] && 
    isset($_REQUEST['tags']) && 
    isset($_REQUEST['url']) ) {
        
       
    $tags = $_REQUEST['tags'];
    $url = $_REQUEST['url'];
    $username = $_SESSION['username'];
    
    $js['tags'] = $tags;
    $js['username'] = $username;
    
    $result = addTags2Db($url, $tags);
    if ($result) {
        print json_encode($js);
    }
    else {
        print json_encode(false);
    }
}
else {
    print json_encode(false);
}

?>
