<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
require_once 'db.inc';

class Moderators {
    private $db;

    function Moderators() {
        $this->db = new DB();
    }
    
    function add($username, $domainname) {
        $username = addslashes($username);
        $domainname = addslashes($domainname);

        $sql = "INSERT INTO moderators set " .
               "username='$username', date_created=SYSDATE(), domainname='$domainname' ";
        $result = $this->db->mysql_query($sql);
        return $result;
    }
    
    function remove($username, $domainname) {
        $username = addslashes($username);
        $domainname = addslashes($domainname);

        $sql = "DELETE FROM moderators WHERE " .
               "username = '$username' and domainname = '$domainname' ";
        $result = $this->db->mysql_query($sql);
        return $result;
    }
    
    function isModerator($username, $domainname) {
    	$result1 = $this->getModerator($username, $domainname);
    	$result2 = $this->getModerator($username, 'ALL');
    	
    	if ($result1 || $result2) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }
    
    function getModerator($username, $domainname) {
        $username = addslashes($username);
        $domainname = addslashes($domainname);

        $sql = "SELECT * FROM moderators WHERE " .
               "username = '$username' and domainname = '$domainname' ";
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        mysql_free_result($result);
        
        return $res_obj;
    }
    
    function getDomains($username) {
        $username = addslashes($username);
    	
        $sql = "SELECT * FROM moderators WHERE " .
               "username = '$username' ";
        $result = $this->db->mysql_query($sql);
        return $result;
    }
    
    function getModerators($domainname) {
    	$moderators = array();
        $domainname = addslashes($domainname);
    	
        $sql = "SELECT * FROM moderators WHERE " .
               "domainname = '$domainname' OR domainname = 'ALL' ";
        $result = $this->db->mysql_query($sql);
        if($result) {
            while($row = mysql_fetch_assoc($result)) {
                array_push($moderators, $row);
            }
            mysql_free_result($result);
		}
		return $moderators;
    }
    
    function getAllModerators() {
    	$moderators = array();
    	
        $sql = "SELECT * FROM moderators order by username asc";
        $result = $this->db->mysql_query($sql);
        if($result) {
            while($row = mysql_fetch_assoc($result)) {
                array_push($moderators, $row);
            }
            mysql_free_result($result);
		}
		return $moderators;
    }
    function getAllModeratorsNames() {
    	$moderators = array();
    	
        $sql = "SELECT * FROM moderators order by username asc";
        $result = $this->db->mysql_query($sql);
        if($result) {
            while($row = mysql_fetch_assoc($result)) {
                array_push($moderators, $row['username']);
            }
            mysql_free_result($result);
		}
		return $moderators;
    }
    function getDomainname($url) {
    	$domain = preg_replace('/^https?:\/\//', '', $url);
    	$domain = preg_replace('/\/.*$/', '', $domain);
    	return $domain;
    }
}
?>