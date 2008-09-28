<?php
require_once 'db.inc';

class ChatMessages {
	private $db;

	function ChatMessages() {
		$this->db = new DB();
	}

    function getNumMessages() {
    	$sql = "SELECT count(*) as count FROM chat;";
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        $count = $res_obj->count;
        mysql_free_result($result);
        return $count;
    }
    function getNumMessages($partner) {
    	$sql = "SELECT count(*) as count FROM chat where topic_url like 'www.dogtimemedia.com';";
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        $count = $res_obj->count;
        mysql_free_result($result);
        return $count;
    }
    
    function getNumGuestUsers() {
    	$sql = "SELECT count(*) as count " .
    	       "FROM (select distinct submitter, topic_url from chat " .
    	       "      where submitter like 'guest%') c ";
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        $count = $res_obj->count;
        mysql_free_result($result);
        return $count;
    }
    
    function getPartnerNumGuestUsers($partner) {
    	$sql = "SELECT count(*) as count " .
    	       "FROM (select distinct submitter, topic_url from chat " .
    	       "      where submitter like 'guest%' and topic_url like '%www.dogtimemedia.com%') c ";
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        $count = $res_obj->count;
        mysql_free_result($result);
        return $count;
    }
    
	function getMessages($url, $last_msg_id) {
		$msgs = array();
		
		$url = $this->removeHttp($url);
		$url = addslashes($url);

		$query = "SELECT submitter as s, id, msg, date_format(creation_date, '%m/%d/%Y %T') as t " .
             "FROM chat WHERE id > $last_msg_id AND topic_url = '$url' " .
             "ORDER BY creation_date DESC limit 50";

		//$result = $db->mysql_query($query, $db->getConnection());
		$result = $this->db->mysql_query($query);

        if($result) {
            while($row = mysql_fetch_assoc($result)) {
                array_push($msgs, $row);
            }
            mysql_free_result($result);
		}

		return $msgs;
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