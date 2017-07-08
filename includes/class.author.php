<?php 
    class author{
        public  $id;
        public $first_name;
        public $last_name;
        public $status;
        public $email;
        public $created_date;

        public function getAuthor($id){
            $mysql = new db("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
            $author = $mysql->select("author","id = '$id'");
            $this->first_name = $author[0]["first_name"]; 
        }
        
        
    }
