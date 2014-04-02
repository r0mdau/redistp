<?php
require 'Predis/Autoloader.php';

Predis\Autoloader::register();

$redis = new Predis\Client();
$data = array('print' => array('on a soif', 'on a faim', 'on est fatigue'));
$redis->set('library', json_encode($data));
