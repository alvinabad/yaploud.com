
function install (aEvent) {
  var params = {
    "YapLoud": { URL: aEvent.target.href,
             IconURL: aEvent.target.getAttribute("iconURL"),
             Hash: aEvent.target.getAttribute("hash"),
             toString: function () { return this.URL; }
    }
  };
  params = { "YapLoud": aEvent.target.href };
  var xpi = "/extension/yaploud.xpi";
  params = { "YapLoud": "/extension/yaploud.xpi" };
  InstallTrigger.install(xpi);
  return false;
}

function installxpi (target) {
  if (navigator.userAgent.indexOf('Firefox') != -1) {
      var xpi = { "YapLoud": 'yaploud.xpi' };
      InstallTrigger.install(xpi);
  }
  else {
      alert("This extension works only on Firefox!");
  }
}
