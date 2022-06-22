<?php

?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src="img/logo.png" alt="لوگو سایت اکالا" style="height:50px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">خانه <span class="sr-only">(current)</span></a>
        </li>
        <?php if(!isset($_SESSION['login'])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php" id="nav-link-rank"> ورود </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php" id="nav-link-rank">ثبت نام </a>
        </li>
        <?php }else{ ?>    
        <li class="nav-item">
          <a class="nav-link" href="admin/index.php" id="nav-link-rank">پنل مدیریت  </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php" id="nav-link-rank">خروج  </a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </nav>