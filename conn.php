<?php
 $host = 'localhost';
 $user = 'root';
 $password = '';
 $database = 'community_fund';
 
 $conn = new mysqli($host,$user,$password,$database);
  if(!$conn){
     die("Database Connection Error");
   }