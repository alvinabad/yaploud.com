<?php
require_once 'db.inc';

class Tags {
	private $db;

	function Tags() {
		$this->db = new DB();
	}

	function addTags($url, $tags) {
		$url = normalize_url($url);
		$tags = split(',', $tags);
		$url = addslashes($url);

		$sql = "SELECT id FROM dev.chat_url WHERE url ='$url';";
		$result = $this->db->mysql_query($sql);
		if (mysql_num_rows($result) != 1) {
			//error_log('URL not found:' . $url);
			return false;
		}
		$res_obj = mysql_fetch_object($result);
		$chat_url_id = $res_obj->id;

		foreach ($tags as $tag) {
			$tag = trim($tag);
			$tag = addslashes($tag);
			$sql = "INSERT INTO dev.chat_url_tag (chat_url_id, tag) " .
                   " values ('$chat_url_id', '$tag')";
			$result = $this->db->mysql_query($sql);
		}

		return true;
	}
}

?>