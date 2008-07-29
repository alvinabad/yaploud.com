<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);

require_once 'db.inc';

class User {
	private $db;

	function User() {
		$this->db = new DB();
	}

	function getNumUsers() {
        $sql = "SELECT count(*) as count FROM user;";
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        $count = $res_obj->count;
        mysql_free_result($result);
        return $count;
    }
    
    function getUsers() {
    	$sql = "SELECT * FROM user order by update_timestamp";
        $result = $this->db->mysql_query($sql);
        return $result;        
    }
    function getPartnerUsers() {
    	$sql = "SELECT * FROM user where partner='dogtimemedia' order by update_timestamp";
        $result = $this->db->mysql_query($sql);
        return $result;        
    }
}
?>