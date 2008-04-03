
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
            $i = 0;
            while($row = mysql_fetch_assoc($topicUrlInfo_result)) { 
                $url = $row['url'];
                $yappers = $row['uniqs'];
                $comments = $row['c'];
                
                $info = getChatUrlInfo($url);
                $title = $info['title'];
                $description = $info['description'];
                
                $yappers = sizeof( $cr->getUsers($url) );
    
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
                
                if ( $title == normalize_url($url) ) {
                    $title = substr($title, 0, 65);
                }
                print <<<HTML
                    <b><a href="/chat/chat_window.php?url={$url_encoded}&title={$title_encoded}&iframe=yes" target="_blank">{$title}</a></b>
                    <p>
HTML;
            $description = strip_tags($description);
            $description = trim($description);
            if ($description == "") {
                $url_shortened = substr($url, 0, 60);
                print <<<HTML
                    <a href="http://{$url}">[http://{$url_shortened}]</a>
HTML;
            }
            else {
                print <<<HTML
                    <a href="http://{$url}">{$description}</a>
HTML;
            }
                    
                print <<<HTML
                    </p>
                    <div class="yap_links">
                        <a href=""><img src="images/comment.gif" />{$yappers}  {$yappers_str}</a> |
                        <a href=""><img src="images/comments.gif" />{$comments} {$comments_str}</a> |
                        <a href=""><img src="images/page.gif" />Share Yaplet</a> |
                        <a href=""><img src="images/ratings/stars-4-5.gif" /></a> {$comments} ratings
                        <br>
                        Tags: <a href="#" onclick="alert();">tag1</a>|<a href="#">tag2</a>|<a href="#">tag3</a>
                        <br>
                        <a href='javascript: openChatWindow("{$url}", "{$title}");'>Open chat window</a>
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

