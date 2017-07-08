<?php 
	include "../includes/autoload.php";
	include "../includes/config.db.php";
	include "../includes/functions.php";
	
	//delete session info
    $binds = array("adminID" => $adminID );
	$mysql->delete(DBPREFIX_REP."AdminSession","adminID=:adminID",$binds);

    setcookie("cookieHash", "-1", $time - 3600*24,'/');
    //delete all session records
   //unset($_SESSION["sessionID"]);
    $_SESSION = array();
header('Location: ../index.php?a='.$adminID);