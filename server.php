<?php

include_once 'json.php';
include_once 'mrss.php';

$myFeed;
$myFeed = new JsonMovie();/*
switch ($argv[1]) {
	case 'json':
		if(array_key_exists(3, $argv)) {
			$myFeed = new JsonMovie($argv[2], $argv[3]);
		}else{
			if(array_key_exists(2, $argv)){
				$myFeed = new JsonMovie($argv[2]);
			}else{
				$myFeed = new JsonMovie();
			}
		}
		break;
	case 'mrss':
		$myFeed = new Mrss();
		break;
	
	default:
		echo "chyba";
		return;
}
*/
header('Content-Type: application/json');
try {
	echo json_encode($myFeed->getData());
} catch (Exception $e) {
	echo json_encode("nastala chyba :(");	
}
