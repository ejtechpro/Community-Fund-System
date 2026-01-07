<?php
session_start();
require_once ('conn.php');
if(isset($_POST['register-user'])){
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];

  if($password1 !== $password2){
    $_SESSION['error'] = "Password does not match!";
    header("location: register.php");
    exit();
  }

  $get_emails = $conn->query("SELECT email FROM users WHERE email='$email'");
  if($get_emails->num_rows > 0){
    $_SESSION['error'] = "Account already registered.";
    header("location: register.php");
    exit();
  }

  $sql = $conn->query("INSERT INTO users(first_name, last_name, email, contact, password) VALUES('$first_name','$last_name','$email','$contact','$password1')");

  if($sql){
    $_SESSION['success'] = "Account created successfully.";
    header("location: login.php");
    exit();
  }
}

if(isset($_POST['login-user'])){
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $qr = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
  if($qr->num_rows > 0){
    while($row=$qr->fetch_array()){

    if(trim($row['email']) === $email && trim($row['password']) === $password){
        $_SESSION['email'] = $row['email'];
     
      header("location: rosca/dashboard.php");
      exit();
    }else{
      $_SESSION['error'] = "Invalid Email or Password!";
      header("location: login.php");
      exit();
    }
  }

  }else{
    $_SESSION['error'] = "Invalid Email or Password.";
    header("location: login.php");
    exit();
  }
}

if(isset($_POST['account-settings'])){
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $contact = $_POST['contact'];
  $password = $_POST['password'];
  $profile = get_profile();
  
  $sql = $conn->query("UPDATE users SET first_name='$first_name', last_name='$last_name', contact='$contact', profile='$profile', password='$password' WHERE email='{$_SESSION['email']}'");
  if($sql){
    $_SESSION['success'] = "Account updated successfully.";
    header("location: rosca/account_setting.php");
    exit();

  }
}
function get_profile(){
  if(isset($_FILES['profile'])){
    $name = $_FILES['profile']['name'];
    $tmp_name  = $_FILES['profile']['tmp_name'];
    $old_profile = $_POST['old_profile'];
    
    if(!empty($name)){
    $extention = explode(".", $name);
    $profile = uniqid().'.'.end($extention);
    move_uploaded_file($tmp_name, "rosca/profiles/".$profile);

    $profile_name =  $profile;

    }else{

      $profile_name = $old_profile;
    }
    return $profile_name;
  }
}
