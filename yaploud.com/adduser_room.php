<?php
   require_once 'db.inc';

   $username = $_GET['username'];
   $url = $_GET['url'];
   $sess = $_GET['session']; 
   $sql = "insert into dev.room_users (username, topic_url, creation_date, session) values ('$username', '$url', sysdate(), session)"; 
   $db = new DB();
   $result = $db->mysql_query($sql);
   if($result){
      $sql = "select distinct(username) as u from dev.room_users where topic_url = '$url'"; 
      $result = $db->mysql_query($sql);
      $users = array();
      $rv = array();
      while($row = mysql_fetch_assoc($result)){
         array_push($users, $row['u']); 
      }
      mysql_free_result($result);
      $rv['users'] = $users;
      $rv['topic_url'] = $url;
      print json_encode($rv);
   }
   else{
      print "{}";
   }
?>
