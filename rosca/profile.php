<?php 
require_once("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Community Fund || Rosca</title>
  <link rel="shortcut icon" href="../static/img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../static/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../static/vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../static/css/main.css">
</head>
<body>   
  <!-- Top Header -->
  <?php include ("top_header.php"); ?>

<div class="container-fluid dashboard">
  <div class="row">
  <?php include("sidebar.php") ?>

    <main id="main" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5 mx-auto">
        <h4 class="mb-4 ms-4" class="fw-bolder"><i class="fas fa-person-burst"></i> PROFILE</h4>
      <hr>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <h4 class="fw-bolder text-center text-black">YOUR PROFILE</h4>
          <?php 
          $userId = isset($_GET['userId']) ? $_GET['userId'] : '';
          $profile_data = $conn->query("SELECT * FROM users WHERE user_id='$userId'");
          if($profile_data->num_rows > 0){
            while($row=$profile_data->fetch_array()){
              $fname = $row['first_name'];
              $lname = $row['last_name'];
              $email_address = $row['email'];
              $phone = $row['contact'];
              $avatar = $row['profile'];
            }
          }
          
          ?>
         <div class="card text-white bg-dark-subtle rounded-0 p-5">
          <img class="rounded-circle ms-5 border border-3 p-2" src="<?=!empty($avatar) ? 'profiles/'.$avatar: '../static/img/defaultprofile.png' ?>" alt="profile"  width="100px" height="100px"/>
          <div class="card-body">
            <h4 class="card-title text-dark px-2 py-4 text-capitalize">Full Name: <small class="text-primary"><?=$fname." ".$lname?></small></h4>
            <hr>
            <h4 class="card-title text-dark px-2 py-4">Email: <small class="text-primary"><?=$email_address?></small></h4>
            <hr>
            <h4 class="card-title text-dark px-2 py-4 text-capitalize">Phone Number: <small class="text-primary"><?=$phone?></small></h4>
       
          </div>
         </div>
         
        </div>
        <hr class="col-md-10 mt-3 mx-auto">
      </div>
    </main>
  </div>
</div>
 <!-- Footer -->
    <small class="text-end z-0 fixed-bottom mb-0 px-4 bg-black py-1 border-top">&copy; 2024 <a class="fw-bolder">CommunityFund</a>.All rights reserved.</small>
<script src="../static/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../static/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../static/js/main.js"></script>
</body>
</html>
