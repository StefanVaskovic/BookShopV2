<?php
require "logic/connection.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $upit = "SELECT * FROM autor a INNER JOIN naslov_autor na 
        ON a.idAutor = na.idAutor INNER JOIN naslov n
        ON na.idNaslov = n.idNaslov INNER JOIN slikanaslov sn
        ON n.idNaslov = sn.idNaslov INNER JOIN zanr z
        ON n.idZanr = z.idZanr WHERE n.idNaslov = :id";
        $rez=$konekcija->prepare($upit);

        $rez->bindParam(':id',$id);
        
        try {
            $rez->execute();
            $knjiga = $rez->fetch();
            if($knjiga):
?>
<section class="bg-light page-section" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">Book Summary</h2>
            </div>
        </div>
        <div class="row" id="knjigeSumm">
            <div class="col-12  portfolio-item ">
                <div class="text-center">
                    <img class="img-fluid" src="<?= $knjiga->src?>" alt="<?= $knjiga->alt?>">
                </div>

                <div class="komentari pt-3">
                    <p><?= $knjiga->opis?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php else: header("Location: index.php");?>
    <!-- <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase pt-3">Book dosn't exists.</h2>
            </div>
        </div>
    </div> -->

<?php endif;?>
<?php
        } catch (PDOException $e) {
            echo $e->getMessage();
            header("Location: index.php");
        }
    }
   
?>