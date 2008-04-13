
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php
    require("./find_c.inc");
?>

<html>
<head>
  <title>Welcome to YapLoud</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
  <?php require("chat/yui.php"); ?>
    
  <script type="text/javascript" src="/css/niftycube.js" ></script>
  <script type="text/javascript" src="/js/home.js" ></script>
</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>
<?php include("rightNav.php"); ?>

<div id="content">

  <div>
    <form action="/search/find.php">
      <input type="text" size="50" name="query" value="<?php print $query_str; ?>" >
      <input type="submit" value="Search">
    </form>
  </div>
  <div>
  <?php
    $r1 = $offset+1;
    if ($r1 == 1) $r1 = 0;
    $r2 = $next;
    if ($r2 == 0) $r2=$r1;
    print <<<HTML
    <p>
    <strong>Results {$r1} - {$r2} of about {$total_url} for: <i>{$query_str}</i>
    </strong>
HTML;
  ?>
  </div>
<?php
$previous_url = $_SERVER['PHP_SELF'] . "?query=$query_str" .
                "&offset=$previous" . "&limit=$limit";

$next_url = $_SERVER['PHP_SELF'] . "?query=$query_str" . 
            "&offset=$next" . "&limit=$limit";

//--- Start pagination
print <<<HTML
  <div style="text-align: center;">
  <a href="{$previous_url}">Previous &lt</a> 
HTML;

for($x=0; $x<$num_pagelinks; $x++) {
    $jump = $x + $offset;
            $jump_url = $_SERVER['PHP_SELF'] . "?query=$query_str" .
                        "&offset=$jump" . "&" . "limit=$limit";
            
            $jump++;
            if ($jump>$total_url)
                break;
                
            print <<<HTML
              <a href="{$jump_url}">{$jump} </a>
HTML;
        }
        
        print <<<HTML
         <a href="{$next_url}">&gt; Next</a>
        </div>
HTML;
       //--- End pagination


    /*
    while($row = mysql_fetch_assoc($search_result)) { 
    	print <<<HTML
    	<br>
    	{$row['topic_url']}
HTML;
    }
    */
    
    if ($search_result) {
        $cr = new ChatRoom();
        $rt = new Rating();
        $tg = new Tags();
        $u = new Url();
            
        $i = 0;
        while($row = mysql_fetch_assoc($search_result)) { 
            // set initial/default values
            $yappers_str = 'yappers';
            $yappers = 0;
            $votes_str = "votes";
            $votes = 0;
            $tags = "";
            $rating = 3;
            $image_rating = "/images/ratings/stars-0-0.gif";
       
            $url = $row['topic_url'];
            $url = $u->stripslashes($url);
            $url = $u->decode($url);
            $url = normalize_url($url);
            
            $comments = $cu->getNumComments($url);
                
            $info = getChatUrlInfo($url);
            $title = $info['title'];
            $title = $u->stripslashes($title);
            $title = $u->decode($title);
                
            $description = $info['description'];
            $description = $u->decode($description);
                
            // get chatroom info
            $yappers = sizeof( $cr->getUsers($url) );
            if ($yappers==1) $yappers_str = 'yapper';
                
            // Get Rating info
            $votes = $rt->getVotes($url);
            $rating = $rt->getRating($url);
            $image_rating = $rt->getImage($rating);
            $rating = sprintf("%2.1f", $rating);
            if ($votes==1) $votes_str = 'vote';
                
            // Get Tag info
            $tags_array = $tg->getTags($url);
            if ($tags_array) {
                //error_log($url);
                foreach($tags_array as $tag) {
                    $tags = $tags . $tag . ", ";
                }
                $tags = rtrim($tags, ", ");
            }
                
            if ($i % 2 == 0) {
                print '<div class="yap_url even">';
            }
            else {
                print '<div class="yap_url odd">';
            }
            $i++;
                
            $comments_str = 'comments';
            if ($comments==1) $comments_str = 'comment';

            $title_display = $title;
            if ( $title_display == $url ) {
                if ( strlen($title_display) > 70 ) {
                    $title_display = substr($title_display, 0, 70) . "  ...";
                }
            }
            else if ( $title == "" ) {
                $title_display = $url;
                if ( strlen($title_display) > 70 ) {
                    $title_display = substr($title_display, 0, 70) . "  ...";
                }
            }
                
            //<b><a href="/chat/chat_window.php?url={$url_encoded}&title={$title_encoded}&iframe=yes" target="_blank">{$title}</a></b>
            $url_encoded = $u->encode($url);
            $title_encoded = $u->encode($title);
                
            print <<<HTML
                <b><a href="{$url}" target="_blank" onclick='openChatWindow("{$url_encoded}", "{$title_encoded}");'></b>
                {$title_display}</a>
                    <p>
            <span class="tags">... <i>{$row['msg']} </i> </span> <span class="yapper"> - {$row['submitter']}</span>
            <p>
HTML;
            /*****
            $description = strip_tags($description);
            $description = trim($description);
            if ($description == "") {
                $url_shortened = substr($url, 0, 60);
                //TODO: link goes here
            }
            else {
                print <<<HTML
                    {$description}
HTML;
            }
            *****/
            
                        //<img src="images/page.gif" />Share Yaplet |
                print <<<HTML
                    </p>
                    <div class="yap_links">
                        <img src="/images/comment.gif" />{$yappers}  {$yappers_str} |
                        <img src="/images/comments.gif" />{$comments} {$comments_str} |
                        Rating: <img alt="{$rating}" src="{$image_rating}" > ({$votes} {$votes_str})
                        <br>
                        <br>
                        Tags: <span class="tags">{$tags}</span>
                    </div>
                </div>
                <br/>
HTML;
            }
        //--- Start pagination
print <<<HTML
  <div style="text-align: center;">
  <a href="{$previous_url}">Previous &lt</a> 
HTML;

for($x=0; $x<$num_pagelinks; $x++) {
    $jump = $x + $offset;
            $jump_url = $_SERVER['PHP_SELF'] . "?query=$query_str" .
                        "&offset=$jump" . "&" . "limit=$limit";
            
            $jump++;
            if ($jump>$total_url)
                break;
                
            print <<<HTML
              <a href="{$jump_url}">{$jump} </a>
HTML;
        }
        
        print <<<HTML
         <a href="{$next_url}">&gt; Next</a>
        </div>
HTML;
            //--- End pagination

        }
    
?>


</div> <!-- content -->

<?php include("common/footer1.php"); ?>
</div> <!-- container -->

</body>
</html>

