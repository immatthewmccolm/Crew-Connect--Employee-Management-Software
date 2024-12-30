<?php
include_once('backend/functions.php');



$name = $_SESSION['FName'] . ' ' . $_SESSION['surname'];
$fname = $_SESSION['FName'];
?>

<?php
if ($_SESSION['Role'] == 'Admin') { ?>

<div class="sticky-left navigation-bar-brand d-flex flex-column p-3 vh-100"><br>
    <a href="/" class="d-flex align-items-center mb-5 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <img src="build/logos/White Text.svg" alt="" width="100%">
    </a>
    <br><br><br>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="index.php" class="nav-link active" aria-current="page">
          <i class="fa-solid fa-house me-2"></i>
          Home
        </a>
      </li>
      <hr>
      <li class="nav-item">
        <a href="new-toil.php" class="nav-link" aria-current="page">
          <i class="fa-solid fa-clock-rotate-left me-2"></i>
          New TOIL Gain Request
        </a>
      </li>
      <li class="nav-item">
        <a href="use-toil.php" class="nav-link" aria-current="page">
          <i class="fa-solid fa-clock-rotate-left me-2"></i>
          New TOIL Use Request
        </a>
      </li>
      <li class="nav-item">
        <a href="toil.php" class="nav-link" aria-current="page">
          <i class="fa-solid fa-user-clock me-2"></i>
          Track my TOIL Requests
        </a>
      </li>
      <hr>
      <li class="nav-item">
        <a href="new-al.php" class="nav-link" aria-current="page">
          <i class="fa-solid fa-plane me-2"></i>
          New AL Request
        </a>
      </li>
      <li class="nav-item">
        <a href="al.php" class="nav-link" aria-current="page">
          <i class="fa-solid fa-user-clock me-2"></i>
          Track my AL Requests
        </a>
      </li>
      <hr>
      <li class="nav-item">
        <a href="approve-toil.php" class="nav-link" aria-current="page">
          <i class="fa-solid fa-circle-check me-2"></i>
          Approve TOIL Requests
        </a>
      </li>
      <li class="nav-item">
        <a href="approve-al.php" class="nav-link" aria-current="page">
          <i class="fa-solid fa-circle-check me-2"></i>
          Approve AL Requests
        </a>
      </li>
      <hr>
      <li class="nav-item">
        <a href="user-management.php" class="nav-link" aria-current="page">
          <i class="fa-solid fa-users me-2"></i>
          User Management
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo comments_rand_avatar_color("$name", '0.8', 'some-oter-class'); ?>
        <strong class="mx-3"><?php echo $fname ?></strong>
      </a>
      <ul class="dropdown-menu text-small shadow">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="authentication/logout.php">Sign out</a></li>
      </ul>
    </div>
    
  </div>

<?php } else { ?>

    <div class="navigation-bar-brand d-flex flex-column p-3 vh-100" style="width: 300px;"><br>
    <a href="/" class="d-flex align-items-center mb-5 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <img src="build/logos/White Text.svg" alt="" width="100%">
    </a>
    <br><br><br>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link active" aria-current="page">
          <i class="fa-solid fa-house me-2"></i>
          Home
        </a>
      </li>
      <hr>
      <li class="nav-item">
        <a href="#" class="nav-link" aria-current="page">
          <i class="fa-solid fa-clock-rotate-left me-2"></i>
          New TOIL Request
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link" aria-current="page">
          <i class="fa-solid fa-user-clock me-2"></i>
          Track my TOIL Requests
        </a>
      </li>
      <hr>
      <li class="nav-item">
        <a href="#" class="nav-link" aria-current="page">
          <i class="fa-solid fa-plane me-2"></i>
          New AL Request
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link" aria-current="page">
          <i class="fa-solid fa-user-clock me-2"></i>
          Track my AL Requests
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo comments_rand_avatar_color("$name", '0.8', 'some-oter-class'); ?>
        <strong class="mx-3"><?php echo $fname ?></strong>
      </a>
      <ul class="dropdown-menu text-small shadow">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="authentication/logout.php">Sign out</a></li>
      </ul>
    </div>
  </div>

<?php } ?>

