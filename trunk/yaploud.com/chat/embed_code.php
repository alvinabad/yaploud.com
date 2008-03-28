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
            
            <div>
            <h3>Insert a chat window into your web page</h3>
                <form method="post" name="embed_form1">
                <textarea name="text_area1" wrap="hard" rows="4" cols="50">
                </textarea>
                </form>
                Embed this code into your webpage to see what people are 
                chatting about your site.
            </div>
            <hr>
            <div>
                <form method="post" name="embed_form">
                You can also view chats of another site from your webpage by using the
                generated code below.
                <br>
                <input id="url" name="url" type="text" size="50" value="http://"> <button onclick="generateEmbedCode(); return false;">Generate code</button>
                <br>
                <textarea rows="5" cols="50" name="text_area" id="text_area"></textarea>
                </form>
            </div>
            <hr>
            <div>
            Here's a sample of how it will look like on your webpage:
            <div id="yaploud"></div>
<script>yapurl="http://www.yahoo.com";</script>
<script type="text/javascript"
src="http://www.yaploud.com/chat/embedded_chat.js">
</script>
            
            </div>
            
         </div>
            
            <?php
                // Footer page
                include("footer.php"); 
            ?>
        </div>
    </body>
</html>
