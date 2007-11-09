<?php
header('Content-type: application/json');

require_once 'db.inc'; 
require_once 'util.inc'; 

$db = new DB();
$allow_tags = array( 'b', 'strong', 'i', 'em', 'u', 'a', 'p', 'sup', 'sub', 'div', 'img', 'span', 'font', 'ul', 'ol', 'li');
$user = strip_tags(clean($_GET['user'], 64, $db->getConnection()));
$msg = $_GET['msg'];
$msg = strip_tags(clean($msg, 1024, $db->getConnection()), '<'.implode('><', $allow_tags).'>');
$url = $_GET['url'];
$url = normalizeURL($url);

$query = "INSERT INTO dev.chat values (NULL, '$url', '$user', SYSDATE(), '$msg')"; 
print "$query <br/>";
if(!$result = mysql_query($query, $db->getConnection())){
   print "-1";
}
else{
   print "$ok";
}
?>


