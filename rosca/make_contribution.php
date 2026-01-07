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
      <details class="ms-4 h4">
        <summary>GROUP CONTRIBUTION</summary>
        <small  class="mb-4 ms-4">Make contribution to a specific group.NOTE: You can't make contributions if the group status is Inactive or completed.</small>
      </details>
      <?php include ("../errors.php"); ?>
      <hr>
      <div class="row">
        <div class="col-md-7 mx-auto">
          <form class="form border-2 border p-5 bg-white" action="action.php?action=make-contribution" method="POST" autocomplete="off">
            <h4 class="mb-4 fw-bolder text-black text-center">MAKE CONTRIBUTION</h4>
            <div class="row">
              <div class="col-sm-12 mt-1">
                <div class="form-group">
                    <label class="fw-bolder">Group Name*</label>
                    <select class="form-select form-select-lg form-control border-2 shadow-none p-3" name="user_group" required>
                      <option value="" hidden>--Select--</option>
                      <?php $sql= $conn->query("SELECT u.*, ug.*, g.* FROM users u JOIN user_group ug ON u.user_id=ug.user_id JOIN groups g on ug.group_id=g.group_id WHERE ug.user_id='$uuid' GROUP BY ug.group_id");
                      if($sql->num_rows > 0){
                      while($row=$sql->fetch_array()){?>
                        <option class="text-capitalize" value="<?=$row['user_group_id']?>"><?=$row['group_name']?></option>
                        <?php } }?>
                    
                    </select>
                </div>
              </div>
              <div class="col-sm-12 mt-4">
                <div class="form-group">
                  <label class="fw-bolder">Amount*</label><br>
                  <input type="number" min="0" name="amount" class="form-control border-2 shadow-none p-3" required>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-sm fs-4 fw-bolder btn-outline-success text-start border-2 rounded-1 w-100 mt-4 text-white bg-success"><img src="../static/img/mpesa.png" width="100px" height="40px" class="me-2"> Deposit</button>
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
