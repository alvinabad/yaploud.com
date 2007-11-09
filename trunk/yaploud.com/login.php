<?PHP
	require_once 'db.inc';
	header("Content-Type: text/plain");

	$db = new DB();

	// Make a md5 checksum of the password.
	$_POST['password'] = md5($_POST['password']);

	$sql = "SELECT COUNT(userid) FROM dev.user WHERE password='" . $_POST['password'] . "' AND userid='" . $_POST['username'] . "';";
	$result = $db->mysql_query($sql) or die("Couldn't query the user database with sql: " . $sql);
	$num = mysql_result($result, 0);

	if (!$num) {

		// When the query didn't return anything,
		// display the login form.

		echo "{ \"error\" : \"Login failed.  Please check your credentials and try again.\" }";

	} else {

		echo "{ \"success\" : \"Login successful.\" }";

	}

?> 
