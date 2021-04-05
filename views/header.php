   <?php
          $stranica ="http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
          if($stranica == "http://malosamo.epizy.com/index.php?page=Home" || $stranica == "http://malosamo.epizy.com/index.php" || $stranica == "http://malosamo.epizy.com/"):
        ?>
<header class="masthead">
    <div class="container">
      <div class="intro-text">
          <div class="intro-lead-in">Welcome To Our Book Shop!</div>
          <div class="intro-heading text-uppercase">JOIN US</div>
            <?php if(!isset($_SESSION['korisnik'])):?>
           <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="index.php?page=Register">Register</a>
           <?php endif;?>
      </div>
    </div>
  </header>

  
  <?php elseif($stranica == "http://malosamo.epizy.com/index.php?page=Cart"):?>
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
          <div class="intro-heading text-uppercase">Welcome To Your Cart</div>
      </div>
    </div>
  </header>
  <?php elseif($stranica == "http://malosamo.epizy.com/admin.php"):?>
   <header class="masthead">
    <div class="container">
      <div class="intro-text">
          <div class="intro-lead-in">Good to see you again</div>
          <div class="intro-heading text-uppercase">admin</div>
          
      </div>
    </div>
  </header>
  <?php else:?>

  <?php endif;?>
       
