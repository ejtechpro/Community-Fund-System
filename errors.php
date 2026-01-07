<?php if(isset($_SESSION['error'])){ ?>
  <div class="error">
    <i class="fas fa-exclamation-circle"></i>
    <span class="message"><?=$_SESSION['error']?></span>
  </div>
<?php unset($_SESSION['error']); } ?>

<?php if(isset($_SESSION['success'])){ ?>
  <div class="Success">
    <i class="fas fa-check-circle"></i>
    <span class="message"><?=$_SESSION['success']?></span>
  </div>
<?php unset($_SESSION['success']); }?>
