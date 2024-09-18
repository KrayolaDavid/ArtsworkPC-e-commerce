<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Artzwork PC</title>
  
  <link href="asset/css/bootstrap.min.css" rel="stylesheet">
  <link href="asset/css/custom.css" rel="stylesheet">
  <link href="asset/css/nav.css" rel="stylesheet"> 
  <link href="asset/css/owl.theme.default.min.css" rel="stylesheet">
  <link href="asset/css/owl.carousel.min.css" rel="stylesheet"> 


  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css"/>
  <link rel="stylesheet" href="asset/css/style.css">
  <link rel="stylesheet" href="asset/css/slider.css">
  <link rel="stylesheet" href="asset/css/loginpopup.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
  <!-- Swiper.js CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<!-- Swiper.js JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>

<body>

  <?php include('navbar.php'); ?>

  <script>

    var loginPopup = document.getElementById("loginPopup");

    function showLogin() {
      wrapper.style.backdropFilter = "blur(5px)";
      wrapper.style.backgroundColor = "#9191918e";
      wrapper.style.minHeight = "100vh";
      loginPopup.classList.add('active-login');
      registerPopup.classList.remove('active-register');

      const element = document.getElementById("popups");
      element.classList.remove("hidden");
      element.classList.add("login-popup");
    }

    function hideLogin() {
      wrapper.style.backdropFilter = "";
      wrapper.style.backgroundColor = "";
      wrapper.style.minHeight = "100vh";
      loginPopup.classList.remove('active-login');

      const element = document.getElementById("popups");
      element.classList.add("hidden");
      element.classList.remove("login-popup");
    }

    var registerPopup = document.getElementById("registerPopup");

    function showRegister() {
      wrapper.style.backdropFilter = "blur(5px)";
      wrapper.style.backgroundColor = "#9191918e";
      wrapper.style.minHeight = "100vh";
      registerPopup.classList.add('active-register');
      loginPopup.classList.remove('active-login');

      const element = document.getElementById("popups");
      element.classList.remove("hidden");
      element.classList.add("login-popup");
    }

    function hideRegister() {
      wrapper.style.backdropFilter = "";
      wrapper.style.backgroundColor = "";
      wrapper.style.minHeight = "100vh";
      registerPopup.classList.remove('active-register');

      const element = document.getElementById("popups");
      element.classList.add("hidden");
      element.classList.remove("login-popup");
    }

    var navbarLinks = document.getElementById("navbarLinks");

    function showMenu() {
      navbarLinks.style.right = "-125px";
    }

    function hideMenu() {
      navbarLinks.style.right = "-425px";
    }
  </script>