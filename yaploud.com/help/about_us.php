<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
    //require("./home_c.inc");
?>

<html>
    <head>
        <title>About YapLoud</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" rel="stylesheet" href="/css/style.css" />
    </head>
    
    <body class="yui-skin-sam">
        <div id="container">
            <?php include("common/header1.php"); ?>
            <?php include("rightNav.php"); ?>
            
            <div id="content">
                <h3>About YapLoud</h3>
                YapLoud is a FREE service that allows web users to connect with like-minded people on the fly.
                Today, as users are surfing through the web, they are unable to interact about the web content. 
                There is no way for people to talk about its content either with the website owner or with other surfers.
                YapLoud enables this. Users can no longer be passive readers of the content. Instead, they can identify
                what other Yappers are talking about and participate in the Yapper Community. They can also participate
                with the website owners directly.
                
                YapLoud empowers surfers to influence the content on any website.
                <br/><hr/>
                
                <h3>History of YapLoud</h3>
                YapLoud idea started off with the notion of getting new parents to be able to easily connect with each other.
                The idea took incubation in Carnegie Mellon West, Mountain View, and is still its headquarters.
                Our team includes CMU West Students and Faculty.
                <br/><hr/>
                
                <h3>What people are saying about YapLoud</h3>
                
                <i>"The thing that is great about this idea is that it simply 
                 overlays the entire web rather than creating a walled garden." </i>
                    - Dean of top university
                <p>
                <i>"Where can I download this application?"</i> - Sr Product manager, WebEx
                <p>
                <i>"Can you do this? This will be great for us."</i> - Director of a Fortune 1000 company
                
            </div> <!-- content -->
            
            <?php include("common/footer1.php"); ?>
        </div> <!-- container -->
        
        <?php require("common/yui.php"); ?>
        <script type="text/javascript" src="/css/niftycube.js" ></script>
        <script type="text/javascript" src="/js/home.js" ></script>
    </body>
</html>

