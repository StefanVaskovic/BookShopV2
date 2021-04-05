<?php 
ob_start();
session_start();?>
<?php require "views/head.php";?>
<body id="page-top">
  <div class="seo">
    <h1>naslov</h1>
    <h2>naslov</h2>
  </div>
  <!-- Navigation -->
  <?php require "views/nav.php";?>


  <!-- Header -->
  <?php require "views/header.php";?>
  <!-- Portfolio Grid -->
  
  <?php
    if(isset($_GET['page'])){
      $page = $_GET['page'];
      switch($page){
        case "Home":
          require "views/books.php";
          break;
        case "Logout":
          header("Location:logic/logout.php");
          break;
        case "Login":
          require "views/login.php";
          break;  
        case "Register":
          require "views/register.php";
          break;
        case "Contact":
          require "views/contact.php";
          break;
        case "Cart":
          require "views/cart.php";
          break;
        case "Survey":
          require "views/survey.php";
          break;
        case "Summary":
          require "views/summary.php";
          break;
      }
    }else{
      require "views/books.php";
    }
  ?>

  <!-- Footer -->
  


  <?php require "views/footer.php";?>

  <!-- Bootstrap core JavaScript -->
  <?php require "views/script.php";?>