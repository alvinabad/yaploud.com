<?php
require_once 'db.inc';
require('chat/ChatUrl.inc');

class Rating {
	private $db;

	function Rating() {
		$this->db = new DB();
	}

	function updateRating($url, $rating) {
		$url = normalize_url($url);

		if ($rating < 0 || $rating > 5) {
			error_log("Incorrect rating was passed: " . $rating);
		    return false;
		}
		    
		// check if url exists
		$cu = new ChatUrl();
		$result = $cu->isExist($url);
		if (!$result) {
			error_log("DOES NOT EXIST");
			$cu->add($url,"", "");
		}
		error_log("EXIST");
		
		$url = addslashes($url);
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
		$url = addslashes($url);
        
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
		$url = addslashes($url);
        
        $sql = "SELECT votes FROM dev.chat_url WHERE url ='$url';";
        $result = $this->db->mysql_query($sql);
        if (mysql_num_rows($result) != 1) {
            //error_log('URL not found:' . $url);
            return 0;
        }
        $res_obj = mysql_fetch_object($result);
        $votes = $res_obj->votes;
                
        mysql_free_result($result);
        return $votes;
    }
    
    function getImage($rating) {
        if ($rating > 4.75) {
            $img = '/images/ratings/stars-5-0.gif';
        }
        else if ($rating > 4.25) {
            $img = '/images/ratings/stars-4-5.gif';
        }
        else if ($rating > 3.75) {
            $img = '/images/ratings/stars-4-0.gif';
        }
        else if ($rating > 3.25) {
            $img = '/images/ratings/stars-3-5.gif';
        }
        else if ($rating > 2.75) {
            $img = '/images/ratings/stars-3-0.gif';
        }
        else if ($rating > 2.25) {
            $img = '/images/ratings/stars-2-5.gif';
        }
        else if ($rating > 1.75) {
            $img = '/images/ratings/stars-2-0.gif';
        }
        else if ($rating > 1.25) {
            $img = '/images/ratings/stars-1-5.gif';
        }
        else if ($rating > 0.75) {
            $img = '/images/ratings/stars-1-0.gif';
        }
        else if ($rating > 0.25) {
            $img = '/images/ratings/stars-0-5.gif';
        }
        else {
            $img = '/images/ratings/stars-0-0.gif';
        }
        
        return $img;
    }
    
}

?>