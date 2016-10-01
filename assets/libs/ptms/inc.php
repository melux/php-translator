<?php

$mysqli = new mysqli( "localhost" , "root" , "", "dev_translator" );
if ($mysqli->connect_error) {
	die('Erreur de connexion (' . $mysqli->connect_errno . ') '
			. $mysqli->connect_error);
	$connected = false;
}else{
	$connected = true;
}

?>
