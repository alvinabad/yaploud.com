<?

function normalizeURL($url){
   $url = preg_replace('/^http:\/\//', '', $url);
   if(preg_match('/\/$/', $url)){
      $url = substr($url, 0, -1);
   }
   return $url;
}

?>
