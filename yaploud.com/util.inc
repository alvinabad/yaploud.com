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

?>
