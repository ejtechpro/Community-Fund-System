<nav class="navbar navbar-expand-md fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">Community<span>Fund</span></a>
      <a onclick="toggleNavigation()" class="px-2 border border-2 cursor-pointer"><i class="fas fa-align-left fs-3 fw-bolder"></i></a>

      <button class="navbar-toggler border-0 shadow-none fw-bolder bg-white rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse ps-5" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item dropdown">
            <a class="nav-link fw-bolder" type="button"
              id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false"><i class="fas fa-users-viewfinder"></i> Groups</a>

              <div class="dropdown-menu rounded-0 py-4 bg-body-tertiary" aria-labelledby="triggerId">
              <?php 
              $sql= $conn->query("SELECT u.*, ug.*, g.* FROM users u JOIN user_group ug ON u.user_id=ug.user_id JOIN groups g on ug.group_id=g.group_id WHERE ug.user_id='$uuid' GROUP BY ug.group_id");
              if($sql->num_rows > 0){
                while($row=$sql->fetch_array()){?>
                  <a class="dropdown-item text-capitalize" href="group_detail.php?group-id=<?=$row['group_id']?>"><?=$row['group_name']?></a>
                <?php } }else{?>
                  <p class="dropdown-item fs-3">None</p>
                  <?php }  ?>
              </div>
          </li>
          <li class="nav-item px-md-4">
            <a href="wallet.php" class="nav-link fw-bolder"><i class="fas fa-wallet"></i> Wallet</a>
          </li>
        </ul>
      
        <div class="dropdown px-5 me-5 rounded-0">
          <a href="#" class="d-block link-dark text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
           <div class="d-flex justify-content-center align-items-center">
            <img src="<?=!empty($profile) ? 'profiles/'.$profile : '../static/img/defaultprofile.png' ?>" width="32px" height="32px" class="rounded-circle">
            <span class="text-white px-2 text-capitalize"> <?=$first_name ." ".$last_name?></span>
           </div>

          </a>
          <ul class="dropdown-menu text-small rounded-0  dropdown-menu-start">
            <li><a class="dropdown-item text-black" href="account_setting.php"><i class="fa fas fa-gear"></i> Account Settings</a></li>
            <li><a class="dropdown-item text-black" href="../logout.php"><i class="fa fas fa-lock"></i> Sign out</a></li>
          </ul>
        </div>
        
      </div>
    </div>
  </nav>