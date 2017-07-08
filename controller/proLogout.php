<?php 
	include "../includes/autoload.php";
	include "../includes/config.db.php";
	include "../includes/functions.php";
	
	//delete session info
	$mysql->delete(DBPREFIX."adminSessions","adminID='$adminID'");

    //delete session record
	unset($_SESSION["sessionID"]);
header('Location: ../');