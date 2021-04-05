<?php
    require_once "connection.php";
    header("Content-type:application/json");
    $code = 404;
    $data = null;

    if(isset($_POST['send'])){
        $idKorisnik = $_POST['idK'];

        $upitKorisnici = "SELECT * FROM korisnik WHERE idKorisnik = :idKorisnik";

        $rezKorisnici = $konekcija->prepare($upitKorisnici);  

        $rezKorisnici->bindParam(':idKorisnik',$idKorisnik);

        try {
            $izvrsi = $rezKorisnici->execute();

            if($izvrsi){
                $data = $rezKorisnici->fetch();
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
    echo json_encode($data);

?>