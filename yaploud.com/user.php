<?PHP
require_once 'db.inc';
include ("user/Token.php");

class User {
	
	//TODO: This needs to be refactored big time!

    var $db = null;
    var $failed = false;
    var $date;
    var $userid = "";

    function User() {

        $this->db = new DB();
        $this->date = date("Y-m-d");

        if (isset ($_SESSION['logged']) && $_SESSION['logged']) {
            $this->_checkSession();
        }
        elseif (isset ($_COOKIE['yaploud'])) {
            $this->_checkRemembered($_COOKIE['yaploud']);
        } else {
            $this->_session_defaults();
        }

    }

    function _checkLogin($username, $password, $remember) {
        $password = md5($password);
        $username = addslashes($username);
        $sql = "SELECT * FROM user WHERE userid = '$username' AND password = '$password';";
        //print "$sql<br/>\n";
        $result = $this->db->mysql_query($sql);
        if (mysql_num_rows($result) != 1) {
            // Login failed
            $this->failed = true;
            return false;
        }

        $res_obj = mysql_fetch_object($result);
        // Login successful

        // set session
        $this->_setSession($res_obj, $remember, true);

        // set remember-me cookie
        if ($remember) {
            $this->updateCookie($values->cookie, true);
        } else {
            setcookie("yaploud", "", time() - 60000);
        }

        mysql_free_result($result);
        return true;
    }

    function login($username, $password, $remember) {
        $password = md5($password);
        $username = addslashes($username);
        $sql = "SELECT * FROM user WHERE userid = '$username' AND password = '$password';";
        $result = $this->db->mysql_query($sql);
        
        if (mysql_num_rows($result) != 1) {
            // Login failed
            $this->failed = true;
            return false;
        }

        $res_obj = mysql_fetch_object($result);
        // Login successful

        // set session
        $this->_setSession($res_obj, $remember, true);

        // set remember-me cookie
        if ($remember) {
            $this->updateCookie($values->cookie, true);
        } else {
            setcookie("yaploud", "", time() - 60000);
        }

        $u['username'] = $res_obj->username;
        $u['firstname'] = $res_obj->first_name;
        $u['lastname'] = $res_obj->last_name;
        $u['email'] = $res_obj->email;
        
        mysql_free_result($result);
        
        return $u;
    }
    
    function setSessionInDb($username) {
        $username = addslashes($username);
        $sql = "SELECT * FROM user WHERE userid = '$username';";
        $result = $this->db->mysql_query($sql);
        if (mysql_num_rows($result) != 1) {
            // user not found
            $this->failed = true;
            return false;
        }

        $res_obj = mysql_fetch_object($result);

        $this->userid = $res_obj->username;

        // set session using data retrieved from database
        $_SESSION['username'] = htmlspecialchars($res_obj->username);
        $_SESSION['email'] = htmlspecialchars($res_obj->email);
        $_SESSION['logged'] = true;
        $_SESSION['userid'] = $_SESSION['username'];

        $session = session_id();
        $cookie = $session;
        $_SESSION['cookie'] = $cookie;
        $ip = $_SERVER['REMOTE_ADDR'];

        $sql = "UPDATE user SET session = \"$session\", ip = \"$ip\", cookie = \"$cookie\" WHERE " .
        "userId = \"$this->userid\";";
        $this->db->mysql_query($sql) or die("Couldn't execute query $sql");

        // update cookie with new value
        $this->updateCookie($res_obj->cookie, true);

        mysql_free_result($result);
        return true;
    }

