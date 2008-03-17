<?php

?>

<html>
  <head>
    <title>YapLoud.com</title>
    <style type="type/text">
    #chat_widget_frame {
      position: absolute;
      width: 600px;
      height: 500px;
      background: transparent;
      right: 30px;
      top: 0px;
    }
    
    </style>
  </head>
  <body>
  
      <div id="mainPageDiv">
      <iframe id="mainDocumentFrame" src="<?php print($url); ?>" height="100%" width="100%" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0">
      </iframe>
    </div>
    <iframe id="yaploudFrame" src="http://www.yaploud.com/chat_frame.php?url=<?php print($url); ?>" frameborder="0" scrolling="no" allowtransparency="true" style="position:absolute;width:585px;height:470px;right:30px;top:0px;background:transparent;">
    </iframe>
  
  
  <!-- 
        <div>
      <iframe id="mainDocumentFrame" src="http://www.cmu.edu" 
              height="100%" width="100%" frameborder="0" marginwidth="0" 
              marginheight="0" vspace="0" hspace="0">
      </iframe>
      </div>
    <iframe id="chat_widget_frame" src="/chat/chat_widget.php?url=http://www.cmu.edu" 
            frameborder="0" scrolling="no" allowtransparency="true" >
    </iframe>
   -->
    
</body>
</html>
