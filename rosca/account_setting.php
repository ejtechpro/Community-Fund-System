<?php require_once("session.php"); ?>
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
        <h4 class="mb-4 ms-4" class="fw-bolder"><i class="fas fa-gears"></i> ACCOUNT SETTING</h4>
      <hr>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <form class="form border-2 border p-5 bg-white" action="../validation.php" method="POST" enctype="multipart/form-data" enautocomplete="off">
            <h4 class="fw-bolder text-center text-black">SETUP YOUR ACCOUNT</h4>
            <?php include ("../errors.php"); ?>
            <div class="row">
              <div class="col-md-12 mb-4">
                <label for="profile" class="cursor-pointer">
                <p>Profile</p>
                <img id="profile-img" src="<?=!empty($profile) ? 'profiles/'.$profile : '../static/img/defaultprofile.png' ?>" alt="profile" width="100px" height="100px" class="border-2 border-dark-subtle"><br>
                <input type="file" name="profile" onchange="displayIMG(this.files[0])" id="profile" hidden>
                <input type="text" name="old_profile" value="<?=$profile?>" hidden readonly>
              </label>
              </div>
              <div class="col-sm-6 mt-1">
                <div class="form-group">
                  <label for="first_name">First Name</label><br>
                  <input type="first_name" name="first_name" class="form-control border-2 shadow-none p-3" value="<?=$first_name?>" required>
                </div>
              </div>
              <div class="col-sm-6 mt-1">
                <div class="form-group">
                  <label for="last_name">Last Name</label><br>
                  <input type="last_name" name="last_name" class="form-control border-2 shadow-none p-3" value="<?=$last_name?>" required>
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="form-group">
                  <label for="email">Email</label><br>
                  <input type="email" readonly name="email" class="form-control border-2 shadow-none p-3" value="<?=$email?>" required disabled>
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="form-group">
                  <label for="contact">Contact</label><br>
                  <input type="number" min="0" name="contact" class="form-control border-2 shadow-none p-3" value="<?=$contact?>" required>
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="form-group">
                  <label>Password</label><br>
                  <input type="password" name="password" class="form-control border-2 shadow-none p-3" value="<?=$password?>" required>
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <label></label>
                  <button name="account-settings" type="submit" class="btn fs-3 fw-bolder btn-outline-primary mt-3 text-center border-2 rounded-0 w-100">Save</button>
              </div>
            </div>
            <hr>
           </form>
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