    function _forgotPassword($email) {
        $email = addslashes($email);
        $sql = "SELECT * FROM user WHERE email ='$email';";
        //print "$sql<br/>\n";
        $result = $this->db->mysql_query($sql);
        if (mysql_num_rows($result) != 1) {
            // Email does not exist
            $this->failed = true;
            return false;
        }
        $res_obj = mysql_fetch_object($result);
        $pass = $res_obj->password; //Get your password
        $username = $res_obj->username; // Get your username
        $temp_password = "just4now";
        $new_password = md5($temp_password);
        $sql1 = "UPDATE user SET password = \"$new_password\" WHERE " .
        "username = \"$username\";";
        $this->db->mysql_query($sql1) or die("Couldn't execute query $sql1");
        $emailfrom = "info@yaploud.com";
        $message = " Hi $username,you recently requested password assistance from Yaploud.com. Your temporary password is : $temp_password. Please contact info@yaploud.com with any questions.
        				Thanks,
        				The Yaploud Team";

        if (mail($email, "Your Yaploud password", $message, "From: $emailfrom\n")) {
            mysql_free_result($result);
            return true;

        } else {
            mysql_free_result($result);
            return false;
        }
    }

    function _forgotPassword2($email) {
        $email = addslashes($email);
        $sql = "SELECT * FROM user WHERE email ='$email';";

        $result = $this->db->mysql_query($sql);
        if (mysql_num_rows($result) != 1) {
            // Email does not exist
            $this->failed = true;
            return false;
        }

        $res_obj = mysql_fetch_object($result);
        $username = $res_obj->username; // Get your username

        $t = new Token();
        $token = $t->create($username);

        $emailfrom = "info@yaploud.com";
        $message = "Hi $username, \n\n" . "You recently requested password assistance from Yaploud.com. \n" .
        "Please follow the link below to access your account and change your password. \n" .
        "If you did not make this request, please delete and ignore this email. \n\n" .
        "http://" . $_SERVER['HTTP_HOST'] . "/user/myaccount.php?token=" . $token . "\n\n" .
        "Note: This link is valid only for 24 hours.\n\n" .
        "Please contact info@yaploud.com with any questions.\n\n" .
        "Thanks, \n" .
        "The Yaploud Team";

        mysql_free_result($result);
        if (mail($email, "Your Yaploud password", $message, "From: $emailfrom\n")) {
            return $token;
        } else {
            return false;
        }
    }

    function _forgotUsername($email) {
        $email = addslashes($email);
        $sql = "SELECT * FROM user WHERE email ='$email';";

        $result = $this->db->mysql_query($sql);
        if (mysql_num_rows($result) != 1) {
            // Email does not exist
            $this->failed = true;
            return false;
        }

        $res_obj = mysql_fetch_object($result);
        $username = $res_obj->username; // Get your username

        $emailfrom = "info@yaploud.com";
        $message = "Hi $username, \n\n" . 
        "You recently requested your username from Yaploud.com. \n" .
        "Your username is $username. \n" .
        "If you did not make this request, please delete and ignore this email. \n\n" .

        "http://" . $_SERVER['HTTP_HOST'] . "/user/login.php \n\n" .

        "Please contact info@yaploud.com with any questions.\n\n" .
        "Thanks, \n" .
        "The Yaploud Team";

        mysql_free_result($result);
        if (mail($email, "Your Yaploud username", $message, 
                         "From: $emailfrom\n")) {
            return true;
        } else {
            return false;
        }
    }

    function _setSession(& $values, $remember, $init = true) {
        $this->userid = $values->username;

        //session_unset();
        //session_destroy();
        //session_start();
        
        // set session using data retrieved from database
        $_SESSION['username'] = htmlspecialchars($values->username);
        $_SESSION['email'] = htmlspecialchars($values->email);
        $_SESSION['cookie'] = $values->cookie;
        $_SESSION['logged'] = true;
        $_SESSION['userid'] = $_SESSION['username'];

        if ($init) {
            $session = session_id();
            $cookie = $session;
            $_SESSION['cookie'] = $cookie;
            $ip = $_SERVER['REMOTE_ADDR'];

            $sql = "UPDATE user SET session = \"$session\", ip = \"$ip\", cookie = \"$cookie\" WHERE " .
            "userId = \"$this->userid\";";
            $this->db->mysql_query($sql) or die("Couldn't execute query $sql");

            // update cookie with new value
            $this->updateCookie($values->cookie, true);
        }
    }

    function updateCookie($cookie, $save) {
        if ($save) {

            $sessionid = session_id();
            $cookie = serialize(array (
                $_SESSION['userid'],
                $sessionid
            ));
            setcookie('yaploud', $cookie, time() + 31104000);
        }
    }

