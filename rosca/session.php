<?php
session_start();
require_once('../conn.php');
if(isset($_SESSION['email'])){
  $sql1 = $conn->query("SELECT * FROM users WHERE email='{$_SESSION['email']}'");
  if($sql1->num_rows > 0){
    while($row=$sql1->fetch_array()){
      $uuid = $row['user_id'];
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $email = $row['email'];
      $contact = $row['contact'];
      $profile = $row['profile'];
      $password = $row['password'];
    }
    }else{
      header("location: ../login.php");
      exit();
    }
}else{
  header("location: ../login.php");
  exit();
}