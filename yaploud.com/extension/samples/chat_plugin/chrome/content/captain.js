function makeRequest(url, parameters) {
   http_request = false;
   http_request = new XMLHttpRequest();
   if (http_request.overrideMimeType) {
      http_request.overrideMimeType('text/xml');
   }
   if (!http_request) {
      alert('Cannot create XMLHTTP instance');
      return false;
   }
   http_request.onreadystatechange = alertContents;
   http_request.open('GET', url + parameters, true);
   http_request.send(null);
}

function alertContents() {
   if (http_request.readyState == 4) {
      if (http_request.status == 200) {

         var xmlobject = http_request.responseXML;
         var root = xmlobject.getElementsByTagName('rss')[0];
         var channels = root.getElementsByTagName("channel");
         var items = channels[0].getElementsByTagName("item");
         var descriptions = items[0].getElementsByTagName("description");
         var date = items[0].getElementsByTagName("pubDate");
         
         var desc = descriptions[0].firstChild.nodeValue;
         var descarray = desc.split("|");
         var temp = descarray[0];
         var temparray = temp.split(":");
         var temperature = temparray[1];
         var update = date[0].firstChild.nodeValue;
         var tooltipstring = update + ": " + descarray[3];

         document.getElementById('mypanel').label = "Alvin: " + temperature;
         document.getElementById('mypanel').tooltipText = "xxx"; //tooltipstring;

      } else {
         alert('There was a problem with the request.');
      }
   }
}

function alertAlvin() {
	//alert("Hello, alvin");
	window.open("http://www.yaploud.com/home.php");
}

function updateweather() {
   //makeRequest('http://www.wunderground.com/auto/rss_full/global/stations/16239.xml', '');
   //self.setTimeout('updateweather()', 900000);
   //self.setTimeout(alertAlvin, 3000);
   var btn;
   btn = document.getElementById('mypanel');
   btn.addEventListener('click', alertAlvin, false);
}

window.addEventListener("load", updateweather, false);

