<?php

set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
    <head>
    <?php require("chat/yui.php"); ?>
    
        <title>Welcome to YapLoud</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" rel="stylesheet" href="/css/style.css" />
        <script type="text/javascript" src="/css/niftycube.js" ></script>
        <script type="text/javascript" src="/chat/embed_code.js" ></script>
        <script type="text/javascript">
            window.onload=function() {
                Nifty("div.yap_url, div#tagCloud","big, transparent");
            }
        </script>
        
        <style>
        textarea {
            color: gray;
            font-size: 12px;
            font-family: courier, courier-new;
        }
        </style>
        
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
            
            <h3>Put a chat window on your webpage</h3>
            <div>
                <form method="post" name="embed_form" onsubmit="generateEmbedCode(); return false;">
                <input id="url" name="url" type="text" size="50" value="http://"> 
                <input type="submit" value="Generate code">
                <br>
                <textarea rows="5" cols="55" name="text_area" id="text_area"></textarea>
                </form>
                Enter the URL of your webpage and select the generate code button.
                Copy the generated code and save it into your webpage.
            </div>
            <hr>
            <div>
            Below is a sample yaplet embedded on a webpage. Visitors of your
            site can chat directly using this embedded yaplet window.
            <p>
            <iframe src="http://www.yaploud.com/chat/chat_window.php?url=http://www.cnn.com&title=http://www.cnn.com" 
            scrolling="no" style="width:325px; height:320px" frameborder="1"></iframe>
            <p>
                    
            <!-- 
            <br>
            <div id="yaploud"></div>
             <script>yapurl="http://www.yahoo.com";</script>
             <script type="text/javascript"
               src="http://www.yaploud.com/chat/embedded_chat.js">
             </script>
            </div>
             -->
            
         </div>
            
            <?php
                // Footer page
                include("common/footer1.php"); 
            ?>
        </div>
    </body>
</html>