    function _checkRemembered($cookie) {

        // retrieve user info from cookie
        list ($username, $cookie) = @ unserialize($cookie);

        if (!$username or !$cookie)
            return;

        $sql = "SELECT * FROM user WHERE " .
        "(userid = \"$username\") AND (cookie = \"$cookie\");";
        $result = $this->db->mysql_query($sql);
        $result = mysql_fetch_object($result);

        // if remember-me user is found in the database, set session for the user
        if (is_object($result)) {
            $this->_setSession($result, false, true);
        } else {
            $this->_logout();
        }
    }

    function _checkSession() {
        $username = $_SESSION['username'];
        $cookie = $_SESSION['cookie'];
        $session = session_id();
        $ip = $_SERVER['REMOTE_ADDR'];

        $sql = "SELECT * FROM user WHERE " .
        "(userId = \"$username\") AND (cookie = \"$cookie\") AND " .
        "(session = \"$session\") AND (ip = \"$ip\");";

        $result = $this->db->mysql_query($sql) or die("Couldn't query the db with sql $sql");
        $result_obj = mysql_fetch_object($result);
        mysql_free_result($result);

        if (is_object($result_obj)) {
            $this->_setSession($result_obj, false, false);
        } else {
            $this->_logout();
        }
    }

    function _logout() {
        setcookie("yaploud", "", time() - 60000);
        
        // a logout should not destroy the session
        //session_unset();
        //session_destroy();
        //session_start();

        $this->_session_defaults();	
    }

    function logout() {
        $this->_logout();
    }
    
    function _session_defaults() {
        $_SESSION['logged'] = false;
        $_SESSION['userid'] = 0;
        $_SESSION['username'] = '';
        $_SESSION['cookie'] = 0;
        $_SESSION['remember'] = false;

        if (!isset ($_SESSION['guest'])) {
            $guestId = rand(50, 9999);
            $_SESSION['guest'] = "guest" . $guestId;
        }
        
        $_SESSION['username'] = $_SESSION['guest'];
    }

    function changePassword($new_password) {
        $username = addslashes($_SESSION['username']);
        $sql = "SELECT * FROM user WHERE username ='$username';";
        $result = $this->db->mysql_query($sql);

        if (mysql_num_rows($result) != 1) {
            // user does not exist
            $this->failed = true;
            return false;
        }

        $res_obj = mysql_fetch_object($result);
        $pass = $res_obj->password; //Get your password
        $username = $res_obj->username; // Get your username

        $new_password = md5($new_password);
        $sql1 = "UPDATE user SET password = \"$new_password\" WHERE " .
        "username = \"$username\";";
        $this->db->mysql_query($sql1) or die("Couldn't execute query $sql1");
        mysql_free_result($result);
        return $username . $new_password;
    }

    function getUserInfo($username) {
        $username = addslashes($username);
        $sql = "SELECT * FROM user WHERE username ='$username';";
        $result = $this->db->mysql_query($sql);

        if (mysql_num_rows($result) != 1) {
            // user does not exist
            $this->failed = true;
            return false;
        }

        $res_obj = mysql_fetch_object($result);
        
        // user info is retrieved by
        // $res_obj->first_name;
        // $res_obj->last_name;
        // $res_obj->email;
        
        return $res_obj;
    }
    
    function updateUserInfo($username, $first_name, $last_name, $email) {
    	if ( $username == "" || $last_name == "" || 
    	     $first_name == "" || $email == "" ) {
    		return false;
    	}
    	
        $username = addslashes($username);
        $last_name = addslashes($last_name);
        $first_name = addslashes($first_name);
        $email = addslashes($email);

        $sql = "UPDATE user SET first_name = \"$first_name\", " .
               "last_name = \"$last_name\", " .
               "email = \"$email\" " .
               "WHERE username = \"$username\"; ";
        
        $this->db->mysql_query($sql) or die("Couldn't execute query $sql");
    	return true;
    }
    
} // End class User
?>
