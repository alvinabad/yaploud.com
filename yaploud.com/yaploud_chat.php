<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
  <head>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <script language="javascript" src="/js/yaploud.js"/>
  </head>
  <body>

    <div title="YapLoud.com" id="yaploud_chatWindow">
      <div id="yaploud_chatTitle">
        <input id="close-image" type="image" src="/images/close.png" alt="" title="close" onclick="yaploud_closeChat();"/>
        <input type="image" id="minimize-image" src="/images/minimize.png" alt="" title="minimize" onclick="yaploud_minimizeChat();"/>
      </div>
      <div id="yaploud_body">
        <div class="sidebar" id="left-sidebar"></div>
        <div id="yaploud_chatdiv">
          <table id="yaploud_messagesTable">
            <tbody id="yaploud_messagesTableBody"/>
          </table>
        </div>
        <div class="sidebar" id="right-sidebar"></div>
        <div id="yapper_div">
          <div id="yapper_title" class="title-text">
            Yappers
          </div>
          <div id="yapper_body">
            <table id="yapper_table">
              <tbody id="yapper_tbody"/>
            </table>
          </div>
        </div>
        <div id="yaploud_logindiv" title="Log in to post comments">
          <div id="login_title" class="title-text">
            Log in to post comments:
          </div>
          <div id="login_form">
            <form>
              Username :
              <input type="text" id="yaploud_username"/>
              <br/>
              Password :
              <input type="password" id="yaploud_password"/>
              <a href="http://www.yaploud.com/register.htm" target="_blank">
                Create an account
              </a>
              <br/>
              <input id="login_button" type="button" value="Login"/>
            </form>
          </div>
        </div>
        <div title="Chat with other YapLoud Members" id="yaploud_commentDiv">
          <div id="comment_title" class="title-text">
            Post a comment:
          </div>
          <textarea cols="99" rows="3" name="yaploud_newComment" id="yaploud_newCommentText" wrap="soft"></textarea>
	  <input id="submitComment_button" type="button" value="Submit"/>
        </div>
	<div id="bottom-image"/>
      </div>
    </div>
  </body>
</html>
