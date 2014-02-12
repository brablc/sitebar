#!/bin/bash

if [ -z "$1" ]
then
  $0 DO >switch.inc.php
  exit
fi

echo '<?php'
echo 'switch (str_replace(" ","",$_REQUEST["command"])) {'

for WORKER in `ls -1 worker_*.inc.php|grep -v other`
do
  BASENAME=`echo $WORKER | sed 's/worker_\([A-z]*\)\.inc\.php/\1/'`
  grep "function command" $WORKER | sed 's/.*function command\([A-z]*\).*/case "\1": $worker="'$BASENAME'";break;/'
done

echo 'default: $worker="other";';
echo '}'
