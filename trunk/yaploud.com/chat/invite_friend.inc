<?php
require ("user.php");
require("util/Url.inc");
require("user/Friends.inc");
$user = new User();

$username = '';
$email = '';
$msg = '';

// Returns false in json format of login fails
// Returns username of login if successful

function sendEmail($to, $from, $subject, $message) {
    $from = "From: $from\n";
    
    $result = mail($to, $subject, $message, $from);
    return $result;
}

function sendInviteFriendEmail($url, $email, $username, $message) {
    $email = addslashes($email);
    $username = addslashes($username);
    
    $user = new User();
    $db = new DB();
    
    $sql = "SELECT * FROM user WHERE username ='$username';";
    $result = $db->mysql_query($sql);
    if (mysql_num_rows($result) != 1) {
        return false;
    }

    $res_obj = mysql_fetch_object($result);
    $username = $res_obj->username;
    $first_name = $res_obj->first_name;
    $last_name = $res_obj->last_name;

    $friend = new Friends();
    $friend->addInvitedFriend($username, $email);
    
    $emailfrom = "info@yaploud.com";
    $subject = "Invitation from $first_name $last_name";
    
    $message_header = "You've been invited by $first_name $last_name ($email) to chat on this site:\n";
    $url = normalize_url($url);
    $url = urlencode($url);
    $url = "http://www.yaploud.com/chat/chat_window.php?url=$url";
    $message_header .= "$url\n\n";
    
    $message = $message_header . $message;
    $message .= "\n\n" . "$first_name $last_name\n$email";

    $result = sendEmail($email, $emailfrom, $subject, $message);    
    return $result;
}

?>