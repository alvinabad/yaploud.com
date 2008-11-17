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
    function deleteLastMessages($user, $interval) {
    	$sql = "delete from dev.chat where submitter = '$user' and creation_date >= date_sub(now(), $interval);";
        $result = $this->db->mysql_query($sql);
        //$res_obj = mysql_fetch_object($result);
        //$count = $res_obj->count;
        //mysql_free_result($result);
     
    	
    }
    function getPartnerNumMessages($partner) {
    	if ($partner != "dogtimemedia") { 
    		$sql = "SELECT count(*) as count FROM chat;";
    		
    	}
    	else {
    		$sql = "SELECT count(*) as count FROM chat where topic_url like '%dogtimemedia%';";
    	}
    	
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
    	if ($partner != "dogtimemedia") { 
    		$sql = "SELECT count(*) as count " .
    	       "FROM (select distinct submitter from chat " .
    	       "      where submitter like 'guest%') c";
    	}
    	else {
    		$sql = "SELECT count(*) as count " .
    	       "FROM (select distinct submitter, topic_url from chat " .
    	       "      where submitter like 'guest%' and topic_url like '%dogtime%') c ";
    	}
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
	function getMessagesStatistics($partner,$interval) {
		if ($partner != "dogtimemedia") { 
			$sql = "SELECT count(*) as count FROM chat where creation_date >= date_sub(now(), $interval);";
		}
		else {
			$sql = "SELECT count(*) as count FROM chat where topic_url like '%dogtime%' and creation_date >= date_sub(now(), $interval);";
		}
		
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        $count = $res_obj->count;
        mysql_free_result($result);
        return $count;
	}
	function getWeeklyStatistics($partner) {
		if ($partner != "dogtimemedia") { 
			$sql = "SELECT creation_date, DAYOFWEEK(creation_date) as day,HOUR(creation_date) as hour, count(*) as sum FROM chat where creation_date >= date_sub(now(), Interval 7 Day) and creation_date < date(now()) group by day,hour order by creation_date asc;";
		}
		else {
			$sql = "SELECT creation_date, DAYOFWEEK(creation_date) as day,HOUR(creation_date) as hour, count(*) as sum FROM chat where topic_url like '%dogtime%' and creation_date >= date_sub(now(), Interval 7 Day) and creation_date < date(now()) group by day,hour order by creation_date asc;";
		}
		
		$result = $this->db->mysql_query($sql);
		return $result;
	}
	function getReportStartDay() {
		$sql = "select dayofweek(now()) as day;";
		$result = $this->db->mysql_query($sql);
		if ($row = mysql_fetch_assoc($result))
			$value = $row['day'];
		mysql_free_result($result);
		return $value;
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
