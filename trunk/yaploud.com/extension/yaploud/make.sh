#!/bin/sh
cd chrome
zip -r yaploud.jar content/ skin/
cd ..
zip ../../yaploud.xpi install.rdf chrome.manifest chrome/yaploud.jar

