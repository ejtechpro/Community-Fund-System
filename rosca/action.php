<?php
require ("session.php");

$action = isset($_GET['action']) ? $_GET['action'] : "";

//Create group
if($action === 'create-group'){
  $group_name =$_POST['group_name'];
  $contribution_amount = $_POST['contribution_amount'];
  $status	 = $_POST['status'];
  $start_date	 = $_POST['start_date'];
  $end_date	 = $_POST['end_date'];
  $cycle_contribution = $_POST['cycle_contribution'];	
  $group_description = $_POST['group_description'];

  // Generate
  $account_number = random_int(999999, 999999999);

  $get_group_name = $conn->query("SELECT * FROM groups WHERE group_name='$group_name'");
  if($get_group_name->num_rows == 0){

  $create = $conn->query("INSERT INTO groups(group_name,account_number,contribution_amount,status,start_date,end_date,group_description) VALUES('$group_name','$account_number','$contribution_amount','$status','$start_date','$end_date','$group_description')");

  if($create){
    $get_groupId = $conn->query("SELECT group_id FROM groups WHERE group_name='$group_name'");
    $groupId = $get_groupId->fetch_array()[0];

    $insert = $conn->query("INSERT INTO user_group(user_id,group_id,role) VALUES('$uuid','$groupId','host')");

    if($insert){
      $_SESSION['success'] = "Group created successfully.";
      header("location: create_group.php");
      exit();
     }
  }
}else{
 $_SESSION['error'] = "Group with that name already exist.";
 header("location: create_group.php");
 exit();
}
}

//Updare group
if($action === 'update-group'){
  $group__id = $_GET['group-id'];
  $group_name =$_POST['group_name'];
  $contribution_amount = $_POST['contribution_amount'];
  $status	 = $_POST['status'];
  $start_date	 = $_POST['start_date'];
  $end_date	 = $_POST['end_date'];
  $group_description = $_POST['group_description'];

  

  $update = $conn->query("UPDATE groups SET group_name='$group_name',contribution_amount='$contribution_amount',status='$status',start_date='$start_date',end_date='$end_date',group_description='$group_description' WHERE group_id='$group__id'");

  if($update){
    $_SESSION['success'] = "Group updated successfully.";
    header("location: create_group.php?group-id=".$group__id."");
    exit();
     
  }
}

// Delete group
if($action === 'delete-group'){
  $group__id = $_GET['group-id'];
  $delete = $conn->query("DELETE FROM groups WHERE group_id='$group__id'");
  if($delete){
    $_SESSION['success'] = "Group deleted successfully.";
    header("location: dashboard.php");
    exit(); 
  }
}
// Add member to a group
if($action === 'add-member'){
  $group__id = $_GET['group-id'];
  $member = $_POST['member'];
  $role = $_POST['role'];
 $sql = $conn->query("SELECT user_id,group_id FROM user_group WHERE user_id='$member' AND group_id='$group__id'");
 if($sql->num_rows === 0){

  $insert = $conn->query("INSERT INTO user_group(user_id,group_id,role) VALUES('$member','$group__id','$role')");
  if($insert){
    $_SESSION['success'] = "Member added successfully.";
    header("location: group_members.php?group-id=$group__id");
    exit(); 
  }
}else{
  $_SESSION['error'] = "Member already exist in the group.";
  header("location: group_members.php?group-id=$group__id");
  exit(); 
}
}

if($action === 'make-contribution'){
  $user_group_id = $_POST['user_group'];
  $amount = $_POST['amount'];

  $sql = $conn->query("INSERT INTO contributions(user_group_id,amount) VALUES('$user_group_id','$amount')");
  if($sql){
    $query = $conn->query("SELECT group_id FROM user_group WHERE user_group_id='$user_group_id'");
    $group_id = $query->fetch_array()[0];
    $update = $conn->query("UPDATE groups SET cycle_contribution = cycle_contribution + $amount WHERE group_id='$group_id'");
    $_SESSION['success'] = "Contribution added successfully.";
    header("location: make_contribution.php?");
    exit();
  }

}

// Remove Membere from group
if($action === 'removeuser'){
  $userGroupId = $_GET['userGroupId'];
  $delete = $conn->query("DELETE FROM user_group WHERE user_group_id='$userGroupId'");
  if($delete){
    $_SESSION['success'] = "Member removed successfully.";
    header("location: dashboard.php");
    exit(); 
  }
}

// payMember
if($action === 'payMember'){
  $userId = $_POST['userId'];
  $groupId = $_POST['groupId'];
  $amount =  $_POST['payAmount'];

  $group = $conn->query("SELECT * FROM groups WHERE group_id='$groupId'");
  if($group->num_rows > 0){
    while($row=$group->fetch_array()){
      $group_name = $row['group_name'];
      $cycle_contribution = $row['cycle_contribution'];

      if($cycle_contribution < $amount){
        $_SESSION['error'] = "Insufficient account balance.";
        header("location: group_members.php?group-id=$groupId&group-name=$group_name");
        exit(); 
      }
    }
  $sql = $conn->query("INSERT INTO payout(user_id,group_id,payout_amount) VALUES('$userId','$groupId','$amount')");
  if($sql){
   $conn->query("UPDATE user_group SET pay_status='yes' WHERE user_id='$userId' AND group_id=' $groupId'");
   $conn->query("UPDATE users SET account = account + $amount  WHERE user_id='$userId'");
   $conn->query("UPDATE groups SET cycle_contribution = cycle_contribution - $amount  WHERE group_id='  $groupId'");

    $_SESSION['success'] = "Payment Completed successfully.";
    header("location: group_members.php?group-id=$groupId&group-name=$group_name");
    exit(); 

  }
  }
}

if($action === 'withdraw'){
  $amount = $_POST['amount'];
  echo($amount);

  $balance = $conn->query("SELECT account FROM users WHERE user_id='$uuid'");
  $account_balance = $balance->fetch_array()[0];

  if($account_balance < $amount){
    $_SESSION['error'] = "Insufficient account balance.";
    header("location: wallet.php");
    exit(); 
  }else{
    $sql = $conn->query("UPDATE users SET account = account - $amount  WHERE user_id='$uuid'");
    $_SESSION['success'] = "Check your M-pesa for a confirmation message.";
    header("location: wallet.php");
    exit(); 
  }
}

if($action === 'delete-payout'){
  $payId = $_GET['payout-id'];
  $delete = $conn->query("DELETE FROM payout WHERE payout_id='$payId'");
  if($delete){
    $_SESSION['success'] = "Payout deleted successfully.";
    header("location: dashboard.php");
    exit(); 
  }
}