<?php
    ob_start();
    require "connection.php";
    header("Content-type:application/json");
    $data = null;
    $code = 404;

    if(isset($_POST['send'])){
        $naslov = $_POST['naslov'];
        $novaCena = $_POST['novaCena'];
        $staraCena = $_POST['staraCena'];
        $opis = $_POST['opis'];
        $datumObjave = $_POST['datumObjave'];
        $zanrId = $_POST['zanrId'];
        $autorId = $_POST['autor'];
        $src = $_POST['src'];
        $srcCart = $_POST['srcCart'];



        $upit1 = "INSERT INTO naslov VALUES(NULL,:naslov,:novaCena,:staraCena,:opis,:datumObjave,:zanrId)";

        $rez1 = $konekcija->prepare($upit1);

        $rez1->bindParam(':naslov',$naslov);
        $rez1->bindParam(':novaCena',$novaCena);
        $rez1->bindParam(':staraCena',$staraCena);
        $rez1->bindParam(':opis',$opis);
        $rez1->bindParam(':datumObjave',$datumObjave);
        $rez1->bindParam(':zanrId',$zanrId);
        

        $upit2 = "INSERT INTO naslov_autor VALUES(NULL,:idNaslov,:idAutor)";

        $rez2 = $konekcija->prepare($upit2);

        $rez2->bindParam(':idNaslov',$idPn);
        $rez2->bindParam(':idAutor',$autorId);

        $alt = "knjiga" . mktime();
        

        $upit3= "INSERT INTO slikanaslov VALUES(:idNaslov,:src,:srcKorpa,:alt)";

        $rez3 = $konekcija->prepare($upit3);

        $rez3->bindParam(':idNaslov',$idPn);
        $rez3->bindParam(':src',$src);
        $rez3->bindParam(':srcKorpa',$srcCart);
        $rez3->bindParam(':alt',$alt);

        
        try {
            $konekcija->beginTransaction();
            $rez1->execute();
            $idPn = $konekcija->lastInsertId();
            $rez2->execute();
            $rez3->execute();
            $konekcija->commit();
            
            $code=202;
           
        } catch (PDOException $e) {
            $konekcija->rollback();
           $code = 409;
            echo $e->getMessage();
        }

    }
    http_response_code($code);
    echo json_encode($data);
?>