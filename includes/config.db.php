<?php


define('DBHOST',"localhost");

define('DBUSER',"root");

define('DBPASS',"");

define('DBNAME',"news");
define('PAGE_LIMIT',15);
 

$mysql = new db("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);

