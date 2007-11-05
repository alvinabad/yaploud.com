
var xchange = 0;
var ychange = 0;

document.domain="yaploud.com";

function handleMousePressed() {

  var oEvent = EventUtil.getEvent();
  var yapframe = parent.document.getElementById("yaploudFrame");
  xchange = oEvent.clientX - yapframe.offsetLeft;
  ychange = oEvent.clientY - yapframe.offsetTop;
  
  EventUtil.addEventHandler(document.body, "mousemove", handleMouseMoved);
  EventUtil.addEventHandler(document.body, "mouseup", handleMouseUp);
  
}

function handleMouseMoved() {

  var event = EventUtil.getEvent();
  var newXPos = event.clientX - xchange;
  var newYPos = event.clientY - ychange;
  var yapframe = parent.document.getElementById("yaploudFrame");
  yapframe.style.left = newXPos;
  yapframe.style.top = newYPos;

}

function handleMouseUp() {

  EventUtil.removeEventHandler(document.body, "mousemove", handleMouseMoved);
  EventUtil.removeEventHandler(document.body, "mouseup", handleMouseUp);

}

function close_frame() {

  parent.close_frames();

}

function toggleOpacity() {

  var link = document.getElementById("hideLink");
  var chat = document.getElementById("panel1");
  
  if (link.innerHTML == "hide chat") {
    link.innerHTML = "show chat";
    parent.hideChat();
  } else {
    link.innerHTML = "hide chat";
    parent.showChat();
  }

}
