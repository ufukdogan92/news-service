<?php
    include "includes/autoload.php";
    include "includes/config.db.php";
	include "includes/functions.php";

	if( empty($_SESSION["sessionID"]) || !isset($_SESSION["sessionID"]) ){
		include "view/login.php";
		exit; 
	}

    $categories = $mysql->select("news_category"); 
    header('Content-Type: application/json');
    echo json_encode($categories);
   
