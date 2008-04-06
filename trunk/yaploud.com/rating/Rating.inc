<?php
require_once 'db.inc';

class Rating {
	private $db;

	function Rating() {
		$this->db = new DB();
	}

	function updateRating($url, $rating) {
		$url = normalize_url($url);
		$url = addslashes($url);

		if ($rating < 0 || $rating > 5) {
			error_log("Incorrect rating was passed: " . $rating);
		    return false;
		}
		    
        $sql = "UPDATE dev.chat_url SET " .
               //"average_rating = '$average_rating', " .
               "average_rating = (average_rating*votes + '$rating')/(votes+1) , " .
               "votes = votes+1 " .
               "WHERE url = '$url' ";
        
        $result = $this->db->mysql_query($sql);
        
        if (!$result) {
			error_log("Error updating rating for: " . $url);
        	return false;
        }
        
		return true;
	}

	function getRating($url) {
        $url = normalize_url($url);
        
        $sql = "SELECT average_rating FROM dev.chat_url WHERE url ='$url';";
        $result = $this->db->mysql_query($sql);
        if (mysql_num_rows($result) != 1) {
            //error_log('URL not found:' . $url);
            return false;
        }
        $res_obj = mysql_fetch_object($result);
        $rating = $res_obj->average_rating;
        
        mysql_free_result($result);
        return $rating;
	}

	function getVotes($url) {
        $url = normalize_url($url);
        
        $sql = "SELECT votes FROM dev.chat_url WHERE url ='$url';";
        $result = $this->db->mysql_query($sql);
        if (mysql_num_rows($result) != 1) {
            //error_log('URL not found:' . $url);
            return false;
        }
        $res_obj = mysql_fetch_object($result);
        $votes = $res_obj->votes;
                
        mysql_free_result($result);
        return $votes;
    }
}

?>