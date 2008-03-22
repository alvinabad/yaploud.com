
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
  xpi = { "YapLoud": { URL: "/extension/yaploud.xpi" } };
  InstallTrigger.install(xpi);
  return false;
}

function installxpi (target) {
    var xpi = { "YapLoud": { URL: "/extension/yaploud.xpi" } };
    if (navigator.userAgent.indexOf('Firefox') != -1) {
        InstallTrigger.install(xpi);
    }
    else {
        alert("This extension works only on Firefox!");
    }
}
