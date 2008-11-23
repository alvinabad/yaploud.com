<html>
  <head>
    <title>Yaploud Yaplet</title>
  </head>
<body>
<table>
<tr>
<td>
<div id="yaploud_yaplink"></div>
</td>
<td valign="top">
<div id="advertisement">
 <script type="text/javascript">
  <!-- 
  google_ad_client = "pub-8718455105980393"; /* in.com ad code */
  google_ad_slot = "6932164767"; 
  google_ad_width = 120; 
  google_ad_height = 240; 
  //--> 
 </script> 
 <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>	  
</td>
</tr>
</table>

<style>
     // Optional: set css style for the yaplink
     #yaplink_href_id {
     }
     .yaplink_href_class {
         font-size: 22px;
         color: brown;
     }
     #chatFrame {
         overflow:hidden;
         width:330px; 
         height:325px;
     }
 </style>

<script type="text/javascript">
     var yaploud_embedded = <?php print $yaploud_embedded; ?>; //true;
     var yaplink_name = "<?php print $yaplink_name; ?>"; //"PetChat";
     var yaploud_client = "<?php print $yaploud_client; ?>"; //"dogtimemedia";
     var yaploud_css = "<?php print $yaploud_css; ?>"; //"http://partners.dogtime.com/service_providers/yaploud/chat/chat_window.css";
 </script>
 <script type="text/javascript" src="/chat/generate_yaplet_link.js"></script>

</body>
</html>
