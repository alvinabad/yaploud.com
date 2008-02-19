<?php

function clean(&$str, $maxlength, &$connection){
	$input = substr($str, 0, $maxlength);
	$input = mysql_real_escape_string($input, $connection);
	return ($input);
}


class DB{
	var $connection;

	function connect($host, $user, $password){
		$link = mysql_pconnect($host, $user, $password) or die ('can not connect : ' . mysql_error()) ;
		return $link;
	}

	function DB($host = "west.yaploud.com", $user = "dev", $password = "cmuwest"){
	//function DB($host = "localhost", $user = "yaploud", $password = "yaploud"){
		$this->connection = $this->connect($host, $user, $password);
	}

	function unlock(){
		mysql_query("UNLOCK TABLES", $this->connection);
	}

	function &getConnection(){
		return $this->connection;
	}

	function showerror(){
		print "Error " . mysql_errno() . " : " . mysql_error() . "<br/>";

	}

	function mysql_query($query){
		$result = @mysql_query($query, $this->connection);
		if(!$result){
			$this->showerror();
			return null;
		}
		return $result;
	}
}

function getUrlTitle($url) {
	$html = '';
	$title = false;
	
	/**
	$fh = fopen($url, 'r');
	if ( $fh ) {
		while( !feof($fh) ) {
			$html .= fread($fh, 1048576);
		}
	}
	fclose($fh);
    **/
	
	$c = curl_init($url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	$html = curl_exec($c);
	curl_close($c);
	
	preg_match('#<title>(.+?)</title>#is', $html, $matches);
	
	$title = $matches[1];
	if ( $title == '' ) {
		return false;
	}
	
	return $title;
}

?>

