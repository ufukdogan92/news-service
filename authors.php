<?php
    include "includes/autoload.php";
    include "includes/config.db.php";
	include "includes/functions.php";

	if( empty($_SESSION["sessionID"]) || !isset($_SESSION["sessionID"]) ){
		include "view/login.php";
		exit; 
	}
 
    $authors = $mysql->select("author"); 
    header('Content-Type: application/json');
    echo json_encode($authors);
   
