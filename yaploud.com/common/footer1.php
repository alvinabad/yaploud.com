<!-- FOOTER SECTION -->
<?php
    list($usec, $sec) = explode(" ", microtime());
    $end_time = (float)$usec + (float)$sec;
    $elapsed_time = $end_time - $start_time;
?>

<div id="footer">
    <div class="footer-left">
        <p class="align-left">
            Copyright &copy; 2008 <strong>YapLoud.com</strong>
        </p>
    </div>
    <div class="footer-right">
        <p class="align-right">
            <a href="/user/Terms_of_Use.pdf">Terms of use</a> |
            <a href="/user/Privacy_Policy.pdf">Privacy Statement</a> |
            <a href="/help/about_us.php">About us</a>
        </p>
    </div>
</div>

<div style="clear: both; font-size: 10px;">
<?php
    if (isset($elapsed_time)) {
    	//print $elapsed_time;
    }
?>
</div>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-2224520-1";
urchinTracker();
</script>
