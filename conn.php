<?php
 $host = 'localhost';
 $user = 'root';
 $password = '@12644944';
 $database = 'community_fund';
 
 $conn = new mysqli($host,$user,$password,$database);
  if(!$conn){
     die("Database Connection Error");
   }