#!/bin/sh

cd chrome && zip -r yaploud.jar content/ skin/ -x \*.svn/\*
cd ..
zip ../yaploud_local.xpi install.rdf chrome.manifest chrome/yaploud.jar

