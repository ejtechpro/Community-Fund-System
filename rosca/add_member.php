<?php 
require_once("session.php");
$group__id = isset($_GET['group-id']) ? $_GET['group-id'] : '';
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
      <details class="mb-4 ms-4">
        <summary class="fw-bolder">ADD MEMBER TO ACCRE FUND GROUP</summary>
        <p>A member must be registered with <a href="../register.html">CommunityFund</a> for he/she to be added to the group.</p>
      </details>
      <hr>
      <div class="row">
        <div class="col-md-7 mx-auto">
          <form class="form border-2 border p-5 bg-white" action="action.php?action=add-member&group-id=<?=$group__id?>" method="POST">
            <h4 class="mb-4 fw-bolder text-black text-center">ADD MEMBER</h4>
            <div class="row">
              <div class="col-sm-12 mt-1">
                <div class="form-group">
                    <label class="fw-bolder">Full Name*</label>
                    <select class="form-select form-select-lg form-control border-2 shadow-none p-3" name="member" required>
                    <option value="" selected hidden>--Select--</option>
                      <?php
                       $sql = $conn->query("SELECT * FROM users");
                       while($row=$sql->fetch_array()){?>
                        <option class="text-capitalize" value="<?=trim($row['user_id'])?>"><?=$row['first_name']." ".$row['last_name']?></option>
                      <?php } ?>
                     
                    </select>
                </div>
              </div>
              <div class="col-sm-12 mt-4">
                <div class="form-group">
                  <label class="fw-bolder">Role*</label><br>
                  <select class="form-select form-select-lg form-control border-2 shadow-none p-3" name="role" required>
                     <option value=""  selected hidden>--Select--</option>
                     <option value="treasurer">Treasurer</option>
                     <option value="chair person">Chair Person</option>
                     <option value="secretary">Secretary</option>
                     <option value="organizing secretary">Organizing secretary</option>
                     <option value="member">Member</option>
                   </select>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-sm fs-3 fw-bolder btn-outline-primary text-center border-2 rounded-0 w-100 mt-4"><i class="fas fa-user-plus"></i> Add</button>
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
