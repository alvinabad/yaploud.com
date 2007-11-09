<?PHP

  include("db.php");

  // This page will retrieve the latest messages from the database for a given
  // URL and return them in a JSON string.  The valid parameters are the
  // url and the lastMsg which will contain the ID of the last message received.

  $url = $_REQUEST['url'];
  $lastMsg = $_REQUEST['lastMsg'];
  $db = db_connect();

  $sql = "SELECT * FROM chat WHERE url = \"" . $url . "\" AND commentId > " . $lastMsg . ";";

  $result = mysql_query($sql, $db) or die("Couldn't query DB with sql $sql");

  $json = "{ \"messages\" : [ ";
  
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

    $id = $row['commentId'];
    $comment = $row['comment'];
    $userId = $row['userId'];
    $timestamp = $row['timestamp'];
    
    $json = $json . "{ \"commentId\" : $id, \"comment\" : \"$comment\", \"userId\" : \"$userId\", \"timestamp\" : \"$timestamp\" }, ";


  }

  $lastcomma = strrpos($json, ',');

  if ($lastcomma != FALSE) {
    $json = substr($json, 0, $lastcomma);
  }

  $json = $json . " ] }";

  echo($json);

?>
