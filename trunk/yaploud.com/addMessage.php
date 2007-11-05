<?PHP



  include("db.php");

  // This page will add a message to the DB

  $url = $_REQUEST['url'];
  $lastMsg = $_REQUEST['lastMsg'];
  $db = db_connect();

  $comment = addslashes($_POST['comment']);
  $username = addslashes($_POST['username']);
  $url = addslashes($_POST['url']);

  $sql = "INSERT INTO chat (comment, timestamp, userId, url) VALUES (\"$comment\", NOW(), \"$username\", \"$url\");";


  $result = mysql_query($sql, $db) or die("Couldn't query DB with sql $sql");


?>
