<?PHP

function &db_connect() {

  require_once 'db.php';
  $db_host = 'west.yaploud.com';
  $db_user = 'yaploud';
  $db_pass = 'r4hulcmu';
  $db_name = 'yaploud';
  $db = @mysql_connect($db_host, $db_user, $db_pass) or die("Couldn't connect to the MySQL server.");
  @mysql_select_db($db_name, $db) or die("Couldn't connect to the database");
  return $db;

}


?>
