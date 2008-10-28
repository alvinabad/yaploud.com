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
                YapLoud builds and strengthens online communities by allowing for live interaction among visitors to any website.  At the intersection of Chats, Forums, and Blogs, real-time connections among all online users is now easy. Imagine reading a news article then immediately connecting with all readers with a simple button click, on any web site. Those chatting on related articles can be bought into the chat.  The community is limited to a dialogue by article or by website. You can therefore have a more dynamic environment where the community can be broadened or tightened to give the best experience to users. All of this without the hassles of IM or the limitations of blogs or traditional Forums.
                <br/><hr/>

                <h3>Who should use this software</h3>
                Online communities, portals, content sites, blogs and any other place where users want to interact should use our software. We build and strengthen online communities around your content. Users from different pages or participating web sites can easily be connected to the same chat group
                <br/><hr/>

                <h3>What are the benefits to users and our partners</h3>

                <li>Your users stay engaged on your site for longer time periods</li>
                <li>Users from different parts of your web site and other participating web sites can get connected with each other instantly</li>
                <li> Monetization opportunities, like advertisements or sponsorships for engaged community</li>

            </div> <!-- content -->

            <?php include("common/footer1.php"); ?>
        </div> <!-- container -->

        <?php require("common/yui.php"); ?>
        <script type="text/javascript" src="/css/niftycube.js" ></script>
        <script type="text/javascript" src="/js/home.js" ></script>
    </body>
</html>

