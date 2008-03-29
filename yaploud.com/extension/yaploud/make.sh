#!/bin/sh

cd chrome && zip -r yaploud.jar content/ skin/ -x \*.svn/\*
cd ..
zip ../yaploud.xpi install.rdf chrome.manifest chrome/yaploud.jar

