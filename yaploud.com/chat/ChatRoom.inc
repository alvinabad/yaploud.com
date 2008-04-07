<?php
require_once 'db.inc';

class ChatRoom {
	private $db;

	function ChatRoom() {
		$this->db = new DB();
	}

	function removeUser($url, $username) {
		$sql = "DELETE FROM dev.room_users " .
               "WHERE topic_url = '$url' and username = '$username' "; 
		$result = $this->db->mysql_query($sql);
	}

	function addUser($url, $username) {
	    $this->updateUser($url, $username);	
	}
	
	function updateUser($url, $username) {
		$url = $this->removeHttp($url);

		$sql = "select * from dev.room_users " .
             "where topic_url = '$url' and username = '$username' "; 
		$result = $this->db->mysql_query($sql);
		
		if ($result) {
		    $num_rows = mysql_num_rows($result);
		}
		else {
			$num_rows = 0;
		}
		
		mysql_free_result($result);

		if ($num_rows > 0) {
			$sql = "UPDATE dev.room_users SET creation_date=SYSDATE() " .
                   "where topic_url = '$url' and username = '$username' "; 
			$result = $this->db->mysql_query($sql);
		}
		else {
			$sql = "INSERT INTO dev.room_users values " .
               "('$username', '$url', SYSDATE(), '')";
			$result = mysql_query($sql);
		}
	}

	function getUsers($url) {
		$users = array();

		$url = $this->removeHttp($url);
		$sql = "select distinct(username) as u, creation_date as d from dev.room_users " .
             "where topic_url = '$url'"; 
		$result = $this->db->mysql_query($sql);

		if( $result != null ) {
			while($row = mysql_fetch_assoc($result)){
				$time_lapse_since = time() - strtotime($row['d']);

				// check if less than 5 minutes
				if ($time_lapse_since < 300) {
					array_push($users, $row['u']);
				}
			}
		}
		mysql_free_result($result);
		return $users;
	}


	/**
	 * Helper functions
	 */
	function removeHttp($url) {
		$url = preg_replace('/^http:\/\//', '', $url);
		return $url;
	}


}
?>