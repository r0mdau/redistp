<?php
require 'Predis/Autoloader.php';

Predis\Autoloader::register();

$redis = new Predis\Client();
$redis->set('counter', 0);
while(1){
	$retval = $redis->get('library');
	
	if($retval !== null){
		$obj = json_decode($retval);
		$numberOfJobs = count($obj->print) - 1;
		foreach($obj->print as $message){
			echo $message."\n".' '.$numberOfJobs.' jobs restants'."\n";
			$numberOfJobs--;
			$redis->set('counter', $redis->get('counter') + 1);
			sleep(1);
		}
		$redis->del('library');
	}else{
		echo $redis->get('counter').' jobs traités'."\n";
		sleep(2);
	}
}
