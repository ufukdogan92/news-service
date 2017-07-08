<?php
    include "includes/autoload.php";
    include "includes/config.db.php";
	include "includes/functions.php";

	if( empty($_SESSION["sessionID"]) || !isset($_SESSION["sessionID"]) ){
		include "view/login.php";
		exit; 
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yönetim</title> 
<link rel="stylesheet" href="css/reset.css" type="text/css" /> 
<link rel="stylesheet"  href="css/style.css" type="text/css" /> 
<link rel="stylesheet" href="css/menu.css" type="text/css" />

<link rel="stylesheet" href="css/jquery-ui-1.8.16.custom.css" type="text/css" />
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script type='text/javascript' src='scripts/functions.js'></script>
<!-- jQuery alert --> 
<script type="text/javascript" src="scripts/jquery-impromptu.js"></script>     
<link rel="stylesheet" href="css/classic-impromptu.css" type="text/css" />   

<script type='text/javascript' src='scripts/jquery.ui.core.js'></script>
<script type='text/javascript' src='scripts/jquery.ui.widget.js'></script> 
<script type='text/javascript' src='scripts/jquery.ui.datepicker.js'></script>  
<script type='text/javascript' src='scripts/jquery.ui.datepicker-tr.js'></script>  
<script type='text/javascript' src='scripts/jquery.ui.tabs.js'></script>  

<script type="text/javascript" src="scripts/tinymce3/jquery.tinymce.min.js"></script>
 

<!-- //upload
<script type='text/javascript' src='scripts/ajaxupload.js'></script>
    -->
<link rel="stylesheet" href="css/jquery.ui.datepicker.css" type="text/css" />   

<!-- //formlar -->
<link rel="stylesheet" href="css/invalid.css" type="text/css" />
<link rel="stylesheet" href="css/formlar.css" type="text/css" />

<link rel="shortcut icon" href="favicon.ico" /> 
</head>

<body> 
<div id="header">    
	<div id="header-content">  
    	<div class="float-left header-text">
        	Haber Paneli
        </div>
        
        <div class="float-right header-text2">
        	Hoşgeldiniz <a href="index.php?path=updateAdmin&objectID=<?php echo $_SESSION["sessionID"]; ?>" class="yonetici_isim">#<?php echo $_SESSION["author"]; ?></a> |
			<?php echo date("d/m/Y"); ?> | 
            <a href="javascript:void(0);" onclick="javascript:logOut();">GÜVENLİ ÇIKIŞ</a>
        </div>
        
        <div class="temizle"></div>
        <?php include "includes/menu.php"; ?>
	</div>        
</div><!-- //ust -->