<nav class="navbar navbar-expand-lg bg-dark sticky-top navbar-dark ">
  <div class="container">
    <a class="navbar-brand"  href="index.php">Artswork PC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <head>
    <style>
      </style>
    </head>

    <div class="search-container">
    <form method="post" action="searchex.php" style="display: flex; width: 100%;">
        <input type="text" name="str" class="search-input" required/>
        <button type="submit" name="submit" class="search-button"><i class="fa fa-search"></i> Search</button>
    </form>
</div>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="components.php">Components</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="buildapc.php">Build</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="compare.php">Compare</a>
        </li>
        <?php
          if (isset($_SESSION['auth_user']))
          {
            ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION['auth_user']['lname']; ?>
          </a>

          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="my-orders.php">My Orders</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>

          </li>
          <?php
          }
          else  
          {
            ?>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>


        <?php
          }
        ?>

        </li>
        </li>
      </ul>
    </div>
  </div>
</nav>