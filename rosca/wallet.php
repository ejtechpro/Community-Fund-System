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
  <?php include("sidebar.php"); ?>

    <main id="main" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5 mx-auto">
      <details class="ms-4 h4">
        <summary>YOUR WALLET</summary>
        <small  class="mb-4 ms-4">Fund received from cycle's.You will receive your withdraw amount through m-pesa when you make a withdraw.</small>
      </details>
      <?php include ("../errors.php"); ?>
      <hr>
      <div class="row">
        <div class="col-md-7 mx-auto">
          <form action="action.php?action=withdraw" method="POST" autocomplete="off">
         <div class="card rounded-0">
          <div class="card-header fw-bolder">WALLET BALANCE</div>
          <div class="card-body">
            <?php
            $balance = $conn->query("SELECT account FROM users WHERE user_id='$uuid'");
            $account_balance = $balance->fetch_array()[0];
            ?>
            <h4 class="card-title fs-2 ms-5 fw-bolder"><?=$account_balance?>ksh</h4>
            <hr>
              <div class="row">
                <div class="col-md-12">
                  <h5 for="">Withdraw</h5>
                  <input type="text" name="amount" class="form-control rounded-0 shadow-none border-2 border-black" placeholder="Amount(ksh)" required>
                </div>
              </div>
          </div>
          <div class="card-footer text-muted">
            <button type="submit" class="btn btn-sm fs-4 fw-bolder btn-outline-success text-start border-2 rounded-1 w-100 bg-success text-white"><img src="../static/img/mpesa.png" width="100px" height="40px"> Withdraw</button>
          </div>
        </form>
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
