
<!-- Most Discussed -->
<div>
<?php
$previous_url = $_SERVER['PHP_SELF'] . "?offset=$previous" . "&" . "limit=$limit";
$next_url = $_SERVER['PHP_SELF'] . "?offset=$next" . "&" . "limit=$limit";
        
//--- Start pagination
print <<<HTML
  <div style="text-align: center;">
  <a href="{$previous_url}">Previous &lt</a> 
HTML;

for($x=0; $x<$num_pagelinks; $x++) {
    $jump = $x + $offset;
            $jump_url = $_SERVER['PHP_SELF'] . "?offset=$jump" . "&" . "limit=$limit";
            
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
       
        if ($topicUrlInfo_result) {
            $cr = new ChatRoom();
            $rt = new Rating();
            $tg = new Tags();
            
            $i = 0;
            while($row = mysql_fetch_assoc($topicUrlInfo_result)) { 
                $url = $row['url'];
                $yappers = $row['uniqs'];
                $comments = $row['c'];
                
                $info = getChatUrlInfo($url);
                $title = $info['title'];
                $description = $info['description'];
                
                $yappers = sizeof( $cr->getUsers($url) );
                
                // Get Rating info
                $votes = $rt->getVotes($url);
                $rating = $rt->getRating($url);
                $image_rating = $rt->getImage($rating);
                $rating = sprintf("%2.1f", $rating);
    
                // Get Tag info
                $tags = "";
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
                $url_encoded = urlencode($url);
                $title_encoded = urlencode($title);
                
                $yappers_str = 'yappers';
                if ($yappers==1) $yappers_str = 'yapper';
                
                $comments_str = 'comments';
                if ($comments==1) $comments_str = 'comment';

                $votes_str = "votes";
                if ($votes==1) $votes_str = 'vote';
                
                $norm_url = normalize_url($url);
                if ( $title == normalize_url($url) ) {
                    $title = substr($title, 0, 65);
                }
                else if ( $title == "" ) {
                	$title = normalize_url($url);
                }
                
                //<b><a href="/chat/chat_window.php?url={$url_encoded}&title={$title_encoded}&iframe=yes" target="_blank">{$title}</a></b>
                print <<<HTML
                <b><a href='javascript: openChatWindow("{$url_encoded}", "{$title_encoded}"); document.location="{$norm_url}";'></b>
                {$title}</a>
                    <p>
HTML;
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
            
                        //<img src="images/page.gif" />Share Yaplet |
                print <<<HTML
                    </p>
                    <div class="yap_links">
                        <img src="images/comment.gif" />{$yappers}  {$yappers_str} |
                        <img src="images/comments.gif" />{$comments} {$comments_str} |
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
            $jump_url = $_SERVER['PHP_SELF'] . "?offset=$jump" . "&" . "limit=$limit";
            
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
        </div>

