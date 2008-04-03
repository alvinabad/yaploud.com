#!/bin/sh
cd chrome
zip -r statusbar.jar content/ skin/
cd ..
zip statusbar.xpi install.rdf chrome/statusbar.jar

