<?php 
require_once("session.php");
$group__id = isset($_GET['group-id']) ? $_GET['group-id'] : '';
$data = $conn->query("SELECT g.*, ug.* FROM groups g JOIN user_group ug ON  g.group_id=ug.group_id WHERE g.group_id='$group__id'");
if($data->num_rows > 0){
  while($row=$data->fetch_array()){
    $members = $conn->query("SELECT COUNT(*) FROM user_group WHERE group_id=$group__id");
    $count = $members->fetch_array()[0];
    foreach($row as $key => $value){
      $$key = $value;
    }
  }
}
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
      <h4 class="mb-4 ms-4">GROUP INFOMATION</h4>
      <hr>
      <div class="row">
        <div class="col-md-10 mx-auto text-start">
           <div class="card text-start p-4 rounded-0">
           <h4 class="border-2 border-bottom mb-3 py-1 d-flex justify-content-between">
           <div>Group Name: <small class="text-capitalize"><?=$group_name?></small></div>
            <div>Account Number: <small class="fw-bolder text-danger-emphasis"><?=$account_number?></small></div>
          </h4>
          <?php
           $role_sql = $conn->query("SELECT u.* FROM users u JOIN user_group ug ON u.user_id=ug.user_id WHERE  ug.group_id='$group__id' AND role='host'");
           while($row=$role_sql->fetch_array()){
             $host = $row['first_name'];
             $userId = $row['user_id'];
           }
          ?>
           <h5 class="px-1">Admin: <a href="profile.php?userId=<?=$userId?>" class="text-primary">@<?=$host?></a></h5>
           <h5 class="mt-4">Total Members: <span class="fw-bolder"><?=$count?> Members</span></h5>
           <h5 class="mt-4">Created On: <span class="fw-bolder"><?=date("Y-m-d H:i", strtotime($group_created_on))?></span></h5>
           <h5 class="mt-4">Status: <span class="fw-bolder"><?=$status?></span></h5>
           <h5 class="mt-4">Started On: <span class="fw-bolder"><?=date("Y-m-d H:i", strtotime($start_date))?></span></h5>
           <h5 class="mt-4">Will End On: <span class="fw-bolder"><?=date("Y-m-d H:i", strtotime($end_date))?></span></h5>
            <div class="card-body">
              <h4 class="fw-bolder text-center">Description</h4>
              <hr>
              <p class="card-text"><?=$group_description?></p>
              <p class="text-end mt-5 py-4">
                <?php
                $role = '';
                $role_sql = $conn->query("SELECT role FROM users u JOIN user_group ug ON u.user_id=ug.user_id WHERE u.user_id='$uuid' AND ug.group_id='$group__id'");
                if($role_sql->num_rows > 0){
                $role = $role_sql->fetch_array()[0];
                } ?>
                <?php if($role === 'host'): ?>
                <a href="add_member.php?group-id=<?=$group__id?>" class="me-3 btn btn-outline-primary fs-4 rounded-0 border-2"><i class="fas fa-user-plus"></i> Add Member</a>
                <?php else: ?>
                  <a class="me-3 btn btn-outline-secondary fs-4 rounded-0 border-2 disabled"><i class="fas fa-user-plus"></i> Add Member</a>
                <?php endif; ?>
                <?php 
                $leave = $conn->query("SELECT user_group_id FROM user_group WHERE user_id='$uuid' AND group_id='$group__id'");
                if($leave->num_rows > 0){
                  $leaveId = $leave->fetch_array()[0];
                  } ?>
                <?php if($role === 'host'): ?>
                  <a class="me-3 btn btn-outline-secondary fs-4 rounded-0 border-2 disabled"><i class="fas fa-droplet"></i> Leave</a>
                <?php else: ?>
                  <a href="action.php?action=removeuser&userGroupId=<?=$leaveId?>" class="me-3 btn btn-outline-danger fs-4 rounded-0 border-2"><i class="fas fa-droplet"></i> Leave</a>
                <?php endif; ?>
              </p>
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
