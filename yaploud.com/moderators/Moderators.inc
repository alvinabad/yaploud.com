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
    	$result_obj = $this->getModerator($username, $domainname);
    	
    	if ($result_obj) {
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
        $domainname = addslashes($domainname);
    	
        $sql = "SELECT * FROM moderators WHERE " .
               "domainname = '$domainname' ";
        $result = $this->db->mysql_query($sql);
        return $result;
    }
    
    function getDomainname($url) {
    	$domain = preg_replace('/^https?:\/\//', '', $url);
    	$domain = preg_replace('/\/.*$/', '', $domain);
    	return $domain;
    }
}
?>