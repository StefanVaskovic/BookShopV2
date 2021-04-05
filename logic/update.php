<?php
    require_once "connection.php";
    if(isset($_POST['btnUpd'])){
        $idNaslov = $_POST['idNaslovHidden'];
        $idNaslovAutor = $_POST['idNaslovAutorHidden'];
        $naslov = $_POST['titleUpd'];
        $novaCena = $_POST['newPriceUpd'];
        $staraCena = $_POST['oldPriceUpd'];
        $opis = $_POST['messageUpd'];
        $datumObjave = $_POST['dateUpd'];
        $zanrId = $_POST['ddlGenreUpd'];
        $idAutor = $_POST['ddlAutorUpd'];

        $upit1 = "UPDATE naslov SET naslov=:naslov,novaCena=:novaCena,staraCena=:staraCena,opis=:opis,datumObjave=:datumObjave,idZanr=:zanrId WHERE idNaslov=:idNaslov";

        $rez1 = $konekcija->prepare($upit1);

        $rez1->bindParam(':naslov',$naslov);
        $rez1->bindParam(':novaCena',$novaCena);
        $rez1->bindParam(':staraCena',$staraCena);
        $rez1->bindParam(':opis',$opis);
        $rez1->bindParam(':datumObjave',$datumObjave);
        $rez1->bindParam(':zanrId',$zanrId);
        $rez1->bindParam(':idNaslov',$idNaslov);


        
        $upit2 = "UPDATE naslov_autor SET idNaslov=:idNaslov,idAutor=:idAutor WHERE idNaslovAutor=:idNaslovAutor";

        $rez2 = $konekcija->prepare($upit2);

        $rez2->bindParam(':idNaslov',$idNaslov);
        $rez2->bindParam(':idAutor',$idAutor);
        $rez2->bindParam(':idNaslovAutor',$idNaslovAutor);

        try {
            $konekcija->beginTransaction();
            $rez1->execute();
            $rez2->execute();
            $konekcija->commit();
            header("Location: ../admin.php");
        } catch (PDOException $e) {
            $konekcija->rollback();
        }

    }

?>