<?php
    session_start();
    require_once "connection.php";
    header("Content-type: application/json");
    $code = 404;
    $data = null;
    if(isset($_POST['send'])){
        $idIkolicinaNiz = $_POST['idNaslovaIkolicina'];

        if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv == 'korisnik'){
            $idKorisnik = $_SESSION['korisnik']->idKorisnik;
        }



        $upit1 = "INSERT INTO porudzbina(`idKorisnik`) VALUES ($idKorisnik)";

        try {
            $konekcija->beginTransaction();
            $konekcija->exec($upit1);
            $idPorudzbina = $konekcija->lastInsertId();
            $konekcija->commit();
            $code = 202;
        } catch (PDOException $e) {
            $konekcija->rollback();
            $code = 500;
            echo $e->getMessage();
        }



        $upit2 = "INSERT INTO porudzbina_detalji(`idPorudzbina`, `idNaslov`, `kolicina`) VALUES";
        foreach($idIkolicinaNiz as $k){
            $upitDelovi[] = '('.$idPorudzbina.','.$k['id'] .','.$k['kolicina'].')';
        }
        $upit2 .= implode(',',$upitDelovi);



        try {
            $konekcija->beginTransaction();
            $konekcija->exec($upit2);

            $konekcija->commit();
            $code = 202;
        } catch (PDOException $e) {
            $konekcija->rollback();
            $code = 500;
            echo $e->getMessage();
        }

    }
    http_response_code($code);
    echo json_encode($data);
?>