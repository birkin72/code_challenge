<?php

$max_api_attemps = 0;

function client_call(){
	global $max_api_attemps;
	echo "try calling api...\n";
	$curl = curl_init();
	curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://127.0.0.1:8081/',
    CURLOPT_HEADER=>false,
    CURLOPT_VERBOSE=>false,
    CURLOPT_CONNECTTIMEOUT=>0,
    CURLOPT_NOSIGNAL=>true,
	));

	$result = curl_exec($curl);

	if(curl_errno($curl)){
	    if ($max_api_attemps < 35000){
	    	$max_api_attemps++;
	    	return client_call();	
	    }
	    
	}
	else{
        	echo "API results...\n".$result;
	}
	curl_close ($curl);
}

//First call to api
client_call();
echo "\n";

echo "kiling node in 10 seconds...\n";
sleep(10);
exec('pkill -x node');


//Second call to api
client_call();
echo "\n";

