<?php
require("./updateChatUrlInfo_c.inc");
?>

<html>
<head>
<title>This is the title of the web page</title>
<META name="Description" Content="This is the meta description of the web page"></meta>
<meta name="xxx" content="This is the meta description"></meta>
<meta name="yyy" content="This is the meta description"></meta>
<script type="text/javascript">
    
    function getDocumentTitle() {
        var title_tag = document.getElementsByTagName('title');
        var title = '';
        
        if ( title_tag[0] ) {
            title = title_tag[0].firstChild.nodeValue;
        }
    
        return title;
    }
    
    function getDocumentDescription() {
        var meta_tag = document.getElementsByTagName('meta');
        var name;
        var description = '';
        
        for(var i=0; i<meta_tag.length; i++) {
            name = meta_tag[i].getAttribute('name');
            description = meta_tag[i].getAttribute('content');
            
            if ( name.toLowerCase() == 'description' && description ) {
                return description;
            }
            description = '';
        }
        
        return description;
    };
    
    window.onload = function() {
        
        var title_id = document.getElementById('title');
        var url_id = document.getElementById('url');
        var description_id = document.getElementById('description');
        
        title = getDocumentTitle();
        description = getDocumentDescription();
        
        //url_id.value = encodeURIComponent(window.location.href);
        //url_id.value = window.location.href;
        //title_id.value = title;
        //description_id.value = description;
        
    }
        
</script>

</head>

<body>
<h2>Update Chat URL Info</h2>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="get" name="updateChatUrlInfo">
  <table>
  <tr>
    <td>
      <label>URL: </label>
    </td>
    <td>
      <input id="url" name="url" type="text" size="100" value="">
    </td>
  </tr>
  <tr>
    <td>
      <label>Title: </label>
    </td>
    <td>
      <input id="title" name="title" type="text" size="50" value=""> 
    </td>
  </tr>
  <tr>
    <td valign="top">
      <label>Description: </label>
    </td>
    <td>
      <textarea id="description" name="description" cols="40" rows="3"></textarea>
    </td>
  </tr>
  <tr>
    <td>
    </td>
    <td>
      <input name="update" type="submit" value="Add">
      <input name="update" type="submit" value="Update">
    </td>
  </tr>
  <tr>
    <td></td>
    <td>
      <input name="reset" type="button" value="RESET" onclick="window.location=window.location.pathname;">
    </td>
  </tr>
  </table>
  
</form>
<hr>

</body>
</html>
