<?php

$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>
<?php
ob_start()
?>
<!-- HTML content of sidebar starts here -->


<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="#" target="_blank">
      <span class="ms-1 font-weight-bold text-white">Admin</span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == 'sales_dashboard.php' ? 'active bg-danger' : '' ?>" href="sales_dashboard.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Sales</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == 'lalamoveCDO.php' ? 'active bg-danger' : '' ?>" href="lalamoveCDO.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <span class="material-symbols-outlined">local_shipping</span>
          </div>
          <span class="nav-link-text ms-1">Lalamove</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $page == 'order.php' ? 'active bg-danger ' : '' ?>" href="order.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <span class="material-symbols-outlined">order_approve</span>
          </div>
          <span class="nav-link-text ms-1 text-black">Orders</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == 'category.php' ? 'active bg-danger' : '' ?>" href="category.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <span class="material-icons-round">inventory_2</span>
          </div>
          <span class="nav-link-text ms-1">All Components</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == 'add-category.php' ? 'active bg-danger' : '' ?>" href="add-category.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <span class="material-symbols-outlined">add</span>
          </div>
          <span class="nav-link-text ms-1">Add Component</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == 'products.php' ? 'active bg-danger' : '' ?>" href="products.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <span class="material-icons-round">inventory_2</span>
          </div>
          <span class="nav-link-text ms-1">All Products</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == 'add-products.php' ? 'active bg-danger' : '' ?>" href="add-products.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <span class="material-symbols-outlined">add</span>
          </div>
          <span class="nav-link-text ms-1">Add Products</span>
        </a>
      </li>

    </ul>
  </div>
  <div class="sidenav-footer position-absolute w-100 bottom-0">
    <div class="mx-3">
      <a class="btn bg-danger mt-4 w-100" style="color:black;" href="../logout.php" type="button">Logout</a>
    </div>
  </div>
</aside>
