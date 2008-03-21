<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php
    require("./home_c.inc");
?>

<html>
    <head>
        <title>Welcome to YapLoud</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <script type="text/javascript" src="css/niftycube.js" ></script>
        <script type="text/javascript">
            window.onload=function() {
                Nifty("div.yap_url, div#tagCloud","big, transparent");
                //Nifty("div#tagCloud", "big, transparent");
            }
        </script>
  <script type="text/javascript">
   function openChatWindow(site_url, title) {
        var url = "/chat/chat_window.php?url=" + site_url +
              "&title=" + title;
       var features = "width=320, height=320, status=yes, " +
                      "menubar=no, toolbar=no, status=no, " +
                      "location=no, resizable=yes, left=600, top=100";
       window.open(url, "", features);
   }
    function strip_http() {
        var url = document.getElementById("yapurl_box");
        url.value = url.value.replace('/^http:\/\//', '');
    }
  </script>
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
    	<form method="get" action="/chat/chat_window.php">
        	<span style="color: #EE9A49; font-size: 24px;" >Enter URL to yap:</span>
        	<input name="url" id="yapurl_box" type="text" 
        	       style="background: #F0F8FF; color: blue; font-size: 20px;"
        	       value="http://" size="50" />
        	<input type="hidden" name="iframe" value="yes" />
        	<input type="submit" value="Go" />
    	</form>
        Test: <a href='javascript: openChatWindow("www.intrade.com", "www.intrade.com");'>www.intrade.com</a>
         <br>
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
        	$i = 0;
         	while($row = mysql_fetch_assoc($topicUrlInfo_result)) { 
         		$url = $row['url'];
         		$yappers = $row['uniqs'];
         		$comments = $row['c'];
         		
         		$info = getChatUrlInfo($url);
         		$title = $info['title'];
         		$description = $info['description'];
         		
         		if ($i % 2 == 0) {
                    print '<div class="yap_url even">';
         		}
                else {
                    print '<div class="yap_url odd">';
                }
                $i++;
                $url_encoded = urlencode($url);
                $title_encoded = urlencode($title);
         		print <<<HTML
         		    <b><a href="/chat/chat_window.php?url={$url_encoded}&title={$title_encoded}&iframe=yes" target="_blank">{$title}</a></b>
                    <br/>
                    <strong><a href="http://{$url}">(http://{$url})</a></strong>
                    <br>
                    {$description}
                    <div class="yap_links">
                        <a href="chat.php?url={$url}"><img src="images/comment.gif" />{$yappers} yappers</a> |
                        <a href="chat.php?url={$url}"><img src="images/comments.gif" />{$comments} comments</a> |
                        <a href="/"><img src="images/page.gif" />Share Yaplet</a> |
                        <a href="/"><img src="images/ratings/stars-4-5.gif" /></a> {$yappers} ratings
                        <br>
                        Tags: <a href="#" onclick="alert();">tag1</a>|<a href="#">tag2</a>|<a href="#">tag3</a>
                        <br>
                        <a href='javascript: openChatWindow("{$url}", "{$title}");'>Open yaplet window</a>
                        | <a href="chat.php?url={$url}">Original chat widget</a>                    
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
