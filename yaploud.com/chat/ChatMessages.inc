<?php
require_once 'db.inc';

class ChatMessages {
	private $db;

	function ChatMessages() {
		$this->db = new DB();
	}

	function getMessages($url, $last_msg_id) {
		$msgs = array();
		$url = $this->removeHttp($url);

		$query = "SELECT submitter as s, id, msg, date_format(creation_date, '%b %D %H:%i') as t " .
             "FROM dev.chat WHERE id > $last_msg_id AND topic_url = '$url' " .
             "ORDER BY creation_date DESC limit 50";

		//$result = $db->mysql_query($query, $db->getConnection());
		$result = $this->db->mysql_query($query);

		if( $result != null ) {
			while($row = mysql_fetch_assoc($result)){
				array_push($msgs, $row);
			}
		}
		mysql_free_result($result);

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