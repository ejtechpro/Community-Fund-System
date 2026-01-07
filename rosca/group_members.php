<?php 
require_once("session.php");
$group__id = isset($_GET['group-id']) ? $_GET['group-id'] : '';
$group_name = isset($_GET['group-name']) ? $_GET['group-name'] : '';
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
      <h4 class="mb-4 ms-4 text-uppercase"><?=$group_name?> MEMBERSHIP INFOMATION</h4>
      <?php include ("../errors.php"); ?>
      <hr>
      <div class="row">
        <div class="col-md-10 mx-auto text-start">
         <div class="d-flex justify-content-between align-items-center mb-3">
          <h2 class="">Members List</h2>
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
         </div>
           <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="4"></th>
                  <th colspan="3">
                    <?php $account= $conn->query("SELECT * FROM groups WHERE group_id='$group__id'");
                    while($row= $account->fetch_array()){
                      $contribution_amount = $row['contribution_amount']
                      ?>
                    <h3>Accont Balance: <small><?=$row['cycle_contribution']?></small></h3>
                    <?php }?>
                  </th>
                </tr>
                <tr>
                  <th>#</th>
                  <th>Full Name</th>
                  <th>Contributed(ksh)</th>
                  <th>Arrears(ksh)</th>
                  <th>Role</th>
                  <th>Paid</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $sql = $conn->query("SELECT u.*, ug.*, c.*, c.user_group_id AS usergroupid, u.user_id AS userId, ug.user_group_id AS userGroupId, ug.group_id AS groupID FROM users u LEFT JOIN user_group ug ON u.user_id=ug.user_id  LEFT JOIN contributions c ON ug.user_group_id=c.user_group_id  WHERE ug.group_id='$group__id' GROUP BY ug.user_id");
                $n = 1;
                if($sql->num_rows > 0){
                while($row=$sql->fetch_array()){
                  $user_group_id = $row['usergroupid'];
                  $groupID = $row['groupID'];
                  $amount = 0;
                  $amount_contributed = $conn->query("SELECT SUM(amount) FROM contributions WHERE user_group_id='$user_group_id' GROUP BY user_group_id");
                  if($amount_contributed->num_rows > 0){
                  $amount = $amount_contributed->fetch_array()[0];
                  $role = '';
                  $role_sql = $conn->query("SELECT role FROM users u JOIN user_group ug ON u.user_id=ug.user_id WHERE u.user_id='$uuid' AND ug.group_id='$groupID'");
                  if($role_sql ->num_rows > 0){
                  $role = $role_sql->fetch_array()[0];
                  }
               
                  }
                  ?>
                <tr>
                  <td><?=$n?></td>
                  <td class="fw-bolder d-flex justify-content-between">
                   <span class="text-capitalize"><?=$row['first_name']. " " .$row['last_name']?></span>
                    <a class="cursor-pointer"  onclick="payMember('<?=$row['userId']?>','<?=$group__id?>','<?=$row['first_name'].' ' .$row['last_name']?>','<?=$contribution_amount?>')">
                    <?php if($role === 'host'): ?>
                    <span  class="fab fa-amazon-pay fs-4 text-info"></span></a>
                    <?php endif; ?>
                  </td>
                  <td><?=$amount ?></td>
                  <td><?=$contribution_amount - $amount ?></td>
                  <td class="text-capitalize"><?=$row['role']?></td>
                  <td class="text-capitalize"><?=$row['pay_status']?></td>
                  <td class="d-flex justify-content-around align-items-center">
                    <a href="profile.php?userId=<?=$row['userId']?>"><i class="fas fa-eye"></i> View</a>
                    <?php if($role === 'host'): ?>
                    <a href="action.php?action=removeuser&userGroupId=<?=$row['userGroupId']?>" class="text-danger"><i class="fas fa-trash-alt"></i> Remove</a>
                    <?php else: ?>
                    <a class="text-secondary disabled"><i class="fas fa-trash-alt"></i> Remove</a>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php $n++; } }else{ ?>
                <tr>
                  <td colspan="6">No Records</td>
                </tr>
               <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                  <?php if($role === 'host'): ?>
                    <td colspan="3" class="px-4">
                    <h4 class="mt-3">Make Payment</h4>
                    <form action="action.php?action=payMember" id="payForm" method="POST" autocomplete="off">
                      <div class="row">
                        <div class="col-md-4 mt-3">
                        <input type="text" name="userId" hidden required>
                        <input type="text" name="groupId" hidden required>
                          <input type="text" name="fullName" class="form-control p-2 rounded-0 shadow-none fs-4" placeholder="Full Name" readonly required>
                        </div>
                        <div class="col-md-4 mt-3">
                          <input type="number" min="0" name="payAmount" class="form-control p-2 rounded-0 shadow-none fs-4" placeholder="Amount" required>
                        </div>
                        <div class="col-md-4 mt-3 d-grid">
                          <button class="btn btn-outline-success fs-4 bg-success rounded-0 text-white fw-bolder">Pay</button>
                        </div>
                      </div>
                    </form>
                  </td>
                <?php else: ?>
                  <td colspan="3" class="px-4"></td>
                <?php endif; ?>
                 
                </tr>
              </tfoot>
            </table>
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
