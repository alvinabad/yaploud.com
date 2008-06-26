<?php
require_once 'db.inc';
require_once 'chat/BannedUsers.inc';

class ChatRoom {
	private $db;

	function ChatRoom() {
		$this->db = new DB();
	}

	function removeUser($url, $username) {
		$u = new Url();
		$url = $u->removeHttp($url);
		$url = $u->addslashes($url);
		
		$sql = "DELETE FROM room_users " .
               "WHERE topic_url = '$url' and username = '$username' "; 
		$result = $this->db->mysql_query($sql);
	}

	function addUser($url, $username, $ip) {
	    $this->updateUser($url, $username, $ip);	
	}
	
	function updateUser($url, $username, $ip) {
		$url = $this->removeHttp($url);
		$url = addslashes($url);
		$ip = addslashes($ip);

		$sql = "select * from room_users " .
             "where topic_url = '$url' and username = '$username' "; 
		$result = $this->db->mysql_query($sql);
		
		if ($result) {
		    $num_rows = mysql_num_rows($result);
    		mysql_free_result($result);
		}
		else {
			$num_rows = 0;
		}
		

		if ($num_rows > 0) {
			$sql = "UPDATE room_users SET creation_date=SYSDATE() " .
                   "where topic_url = '$url' and username = '$username' "; 
			$result = $this->db->mysql_query($sql);
		}
		else {
			$sql = "INSERT INTO room_users set " .
               "username= '$username', topic_url = '$url', " .
			   "creation_date = SYSDATE(), session = '$ip' ";
			$result = mysql_query($sql);
		}
	}

	function getUsers_old($url) {
		$users = array();
		$url = $this->removeHttp($url);
		
		$url = addslashes($url);

		$sql = "SELECT distinct(username) as u, creation_date as d, " .
		       "session as ip " .
		       "from room_users " .
               "where topic_url = '$url'"; 
		$result = $this->db->mysql_query($sql);

		if( $result != null ) {
			while($row = mysql_fetch_assoc($result)){
				$time_lapse_since = time() - strtotime($row['d']);

				// check if less than 5 minutes
				if ($time_lapse_since < 300) {
					$user = $row['u'];// . " " . $row['ip'];
					array_push($users, $user);
				}
			}
            mysql_free_result($result);
		}
		return $users;
	}

    function getUsers($url) {
        $bu = new BannedUsers();
        $users = array();
        $url = $this->removeHttp($url);
        
        $url = addslashes($url);

        $sql = "SELECT distinct(username) as name, creation_date as date, " .
               "session as ip " .
               "from room_users " .
               "where topic_url = '$url'"; 
        $result = $this->db->mysql_query($sql);

        if( $result != null ) {
            while($row = mysql_fetch_assoc($result)){
                $time_lapse_since = time() - strtotime($row['date']);

                // check if less than 5 minutes
                if ($time_lapse_since < 300) {
                    $domainname = $bu->getDomainname($url);
                    $row['banned'] = $bu->isIpBanned($row['ip'], $domainname);
                    $user = $row;
                    array_push($users, $user);
                }
            }
            mysql_free_result($result);
        }
        return $users;
    }

	function getNumActiveUsers() {
        $users = array();

        $sql = "SELECT username as u, creation_date as d " .
               "FROM room_users group by username order by d desc ";
        $result = $this->db->mysql_query($sql);

        if( $result != null ) {
            while($row = mysql_fetch_assoc($result)){
                $time_lapse_since = time() - strtotime($row['d']);

                // check if less than 5 minutes
                if ($time_lapse_since < 300) {
                    array_push($users, $row['u']);
                }
                else {
                	break;  // once this is detected, the rest is out-dated.
                	        // no need to scan all records.
                }
            }
            mysql_free_result($result);
        }
        return sizeof($users);
    }

    function getNumActiveGuests() {
        $users = array();

        $sql = "SELECT username as u, creation_date as d " .
               "FROM room_users " .
               "WHERE username like 'guest%' " .
               "GROUP BY username ORDER BY d desc ";
        $result = $this->db->mysql_query($sql);

        if( $result != null ) {
            while($row = mysql_fetch_assoc($result)){
                $time_lapse_since = time() - strtotime($row['d']);

                // check if less than 5 minutes
                if ($time_lapse_since < 300) {
                    array_push($users, $row['u']);
                }
                else {
                    break;  // once this is detected, the rest is out-dated.
                            // no need to scan all records.
                }
            }
            mysql_free_result($result);
        }
        return sizeof($users);
    }

    function getNumActiveRooms() {
        $rooms = array();

        $sql = "SELECT username as u, creation_date as d, topic_url " .
               "FROM room_users order by d desc";
        $result = $this->db->mysql_query($sql);

        if( $result != null ) {
            while($row = mysql_fetch_assoc($result)){
                $time_lapse_since = time() - strtotime($row['d']);

                // check if less than 5 minutes
                if ($time_lapse_since < 300) {
                    array_push($rooms, $row['u']);
                }
                else {
                	break;  // once this is detected, the rest is out-dated.
                	        // no need to scan all records.
                }
            }
            mysql_free_result($result);
        }
        return sizeof($rooms);
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