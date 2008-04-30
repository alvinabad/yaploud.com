

<!-- HEADER SECTION -->


<script type="text/javascript">
function isSearchValid() {
    var txt = document.search_form.query.value;
    txt = txt.replace(/^\s\s*/, '').replace(/\s\s*$/, '');  
    document.search_form.query.value = txt;
            
    if (txt == "" ) {
        return false;
    }
    else {
        return true;
    }
}
        
function submitSearch() {
    if (isSearchValid()) {
        document.search_form.submit();
    }
    else {
        window.location = "/search/find.php";
    }
}
</script>


<div id="header">
    <div class="header-top">
        <div class="header-left">
        <a href="/home.php">
            <img src="/images/logo.gif" /><img src="/images/home_06.gif" />
        </a>
        </div>
        <div class="header-center">
            <img src="/images/home_02.gif" /><img src="/images/home_07.gif" />
        </div>

        <div class="header-right">
        <?php
            if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
                print <<<HTML
            <a href="/user/register.php"><strong>Sign Up</strong></a> |
            <a href="/help/feedback.php">Feedback</a> |
            <a href="/help/faq.php">FAQ</a> |
            <a href="/user/login.php">Log In</a>
HTML;
            }
            else {
                print <<<HTML
            <a href="/user/myaccount.php">Hi {$_SESSION['username']}</a> |
            <a href="/user/myaccount.php">My Account</a> |
            <a href="/help/feedback.php">Feedback</a> |
            <a href="/help/faq.php">FAQ</a> |
            <a href="/user/login.php?logout=true">Log Out</a>
HTML;
            }
        ?>
                
        
            <form name="search_form" method="get" action="/search/find.php" onsubmit="return isSearchValid();">
                <span style="margin-top:5px; margin-left: 0px;">Search:</span>
                <input name="query" id="search_box" type="text" class="Text2_b"
                       size="16"></input>
                <a href="javascript: submitSearch();">
                  <img src="/images/go.gif" /></a>
            </form>
        </div>
       </div>
</div>
