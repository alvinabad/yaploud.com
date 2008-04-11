<?

function normalizeURL($url){
	$url = preg_replace('/^http:\/\//', '', $url);
	if(preg_match('/\/$/', $url)){
		$url = substr($url, 0, -1);
	}
	return $url;
}

function normalize_url($url) {
	// trim spaces
	$url = trim($url);

	// remove trailing slash
	$url = preg_replace('/([a-zA-Z0-9_-])\/$/', '$1', $url);

	// append http if not present
	if ( !preg_match('/^http:/', $url) ) {
		$url = 'http://' . $url;
	}
	return $url;
}

class Url {
	// append http if not present
	function addHttp($url) {
		if ( substr($url, 0,4) != "http" ) {
			$url = 'http://' . $url;
		}
		return $url;
	}

	function normalize($url) {
		// trim spaces
		$url = trim($url);

		// remove trailing slash
		$url = preg_replace('/([a-zA-Z0-9_-])\/$/', '$1', $url);

		// append http if not present
		if ( !preg_match('/^http:/', $url) ) {
			$url = 'http://' . $url;
		}
		return $url;
	}

	// decode url completely
	function decode($url) {
		$new_url = rawurldecode($url);
		if ($new_url == $url) {
			return $url;
		}
		return $this->decode($new_url);
	}

	// stripslashes completely
	function stripslashes($url) {
		$new_url = stripslashes($url);
		if ($new_url == $url) {
			return $url;
		}
		return $this->stripslashes($new_url);
	}

	// encode url only once
	function encode($url) {
		$url = $this->decode($url);
		return rawurlencode($url);
	}

	// add slash only once
	function addslashes($url) {
		$url = $this->stripslashes($url);
		return addslashes($url);
	}
}
?>
