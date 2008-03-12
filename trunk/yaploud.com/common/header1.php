
<script type="text/javascript">
    function strip_http() {
        var url = document.getElementById("yapurl_box");
        url.value = url.value.replace('http://', '');
    }
</script>

<!-- HEADER SECTION -->
<div id="header">

    <div class="header-top">
        <div class="header-left">
        <a href="home.php">
            <img src="/images/logo.gif" /><img src="images/home_06.gif" />
        </a>
        </div>
        <div class="header-center">
            <img src="/images/home_02.gif" /><img src="images/home_07.gif" />
        </div>

        <div class="header-right">
        <?php
            if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
                print <<<HTML
            <a href="/user/register.php"><strong>Sign Up</strong></a> | 
            <a href="/help.php">Feedback</a> | 
            <a href="/login_page.php">Log In</a>
HTML;
            }
            else {
                print <<<HTML
            <a href="/user/myaccount.php">Hi {$_SESSION['username']}</a> | 
            <a href="/user/myaccount.php">My Account</a> | 
            <a href="/help.php">Feedback</a> | 
            <a href="/login_page.php?logout=true">Log Out</a>
HTML;
            }
        ?>
            <form method="get" action="/search.php">
                <span style="margin-top:5px; margin-left: 0px;">Search:</span>
                <input name="q" id="search_box" type="text" class="Text2_b" 
                       size="16"></input>
                <img src="images/go.gif" />
            </form>
        </div>
    </div>

    <form method="get" action="/chat.php" onsubmit="strip_http(); ">
        <span>Enter URL to yap:</span>
        <input name="url" id="yapurl_box" type="text" value="http://" size="50" />
        <input type="submit" value="Go" />
    </form>
</div>



