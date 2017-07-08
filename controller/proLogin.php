<?php
    include "../includes/autoload.php";
	include "../includes/config.db.php";
	include "../includes/functions.php";
 
    $data 	    = $_POST["data"];//get data array from login form
    $email 	    = $data['email'];
	$password 	= md5($data["password"]);
	if(empty($email) || empty($password) ){
		echo "0|||Giriş Başarısız!";
		exit;		

	}	 

	$author = $mysql->select("author");
	print_r($author);
	if(count($author) < 1){
		echo "0|||Giriş Başarısız!";
		exit;	 
	}   

	$_SESSION["sessionID"] = $author[0]["id"]; 
	$_SESSION["author"] = $author[0]["first_name"]." ".$author[0]["last_name"];  
	
 
?> 
	1|||Hoşgeldiniz!
	<script type="text/javascript" > 
		window.location.reload(); 
	</script>