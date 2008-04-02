<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php
    require("./home_c.inc");
    require("chat/ChatRoom.inc");
?>

<html>
  <head>
    <title>Welcome to YapLoud</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link type="text/css" rel="stylesheet" href="/css/style.css" />
    <script type="text/javascript" src="/css/niftycube.js" ></script>
    <script type="text/javascript" src="/js/yui/build/yahoo/yahoo-min.js" ></script>
    <script type="text/javascript" src="/js/yui/build/event/event-min.js" ></script>
    <script type="text/javascript" src="/js/home.js" ></script>
  </head>

    <body>
        <div id="container">
			<?php
    			// Logo - Header
				include("common/header1.php");
			?>

            <!--
            <div id="leftnav">
                <p>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
                </p>
            </div>
            -->

			<?php
    			// Right Navigation Panel
				include("rightNav.php");
			?>

            <div id="content">
        <!-- 
    	<div id="sort_tabs">
    	<a id="most_yaps" href="javascript: void 0;">Most yaps</a> |
    	<a id="most_recentyaps" href="javascript: void 0;">Most recent</a> |
    	<a id="most_numberyaps" href="javascript: void 0;">Most number of yappers</a>
    	</div>
         -->    
    	
    	<a href="http://www.kampyle.com" style="cursor:hand;cursor:pointer;" 
    	   onclick="javascript:window.open('http://www.kampyle.com/feedback_form/ff-feedback-form.php?site_code=6247727&url='+encodeURIComponent(window.location.href), 'kampyle_ff','left='+((window.screenX||window.screenLeft)+10)+',top='+((window.screenY||window.screenTop)+10)+',height=490px,width=440px,resizable=false');return false;"><img src="/images/button-gray.gif" alt="Give Feedback"></a>
         <br/>
    	<form method="get" action="/chat/chat_window.php">
        	<span style="color: #EE9A49; font-size: 24px;" >Enter URL to yap:</span>
        	<br>
        	<input name="url" id="yapurl_box" type="text" 
        	       style="background: #F0F8FF; color: blue; font-size: 20px;"
        	       value="http://" size="45" />
        	<input type="hidden" name="iframe" value="yes" />
        	<input type="submit" value="Go" />
    	</form>
    	
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
                
         		print <<<HTML
         		    <b><a href="/chat/chat_window.php?url={$url_encoded}&title={$title_encoded}&iframe=yes" target="_blank">{$title}</a></b>
                    <br/>
                    <strong><a href="http://{$url}">(http://{$url})</a></strong>
                    <br>
                    {$description}
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

            <?php
                // Footer page
                include("common/footer1.php");
            ?>
        </div>
    </body>
</html>
