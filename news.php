<?php
    include "includes/autoload.php";
    include "includes/config.db.php";
	include "includes/functions.php";

	if( empty($_SESSION["sessionID"]) || !isset($_SESSION["sessionID"]) ){
		include "view/login.php";
		exit; 
	}

    $haberler = $mysql->select("news"); 
    header('Content-Type: application/json');
    echo json_encode($haberler);
   

