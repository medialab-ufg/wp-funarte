#!/bin/bash
apt-get install unzip -y
wget -P ./wp-content/plugins/ http://tainacan.org/nightly-builds/tainacan-nightly.zip
unzip ./wp-content/plugins/tainacan-nightly.zip -d ./wp-content/plugins/

exit
