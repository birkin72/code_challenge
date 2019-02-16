<?php
exec('php -f failover.php > /dev/null &');
 
sleep(5);

 if (exec('pgrep -x "node"')){
 	echo "pass: process started\n";
 }
 else{
 	echo "fail:procces started\n";
 }

echo "kiling node...\n";
exec('pkill -x node');


sleep(5);

 if (exec('pgrep -x "node"')){
 	echo "pass: process started after being killed\n";
 }
 else{
 	echo "fail:procces started after being killed\n";
 }

exec('pkill -9 php');
 