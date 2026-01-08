<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Community Fund || Signin</title>
  <link rel="shortcut icon" href="static/img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="static/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="static/vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="static/css/main.css">
</head>
<body>
  <!-- Top Header -->
  <nav class="navbar navbar-expand-md fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Community<span>Fund</span></a>
      <button class="navbar-toggler border-0 shadow-none fw-bolder bg-white rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse ps-5" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a href="fqas.php" class="nav-link">Faqs</a>
          </li>
        </ul>
        <div class="auth-btn">
          <a href="register.php">Sign-In</a>
          <a href="login.php">Log-In</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Section -->
  <main id="main" class="container vh-100 login">
    <div class="row mt-2">
      <div class="col-md-12 mx-auto">
        <h2 class="text-center mb-3 mt-2 border-2 d-flex justify-content-between align-items-center"><hr class="flex-grow-1"> <span>Login</span> <hr class="flex-grow-1"></h2>
        <?php include ("errors.php"); ?>
        <div class="row mb-2">
        <div class="col-md-6 mx-auto">
         <form class="form border-2 border p-5 bg-white" action="validation.php" method="POST" autocomplete="off">
          <div class="form-group">
            <label for="email">Email*</label><br>
            <input type="email" name="email" class="form-control border-2 shadow-none p-3" required>
          </div>
          <div class="form-group mt-3">
            <label for="password">Password*</label><br>
            <input type="password" name="password" class="form-control border-2 shadow-none p-3" required>

          </div>
          <button name="login-user" type="submit" class="btn fs-3 fw-bolder btn-outline-primary mt-3 text-center border-2 rounded-0 w-50">Login</button>
          <p class="mt-3 text-black text-end">Don't have account? <a href="register.php">Register</a></p>
         </form>
         <hr class="my-4">
       </div>
     </div>
    </div>
  </div>
  </main>

  <!-- Footer -->
  <div class="container-fluid footer fixed-bottom">
    <footer class="py-3 mt-4">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item">
          <a href="index.php" class="nav-link px-2">Home</a>
        </li>
        <li class="nav-item">
          <a href="about.php" class="nav-link px-2">About</a>
        </li>
        <li class="nav-item">
          <a href="fqas.php" class="nav-link px-2">Faqs</a>
        </li>
        <li class="nav-item">
          <a href="register.php" class="nav-link px-2">Sign-In</a>
        </li>
      </ul>
     <div class="footer-btm">
      <p>&copy; 2024 <a href="index.php" class="fw-bolder">CommunityFund</a>.All rights reserved.</p>
     </div>
    </footer>
  </div>
  
<script src="static/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="static/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="static/js/main.js"></script>
</body>
</html>