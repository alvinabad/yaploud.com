<?php

require_once 'util.inc';

//IE will cache AJAX stuff w/o things like cache killers below

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
require_once 'db.inc';
$url = $_GET['url'];
$url = normalizeURL($url);

$db = new DB();


$query = "select COUNT(distinct(username)) from dev.room_users where topic_url = '$url'"; 
if(($result = $db->mysql_query($query, $db->getConnection())) != null){
   $num = mysql_fetch_array($result);
   print $num[0]; 
} else {
   print "0";
}


?>
