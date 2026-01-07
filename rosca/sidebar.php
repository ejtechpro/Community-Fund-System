<sidebar id="sidebarMenu" class="col-sm-3 col-lg-2">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a  class="nav-link active" aria-current="page" href="dashboard.php">
              <span class="fas fa-address-card"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create_group.php">
             <i class="fas fa-users-cog"></i>
              Group Setup
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="make_contribution.php">
              <span  class="fab fa-amazon-pay fs-4"></span>
              Deposit
            </a>
          </li>
          <li class="nav-item payout-btn" onclick="showPayoutSection()">
            <a href="dashboard.php#payout" class="nav-link cursor-pointer">
              <span class="fab fa-alipay fs-4"></span>
             Payout
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php?userId=<?=$uuid?>">
              <span class="fas fa-user-alt"></span>
             Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <hr>
            </a>
          </li>
          <li class="nav-item">
              <details class="nav-link">
                <summary>Account</summary>
                <div class="bg-black py-4">
                  <a class="ms-4 py-3" href="account_setting.php"><i class="fas fa-gear"></i> Account Settings</a>
                  <a class="ms-4" href="../logout.php"><i class="fas fa-lock"></i> Logout</a>
                </div>
              </details>
          </li>
        </ul>
      </div>
    </sidebar>