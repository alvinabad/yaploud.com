<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);

require_once 'db.inc';

class ChatUrl {
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

		$sql = "INSERT INTO chat_url (url, title, description, creation_date) " .
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

		$sql = "UPDATE chat_url SET title='$title', " .
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

		$sql = "SELECT * FROM chat_url WHERE url='$url';";
		$result = $this->db->mysql_query($sql);

		return $result;
	}

	function getNumUrls() {
        $sql = "SELECT count(*) as count FROM chat_url;";
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        $count = $res_obj->count;
        mysql_free_result($result);
        return $count;
    }
	
    function getNumComments($url) {
        $url = normalizeURL($url);
        $url = addslashes($url);

        $sql = "SELECT count(*) as count FROM chat WHERE topic_url='$url';";
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        $count = $res_obj->count;
        mysql_free_result($result);
        return $count;
    }

	function isExist($url) {
		$url = normalize_url($url);
		$url = addslashes($url);

		$sql = "SELECT * FROM chat_url WHERE url='$url';";
		$result = $this->db->mysql_query($sql);

		if (mysql_num_rows($result) != 1) {
			return false;
		}

		mysql_free_result($result);
		return $result;
	}

	function findMsg($query_str, $offset, $limit) {
		$query_str = trim($query_str);
		$query_str = addslashes($query_str);
			
		if ($limit == 0 && $offset == 0) {
			$sql = "SELECT * FROM chat WHERE MATCH (msg) " .
                   "AGAINST ('$query_str' IN BOOLEAN MODE)";
		}
		else {
			$sql = "SELECT * FROM chat WHERE MATCH (msg) " .
                   "AGAINST ('$query_str' IN BOOLEAN MODE) limit $offset, $limit";
		}

		$result = $this->db->mysql_query($sql);
		return $result;
	}

    function findUrl($query_str, $offset, $limit) {
        $query_str = trim($query_str);
        $query_str = addslashes($query_str);
            
        if ($limit == 0 && $offset == 0) {
            $sql = "SELECT * FROM chat_url WHERE " .
                   "url LIKE '%$query_str%' " .
                   "OR MATCH (title) " .
                   "AGAINST ('$query_str' IN BOOLEAN MODE)";
        }
        else {
            $sql = "SELECT * FROM chat_url WHERE " .
                   "url LIKE '%$query_str%' " .
                   "OR MATCH (title) " .
                   "AGAINST ('$query_str' IN BOOLEAN MODE) " .
                   "LIMIT $offset, $limit";
        }

        $result = $this->db->mysql_query($sql);
        return $result;
    }
        
    function findUrlByTag($tags, $offset, $limit) {
        $tags = trim($tags);
        $tags = addslashes($tags);
            
        if ($limit == 0 && $offset == 0) {
            $sql = "SELECT cu.* FROM chat_url cu natural join chat_url_tag ct " .
                   "WHERE MATCH (ct.tag) AGAINST ('$tags' IN BOOLEAN MODE) ";
        }
        else {
            $sql = "SELECT cu.* FROM chat_url cu natural join chat_url_tag ct " .
                   "WHERE MATCH (ct.tag) AGAINST ('$tags' IN BOOLEAN MODE) " .
                   "LIMIT $offset, $limit";
        }
        
        $result = $this->db->mysql_query($sql);
        return $result;        
    }
    
    function getCountFindUrlByTag($tags) {
        $sql = "SELECT count(*) as count FROM " .
               "(SELECT cu.* FROM chat_url cu natural join chat_url_tag ct " .
               "WHERE MATCH (ct.tag) AGAINST ('$tags' IN BOOLEAN MODE)) d ";
        
        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        $count = $res_obj->count;
        mysql_free_result($result);
        
        return $count;
    }
    
    
    function getCountFindUrl($query_str) {
        $sql = "SELECT count(*) as count from ". 
               "(SELECT url FROM chat_url WHERE " .
               "url LIKE '%$query_str%' " .
               "OR MATCH (title) " .
               "AGAINST ('$query_str' IN BOOLEAN MODE)) d";

        $result = $this->db->mysql_query($sql);
        $res_obj = mysql_fetch_object($result);
        $count = $res_obj->count;
        mysql_free_result($result);
        
        return $count;
    }
    
    function getCountFindMsg($query_str) {
		$sql = "SELECT count(*) as count from ". 
               "(SELECT  topic_url FROM chat WHERE MATCH (msg) " .
                        "AGAINST ('$query_str' IN BOOLEAN MODE)) d";

		$result = $this->db->mysql_query($sql);
		$res_obj = mysql_fetch_object($result);
		$count = $res_obj->count;
        mysql_free_result($result);
		
		return $count;
	}
}
?>