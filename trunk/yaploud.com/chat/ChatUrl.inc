<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);

require_once 'db.inc';

class ChatUrl{
	private $db;

	function ChatUrl() {
		$this->db = new DB();
	}

	function add($url, $title, $description) {
		if ($title == "") {
			$title = $url;
		}
		
        $url = normalize_url($url);
        $url = addslashes($url);

        $title = trim($title);
        $title = strip_tags($title);
        $title = addslashes($title);
    
        $description = trim($description);
        $description = strip_tags($description);
        $description = addslashes($description);
    
        $sql = "INSERT INTO dev.chat_url (url, title, description, creation_date) " .
               " values ('$url', '$title', '$description', SYSDATE() )";
        $result = $this->db->mysql_query($sql);
        if (!$result) {
        	return false;
        }
        return $result;
	}
	
	function update($url, $title, $description) {
        $url = normalize_url($url);
        $url = addslashes($url);

        $title = trim($title);
        $title = strip_tags($title);
        $title = addslashes($title);
    
        $description = trim($description);
        $description = strip_tags($description);
        $description = addslashes($description);
    
        $sql = "UPDATE dev.chat_url SET title='$title', " .
               "description='$description' " .
               "WHERE url='$url'";
        $result = $this->db->mysql_query($sql);
        if (!$result) {
        	return false;
        }
        return $result;
	}
	
	function get($url) {
        $url = normalize_url($url);
        $url = addslashes($url);
		
        $sql = "SELECT * FROM dev.chat_url WHERE url='$url';";
        $result = $this->db->mysql_query($sql);

        if (mysql_num_rows($result) != 1) {
        	return false;
        }
        return $result;
    }
	
}
?>