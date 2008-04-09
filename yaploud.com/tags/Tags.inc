<?php
require_once 'db.inc';
require "chat/ChatUrl.inc";

class Tags {
	private $db;

	function Tags() {
		$this->db = new DB();
	}

	function addTags($url, $tags) {
		$url = normalize_url($url);
		$url = addslashes($url);
		
		$tags = split(',', $tags);

		$sql = "SELECT id FROM dev.chat_url WHERE url ='$url';";
		$result = $this->db->mysql_query($sql);
		if (mysql_num_rows($result) != 1) {
            $cu = new ChatUrl();
            $cu->add($url, "", "");
   	        $sql = "SELECT id FROM dev.chat_url WHERE url ='$url';";
	        $result = $this->db->mysql_query($sql);
            if (mysql_num_rows($result) != 1) {
                error_log('Cannot add new url: ' . $url);
                return false;
            }
        }
		
		$res_obj = mysql_fetch_object($result);
		$chat_url_id = $res_obj->id;
        mysql_free_result($result);

		foreach ($tags as $tag) {
			$tag = trim($tag);
			$tag = addslashes($tag);
			$sql = "INSERT INTO dev.chat_url_tag (chat_url_id, tag) " .
                   " values ('$chat_url_id', '$tag')";
			$result = $this->db->mysql_query($sql);
		}

		return true;
	}
	
	function getTags($url) {
        $url = normalize_url($url);
		$url = addslashes($url);
        
        $sql = "SELECT id FROM dev.chat_url WHERE url ='$url';";
        $result = $this->db->mysql_query($sql);
        if (mysql_num_rows($result) != 1) {
            //error_log('URL not found:' . $url);
            return false;
        }
        $res_obj = mysql_fetch_object($result);
        $chat_url_id = $res_obj->id;
        
        $sql = "SELECT tag FROM dev.chat_url_tag WHERE chat_url_id ='$chat_url_id' order by tag asc";
        $result = $this->db->mysql_query($sql);

        $tags = array();
        if( $result != null ) {
            while($row = mysql_fetch_assoc($result)){
				array_push($tags, $row['tag']);
            }
            mysql_free_result($result);
        }
        
        return $tags;
	}
}

?>