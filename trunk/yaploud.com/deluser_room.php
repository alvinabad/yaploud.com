<?php
   require_once 'db.inc';

   $username = $_GET['username'];
   $url = $_GET['url'];
   //$session = $_GET['session'];

   $sql = "delete from dev.room_users where username = '$username' and topic_url = '$url'";
   print "$sql\n";
   $db = new DB();
   $result = $db->mysql_query($sql);
   if($result){
   }
?>
