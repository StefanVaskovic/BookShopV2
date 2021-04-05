<?php require_once "logic/menu.php";?>

<nav class="navbar navbar-expand-lg navbar-light bg-light" id="mainNav">
    <div class="container">
    <?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=='korisnik'):?>
      <a class="navbar-brand js-scroll-trigger ostaje" href="index.php">Book Shop</a>
    <?php else:?>
      <a class="navbar-brand js-scroll-trigger ostaje" href="admin.php">Book Shop</a>
    <?php endif;?>
      <button id="menu" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
        data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
        aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <?php
              foreach($rez as $m):
          ?>
          <?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=='korisnik' && $m->naziv != 'Register' && $m->naziv != 'Login'):?>
            <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="<?= $m->href?>"><?= $m->naziv?></a>
          </li>
          <?php endif; if(!isset($_SESSION['korisnik'])):?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="<?= $m->href?>"><?= $m->naziv?></a>
          </li>
         <?php endif;?>
          <?php endforeach;?>
          <?php if(isset($_SESSION['korisnik'])):?>
           <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php?page=Logout">Logout</a>
          </li>
          <?php endif;?> 
        </ul>
      </div>
    </div>
  </nav>