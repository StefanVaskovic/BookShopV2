<?php
    ob_start();
    session_start();
    require_once "connection.php";
    header("Content-type:application/json");
    $code = 404;
    $data = null;

    if(isset($_POST['id'])){
        $idZanr = $_POST['id'];
        
        $idKorisnik = $_SESSION['korisnik']->idKorisnik;




        $upit = "SELECT * FROM anketa WHERE aktivna = 1";

        $rez = $konekcija->query($upit)->fetch();

        // $akitvna = $rez->aktivna;

        $idAnketa = $rez->idAnketa;




        $upit1 = "SELECT * FROM anketa a INNER JOIN odgovor o ON a.idAnketa=o.idAnketa WHERE idKorisnik = :idKorisnik AND aktivna = 1";

        $rez1 = $konekcija->prepare($upit1);

        $rez1->bindParam(':idKorisnik',$idKorisnik);

        $rez1->execute();

        // $akitvna = $rez1->fetch()->aktivna;

        if($rez1->rowCount() == 0){
            $upit2 = "INSERT INTO glasanje VALUES(:idKorisnik,:idZanr)";

            $rez2 = $konekcija->prepare($upit2);

            $rez2->bindParam(':idKorisnik',$idKorisnik);
            $rez2->bindParam(':idZanr',$idZanr);


            $upit3 = "INSERT INTO odgovor VALUES(:idKorisnik,:idAnketa)";

            $rez3 = $konekcija->prepare($upit3);

            $rez3->bindParam(':idKorisnik',$idKorisnik);
            $rez3->bindParam(':idAnketa',$idAnketa);

            try {
                $konekcija->beginTransaction();
                $rez2->execute();
                $rez3->execute();
                $konekcija->commit();
                $code = 202;
            } catch (PDOException $e) {
                $konekcija->rollback();
                $code = 500;
                echo $e->getMessage();
            }

        }else{
            $code = 500;
        }
    }
    http_response_code($code);
    echo json_encode($data);
?>