#!/bin/sh
cd chrome
zip -r diggthis.jar content/ skin/
cd ..
zip diggthis.xpi install.rdf chrome/diggthis.jar

