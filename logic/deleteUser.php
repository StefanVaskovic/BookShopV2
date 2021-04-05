<?php
    require_once "connection.php";

    $code = 404;
    $data = null;

    if(isset($_POST['id'])){
        $idKorisnik = $_POST['id'];

        $upit = "DELETE FROM korisnik WHERE idKorisnik = :idKorisnik";

        $rez = $konekcija->prepare($upit);

        $rez->bindParam(':idKorisnik',$idKorisnik);

        try {
            $izvrsi = $rez->execute();
            if($izvrsi){
                $code = 202;
            }else{
                $code = 500;
            }
            
        } catch (PDOException $e) {
            $code = 500;
            echo $e->getMessage();
        }
    }
    http_response_code($code);
?>