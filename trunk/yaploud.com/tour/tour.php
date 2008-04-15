<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
    <head>
        <title>Welcome to YapLoud</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" rel="stylesheet" href="/css/style.css" />
        <script type="text/javascript" src="/css/niftycube.js" ></script>
        <script type="text/javascript">
            window.onload=function() {
                //alert("test");
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
                <div id="flashTour">
                    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
                            width="700"
                            height="540"
                            id="slideshow"
                            align="">
                        <param name=movie value="/tour/ext-libs/slideshow.swf?xml_source=/tour/tours.xml&license=GUBS-15J1D6YCSNLRTO9DN6IKN49JK">
                        <param name=quality value=high>

                        <embed src="/tour/ext-libs/slideshow.swf?xml_source=/tour/tours.xml&license=GUBS-15J1D6YCSNLRTO9DN6IKN49JK"
                                quality="high"
                                width="700"
                                height="540"
                                name="slideshow"
                                align=""
                                type="application/x-shockwave-flash"
                                pluginspage="http://www.macromedia.com/go/getflashplayer">
                        </embed>
                    </object>
                </div>
            </div>

            <?php
                // Footer page
                include("common/footer1.php");
            ?>
        </div>
    </body>
</html>
