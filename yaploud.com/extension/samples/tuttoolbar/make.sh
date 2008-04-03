#!/bin/sh
cd chrome
zip -r tuttoolbar.jar content/ skin/
cd ..
zip tuttoolbar.xpi install.rdf chrome.manifest chrome/tuttoolbar.jar

