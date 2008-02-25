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

        <?php
        if ($chatUrlInfo_result) {
         	while($row = mysql_fetch_assoc($chatUrlInfo_result)) { 
         		$url = $row['url'];
         		$yappers = $row['uniqs'];
         		$comments = $row['c'];
         		print <<<HTML
                <div class="yap_url">
                    <strong><a href="http://{$url}">http://{$url}</a></strong><br/>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
                    <div class="yap_links">
                        <a href="/"><img src="images/comment.gif" />{$yappers} yappers</a> |
                        <a href="/"><img src="images/comments.gif" />{$comments} comments</a> |
                        <a href="/"><img src="images/page.gif" />Share Yaplet</a> |
                        <a href="/"><img src="images/vote.gif" /></a>
                    </div>
                </div>
                <br/>
HTML;
         	}
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
