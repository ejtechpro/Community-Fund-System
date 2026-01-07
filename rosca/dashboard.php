<?php require_once("session.php");?>
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
  <?php //include "top_header.php"; ?>

<div class="container-fluid dashboard">
  <div class="row">
 <?php include("sidebar.php") ?>
    <main id="main" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5 mx-auto">
    <?php include ("../errors.php"); ?>
      <h4 class="mb-4 ms-4">GROUP INFOMATION</h4>
      <hr>
      <div class="row">
        <div class="col-md-5 mx-auto text-center">
          <h2><i class="fas fa-users"></i> Your Groups</h2>
              <?php
              $group_count = 0; 
              $groups = $conn->query("SELECT COUNT(*) FROM users u JOIN user_group ug ON u.user_id=ug.user_id WHERE ug.user_id=$uuid GROUP BY ug.user_id");
              if($groups->num_rows > 0){
              $group_count = $groups->fetch_array()[0];
              }
              ?>
            <span class="fw-bolder fs-1 border-bottom border-2"><?=$group_count?></span>
        </div>
        <div class="col-md-6 mx-auto text-start">
          <h2 class="">Group List</h2>
           <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Group Name</th>
                  <th>Total Members</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sql = $conn->query("SELECT g.*, ug.*, g.group_id as groupId FROM rooms g LEFT JOIN user_group ug ON g.group_id=ug.group_id  WHERE ug.user_id=$uuid GROUP BY ug.group_id");
                $n = 1;
                if($sql->num_rows > 0){
                while($row=$sql->fetch_array()){
                  $groupId = $row['groupId'];
                  $members = $conn->query("SELECT COUNT(*) FROM user_group WHERE group_id='$groupId'");
                  $count = $members->fetch_array()[0];
                  // get user role
                  ?>
                   <tr>
                  <td><?=$n?></td>
                  <td class="fw-bolder"><?=$row['group_name']?></td>
                  <td><a href="group_members.php?group-id=<?=$row['groupId']?>&group-name=<?=$row['group_name']?>" class="d-flex justify-content-around align-items-center me-3"><span><?=$count?></span> <small><i class="fas fa-eye"></i> View</small></a></td>
                  <td>
                    <?php if($row['status'] == 'active'){?>
                      <span class="text-success"><?=$row['status']?></span>
                      <?php }elseif($row['status'] == 'inactive'){ ?>
                      <span class="text-warning"><?=$row['status']?></span>
                      <?php }elseif($row['status'] == 'completed') {?>
                      <span class="text-danger"><?=$row['status']?></span>
                      <?php }else{echo("None");} ?>
                    </td>
                  <td class="d-flex justify-content-around align-items-center">
                    <a href="group_detail.php?group-id=<?=$row['groupId']?>" title="View"><i class="fas fa-eye"></i></a>
                   <?php if($row['role'] === 'host') :?>
                    <a href="create_group.php?group-id=<?=$row['groupId']?>" title="Edit"><i class="fas fa-pen-to-square"></i></a>
                    
                    <a href="action.php?action=delete-group&group-id=<?=$row['groupId']?>" title="Delete"><i class="fas fa-trash-alt text-danger"></i></a>
                   <?php else: ?>
                    <a class="disabled" title="Edit"><i class="fas fa-pen-to-square text-secondary"></i></a>
                    
                    <a class="disabled" title="Delete"><i class="fas fa-trash-alt text-secondary"></i></a>
                   <?php endif; ?>
                  </td>
                </tr>
               <?php $n++; } }else{ ?>
                <tr>
                  <td colspan="5">No Records</td>
                </tr>
               <?php } ?>
              </tbody>
            </table>
           </div>
        </div>
        <div class="col-md-10 mx-auto text-start mt-5">
          <h2 class="">Group Financial Summery</h2>
           <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Group Name</th>
                  <th>Amount per Member(ksh)</th>
                  <th>Required Contribution(ksh)</th>
                  <th>Amount Contributed(ksh)</th>
                  <th>Group Arrears(ksh)</th>
                </tr>
              </thead>
              <tbody>
            <?php 
              $sql = $conn->query("SELECT g.*, ug.*,c.*, g.group_id AS groupId FROM groups g LEFT JOIN user_group ug ON g.group_id=ug.group_id LEFT JOIN contributions c ON ug.user_group_id=c.user_group_id  WHERE ug.user_id='$uuid' GROUP BY ug.group_id");
              $n = 1;
              if($sql->num_rows > 0){
              while($row=$sql->fetch_array()){
                $groupId = $row['groupId'];
                $members = $conn->query("SELECT COUNT(*) FROM user_group WHERE group_id='$groupId'");
                $members_count = $members->fetch_array()[0];
                $amount = 0;
                $amount_contributed = $conn->query("SELECT SUM(amount) FROM user_group ug LEFT JOIN contributions c ON ug.user_group_id=c.user_group_id WHERE ug.group_id='$groupId' GROUP BY ug.group_id");
                if($amount_contributed->num_rows > 0){
                $amount = $amount_contributed->fetch_array()[0];
                }
                ?>
                <tr> 
                  <td><?=$n?></td>
                  <td><a href="group_detail.php?group-id=<?=$groupId?>" class="d-flex justify-content-between align-items-center pe-4 gap-3"><span class="text-capitalize"><?=$row['group_name']?></span> <small><i class="fas fa-eye"></i> View</small></a></td>
                  <td><?=$row['contribution_amount']?></td>
                  <td><?=$row['contribution_amount'] *  $members_count ?></td>
                  <td><?=$amount?></td>
                  <td><?=($row['contribution_amount'] *  $members_count) - ($amount)?></td>
                </tr>
                <?php $n++; } }else{ ?>
                <tr>
                  <td colspan="6">No Records</td>
                </tr>
               <?php } ?>
              </tbody>
            </table>
           </div>
        </div>
        <hr class="col-md-10 mt-3 mx-auto">

        <div class="col-md-10 mx-auto mt-5 payout-section">
          <h2 class="border-2 border-bottom" id="payout">Your Cycle Payouts</h2>
          <div class="table-responsive">
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th>Group Name</th>
                  <th>Payout Amount(ksh)</th>
                  <th>Payout Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $pay = $conn->query("SELECT * FROM groups g JOIN payout p ON g.group_id=p.group_id WHERE user_id='$uuid'");
                if($pay->num_rows > 0){
                  while($row=$pay->fetch_array()):?>
                  <tr>
                  <td class="text-capitalize"><?=$row['group_name']?></td>
                  <td><?=$row['payout_amount']?></td>
                  <td><?=date("Y-m-d H:i", strtotime($row['payout_date']))?></td>
                  <td>
                  <a href="action.php?action=delete-payout&payout-id=<?=$row['payout_id']?>" title="Delete"><i class="fas fa-trash-alt text-danger"></i></a>
                  </td>
                </tr>
                <?php endwhile; }else{ ?>
                <tr>
                  <td colspan="5">No Records</td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                 
                  <td colspan="5">
                  <hr>
                  <small>This is the amount that you will receive in every cycle of your groups</small>
                </td>
                </tr>
              </tfoot>
            </table>

          </div>
        </div>
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
