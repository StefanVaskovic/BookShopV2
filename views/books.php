 <?php
    require "logic/connection.php";
    if(!isset($_SESSION['brStrana'])){
      header("Refresh:0");
    }
?>



<section class="bg-light page-section" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">Books</h2>
                <h3 class="section-subheading text-muted">Take a look what we offer!</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="row" id="filterIsort">
                    <div class="col-lg-12 text-center p-3 mb-2 bg-dark">
                        <label>Search for products</label>
                        <input type="text" name="" class="form-control" id="tbSearch" placeholder="Search..." />
                    </div>
                    <div class="col-lg-12 p-3 mb-2 bg-dark text-center text-white" id="zanrovi">
                        <label>Genres</label>
                        <select id="ddlGenre" class="form-control">
                            <option value="0">Choose</option>

                        </select>
                    </div>
                    <div class="col-lg-12 text-center p-3 mb-2 bg-dark text-white">
                        <label>Sort By</label>
                        <select id="ddlSortBy" class="form-control">
                            <option value="0">Choose</option>

                        </select>
                    </div>
                    <div class="col-lg-12 text-center p-3 mb-2 bg-dark text-white">
                        <button class="btn btn-light" id="apply">Apply</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row" id="knjige">

                </div>
                <?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv == 'korisnik'):?>
                    <input type="hidden" class="korisnikJeUlogovan" />
                <?php endif;?>
            </div>
            <div id="stranice">

                <?php for($i=1;$i<=$_SESSION['brStrana'];$i++):?>
                <a href="#" class="p-3 text-dark stranica" data-str="<?= $i?>"><?= $i?></a>
                <?php endfor;?>

            </div>
        </div>
    </div>
</section>
<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv == 'korisnik'):?>
<a href="index.php?page=Survey" class="anketa rounded-circle p-3 mb-2 bg-warning text-dark">SURVEY</a>
<?php endif;?>