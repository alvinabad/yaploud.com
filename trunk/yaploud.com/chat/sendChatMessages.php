<?php
header('Content-type: application/json');

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);

require_once 'db.inc'; 
require("util/Url.inc"); 
require('BannedUsers.inc');
require('bad_words.inc');

$ip = $_SERVER['REMOTE_ADDR'];
$bu = new BannedUsers();
$domainname = $bu->getDomainname($_GET['url']);
if ($bu->isIpBanned($ip, $domainname)) {
   print "-1";
   return;
}

$db = new DB();
$allow_tags = array( 'b', 'strong', 'i', 'em', 'u', 'a', 'p', 'sup', 'sub', 'div', 'img', 'span', 'font', 'ul', 'ol', 'li');
$user = strip_tags(clean($_GET['user'], 64, $db->getConnection()));
$msg = $_GET['msg'];
$msg = strip_tags(clean($msg, 1024, $db->getConnection()), '<'.implode('><', $allow_tags).'>');
$msg = preg_replace($bad_words, '@!$@#', $msg);

$url = $_GET['url'];
$url = normalizeURL($url);
$url = addslashes($url);

$query = "INSERT INTO chat values (NULL, '$url', '$user', SYSDATE(), '$msg')"; 
//print "$query <br/>";
if(!$result = mysql_query($query, $db->getConnection())){
   print "-1";
}
else{
   print "ok";
}
?>


