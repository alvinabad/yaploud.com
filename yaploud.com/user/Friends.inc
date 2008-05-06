<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);

require_once 'db.inc';

class Friends {
	private $db;

	function Friends() {
		$this->db = new DB();
	}

	function addInvitedFriend($username, $email) {
        $username = addslashes($username);

        $sql = "SELECT userid FROM user WHERE userid = '$username'";
        $result = $this->db->mysql_query($sql);
        if (mysql_num_rows($result) != 1) {
        	error_log("User not found: " . $username);
            return false;
        }
        
        $res_obj = mysql_fetch_object($result);
        $userid = $res_obj->userid;
        mysql_free_result($result);

        $email = trim($email);
        $email = addslashes($email);
        $sql = "INSERT INTO invited_friends (userid, email) " .
               " values ('$userid', '$email')";
        $result = $this->db->mysql_query($sql);

        return true;
	}
	
	function getNumFriendsInvited() {
        $sql = "SELECT count(*) as count FROM invited_friends;";
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        $count = $res_obj->count;
        mysql_free_result($result);
        return $count;
    }
}
?>