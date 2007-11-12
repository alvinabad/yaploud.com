<?PHP

require_once 'db.inc';

class User {


  var $db = null;
  var $failed = false;
  var $date;
  var $userid = "";

  function User() {

	$this->db = new DB();
	$this->date = date("Y-m-d");


	if (!isset($_SESSION['userid']) ) {
		$this->_session_defaults();
	}
	if ($_SESSION['logged']) {
	  $this->_checkSession();
	} elseif ( isset($_COOKIE['yaploud']) ) {
	  $this->_checkRemembered($_COOKIE['yaploud']);
	}

  }


  function _checkLogin($username, $password, $remember) {
	$password = md5($password);
	$username = addslashes($username);
	$sql = "SELECT * FROM dev.user WHERE userid = '$username' AND password = '$password';";
	//print "$sql<br/>\n";
	$result = $this->db->mysql_query($sql);
	if(mysql_num_rows($result) != 1){
		// Login failed
		$this->failed = true;
		return false;
	}
	$res_obj = mysql_fetch_object($result);
	// Login successful
	$this->_setSession($res_obj, $remember);
	mysql_free_result($result);
	return true;
  }

	function _forgotPassword($email) {
	$email = addslashes($email);
	$sql = "SELECT * FROM dev.user WHERE email ='$email';";
	//print "$sql<br/>\n";
	$result = $this->db->mysql_query($sql);
	if(mysql_num_rows($result) != 1){
		// Email does not exist
		$this->failed = true;
		return false;
	}
	$res_obj = mysql_fetch_object($result);
	$pass = $res_obj->password; //Get your password
	$username = $res_obj->username; // Get your username
	$temp_password="just4now";
	$new_password=md5($temp_password);
	$sql1 = "UPDATE dev.user SET password = \"$new_password\" WHERE " .
		"username = \"$username\";";
		$this->db->mysql_query($sql1) or die("Couldn't execute query $sql1");
	$emailfrom = "info@yaploud.com";
	$message = " Hi $username,you recently requested password assistance from Yaploud.com. Your temporary password is : $temp_password. Please contact info@yaploud.com with any questions.
				Thanks,
				The Yaploud Team";

	if(mail($email,"Your Yaploud password",$message,"From: $emailfrom\n")) {
	mysql_free_result($result);
	return true;

	} else {
		mysql_free_result($result);
		return false;
		}
	}


  function _setSession(&$values, $remember, $init = true) {
	$this->userid = $values->username;
	$_SESSION['username'] = htmlspecialchars($values->username);
	$_SESSION['cookie'] = $values->cookie;
	$_SESSION['logged'] = true;
	if ($remember) {
		$this->updateCookie($values->cookie, true);
	}
	$cookie = addslashes($_SESSION['cookie']);
	if ($init) {
		$session = session_id();
		$ip = $_SERVER['REMOTE_ADDR'];

		$sql = "UPDATE dev.user SET session = \"$session\", ip = \"$ip\", cookie = \"$cookie\" WHERE " .
		"userId = \"$this->userid\";";
		$this->db->mysql_query($sql) or die("Couldn't execute query $sql");
	}
  }


  function updateCookie($cookie, $save) {
	if ($save) {
		$cookie = serialize(array($_SESSION['userid'], $cookie) );
		setcookie('yaploud', $cookie, time() + 31104000);
	}
  }


  function _checkRemembered($cookie) {

	list($username, $cookie) = @unserialize($cookie);
	if (!$username or !$cookie) return;
	$cookie = addslashes($cookie);
	$sql = "SELECT * FROM dev.user WHERE " .
		"(userid = \"$username\") AND (cookie = \"$cookie\");";
	$result = $this->db->mysql_query($sql);
	$result = mysql_fetch_object($result);
	if (is_object($result) ) {
		$this->_setSession($result, false);
	}

  }

  function _checkSession() {
	$username = $_SESSION['username'];
	$cookie = addslashes($_SESSION['cookie']);
	$session = session_id();
	$ip = $_SERVER['REMOTE_ADDR'];
	$sql = "SELECT * FROM dev.user WHERE " .
		"(userId = \"$username\") AND (cookie = \"$cookie\") AND " .
		"(session = \"$session\") AND (ip = \"$ip\");";
	$result = $this->db->mysql_query($sql) or die("Couldn't query the db with sql $sql");
	$result_obj = mysql_fetch_object($result);
	mysql_free_result($result);
	if (is_object($result_obj) ) {
		$this->_setSession($result_obj, false, false);
	} else {
		$this->_logout();
	}
  }

  function _logout() {
    setcookie("yaploud", "", time()-60000);
    session_unset();
    session_destroy();

  }

  function _session_defaults() {

	$_SESSION['logged'] = false;
	$_SESSION['userid'] = 0;
	$_SESSION['username'] = '';
	$_SESSION['cookie'] = 0;
	$_SESSION['remember'] = false;

  }



} // End class User

?>
