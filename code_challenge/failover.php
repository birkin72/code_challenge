<?php


class failover{

	public $primary = "node server_one.js";
	public $backup = "node server_two.js";
	public  $status;

public function __construct() {
		$this->ignite($this->primary);
}


public function ignite($server){

//global $primary,$backup;

$descriptorspec = array(
    0 => array("pipe", "r"),  
    1 => array("pipe", "w"),  
    2 => array("pipe", "w")   
);


$process = proc_open($server, $descriptorspec, $pipes);

$this->status = proc_get_status($process);

$papa = $this->status["pid"];

$hijostatus = pcntl_waitpid($papa, $this->status,WUNTRACED);

if (pcntl_wifsignaled ($hijostatus)) {
	if($server == $this->primary){
		$this->ignite($this->backup);
	}
	else{
		$this->ignite($this->primary);	
	}

}

/*if (pcntl_wifstopped (  $hijostatus )) {
	echo "esta parado"; //NO DETECTABA SI SE SUSPENDIA EL PROCESSO
}*/

}


}

$objeto = new failover;

















//echo $hijostatus."mamada";
/*while ($status["running"]) {
         //echo "coriendo";
         sleep(1);
         $status = proc_get_status($process);
}


/*$command =  'node server_one.js' . ' > /dev/null 2>&1 & echo $!; ';

$pid = exec($command, $output);

echo($pid);



/*set_time_limit(1800);
ob_implicit_flush(true);

$exe_command = 'ping 127.0.0.1';

$descriptorspec = array(
    0 => array("pipe", "r"),  // stdin
    1 => array("pipe", "w"),  // stdout -> we use this
    2 => array("pipe", "w")   // stderr 
);

$process = proc_open($exe_command, $descriptorspec, $pipes);



    while( ! feof($pipes[1]))
    {
        $return_message = fgets($pipes[1], 1024);
        if (strlen($return_message) == 0) break;


        echo $return_message.'<br />';
        ob_flush();
        flush();
    }*/
