<?php


class failover{

	public $primary = "node server_one.js";
	public $backup = "node server_two.js";
	public  $status;

public function __construct() {
		$this->ignite($this->primary);
}


public function ignite($server){

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


}


}

$objeto = new failover;
