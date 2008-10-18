<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
require_once 'db.inc';
require_once('moderators/Moderators.inc');

class BannedUsers{
    private $db;

    function BannedUsers() {
        $this->db = new DB();
    }
    
    function addIp($ip, $voter, $domainname) {
        $ip = addslashes($ip);
        $voter = addslashes($voter);
        $domainname = addslashes($domainname);

        $sql = "INSERT INTO banned_users set " .
               "ip='$ip', voter='$voter', date_created=SYSDATE(), domainname='$domainname' ";
        $result = $this->db->mysql_query($sql);
        return $result;
    }
    
    function removeIp($ip, $domainname) {
        $ip = addslashes($ip);
        $domainname = addslashes($domainname);

        $sql = "DELETE FROM banned_users WHERE " .
               "ip = '$ip' and domainname = '$domainname' ";
        $result = $this->db->mysql_query($sql);
        return $result;
    }

	function removeIp_community($ip, $voter, $domainname) {
        $ip = addslashes($ip);
        $domainname = addslashes($domainname);
		$voter = addslashes($voter);

        $sql = "DELETE FROM banned_users WHERE " .
               "ip = '$ip' and domainname = '$domainname' and voter = '$voter' ";
        $result = $this->db->mysql_query($sql);
        return $result;
	}
    
    function isIpBanned($ip, $domainname, $votes=1) {
    	$num_entries = $this->getNumIps($ip, $domainname);
    	
    	if ($this->getNumIps($ip, $domainname) >= $votes) {
    		return true;
    	}
    	
    	$md = new Moderators();
    	$result = $this->getIp($ip, $domainname);
        while($row = mysql_fetch_assoc($result)){
        	// test only:
        	if (preg_match('/^guest/', $row['voter']) == 0) {
        		return true;
        	}
        	
        	if ($md->isModerator($row['voter'], $row['domainname'])) {
        	    return true;
        	}
        }
        return false;
    }

	function isIpFlaggedByMe($ip, $domainname, $voter) {
		$num_entries = $this->getNumIps($ip, $domainname);
    	
    	$result = $this->getIp($ip, $domainname);
        while($row = mysql_fetch_assoc($result)){
        	if ($row['voter'] == $voter) {
        	    return true;
        	}
        }
        return false;
	}
    
    function getIp($ip, $domainname) {
        $ip = addslashes($ip);
        $domainname = addslashes($domainname);

        $sql = "SELECT * FROM banned_users WHERE " .
               "ip = '$ip' and domainname = '$domainname' ";
        $results = $this->db->mysql_query($sql);
        return $results;
    }
    
    function getNumIps($ip, $domainname) {
        $sql = "SELECT count(*) as count FROM banned_users WHERE " .
               "ip = '$ip' and domainname = '$domainname' ";
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        return $res_obj->count;
    }
    
    function getDomainname($url) {
        $domain = preg_replace('/^https?:\/\//', '', $url);
        $domain = preg_replace('/\/.*$/', '', $domain);
        return $domain;
    }
}
?>