<?php require_once("session.php");
 if (isset($_GET['group-id'])){
  $group__id = $_GET['group-id'];
    $sql = $conn->query("SELECT * FROM groups WHERE group_id='$group__id'");
    while($row=$sql->fetch_array()){
      $group_name =$row['group_name'];
      $contribution_amount = $row['contribution_amount'];
      $status	 = $row['status'];
      $start_date	 = $row['start_date'];
      $end_date	 = $row['end_date'];
      $cycle_contribution = $row['cycle_contribution'];	
      $group_description = $row['group_description'];              
     
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
      <details class="ms-4 h4">
        <summary>GROUP SETUP</summary>
        <small  class="mb-4 ms-4">You can create new group or start next <span class="text-info">cycle.</span> <span>To start next cycle first updated the status of the current cycle as completed. </span></small>
      </details>
      <hr>
      <div class="row">
        <div class="col-md-7 mx-auto">
        <?php include ("../errors.php"); ?>
          <form class="form border-2 border p-5 bg-white" action="<?=isset($group__id ) ? 'action.php?action=update-group&groupid='.$group__id.'' : 'action.php?action=create-group';?>" method="POST" autocomplete="off">
            <h4 class="mb-4 fw-bolder text-black text-center">CREAT GROUP</h4>
            <div class="row">
              <div class="col-sm-6 mt-1">
                <div class="form-group">
                  <label>Group Name*</label><br>
                  <input type="text" name="group_name" class="form-control border-2 shadow-none p-3" value="<?=isset($group_name) ? $group_name : '' ?>" required>
                </div>
              </div>
              <div class="col-sm-6 mt-1">
                <div class="form-group">
                    <label>Cycle Status*</label>
                    <select class="form-select form-select-lg form-control border-2 shadow-none p-3" name="status" required>
                      <option value="<?=isset($status) ? $status : '' ?>" selected hidden><?=isset($status) ? $status : '--Select--' ?></option>
                      <option value="active">Active</option>
                      <option value="inactive">Inactive</option>
                      <option value="completed">Completed</option>
                    </select>
                </div>
              </div>
              <div class="col-sm-12 mt-3">
                <div class="form-group">
                  <label>Contribution Amount Per Member(ksh)*</label><br>
                  <input type="number" min="0" name="contribution_amount" class="form-control border-2 shadow-none p-3"  value="<?=isset($contribution_amount) ? $contribution_amount : '' ?>" required>
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="form-group">
                  <label>Start Date</label><br>
                  <input type="datetime-local" name="start_date" class="form-control border-2 shadow-none p-3"  value="<?=isset($start_date) ? $start_date : '' ?>">
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="form-group">
                  <label>End Date</label><br>
                  <input type="datetime-local" name="end_date" class="form-control border-2 shadow-none p-3"  value="<?=isset($end_date) ? $end_date : '' ?>">
                </div>
              </div>
              <div class="col-sm-12 mt-3">
                <div class="form-group">
                  <label>Group Description</label><br>
                  <textarea type="text" rows="2" name="group_description" class="form-control border-2 shadow-none p-3 fs-4"><?=isset($group_description) ? $group_description : '' ?></textarea>
                </div>
              </div>
            </div>
            <button name="create_group" type="submit" class="btn fs-3 fw-bolder btn-outline-primary mt-3 text-center border-2 rounded-0 w-50"><?=isset($group__id) ? 'Update' : 'Create' ?></button>
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
