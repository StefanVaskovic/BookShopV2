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
        $imeAutora = $_POST['imeAutora'];
        $prezimeAutora = $_POST['prezimeAutora'];
        $src = $_POST['src'];
        $srcCart = $_POST['srcCart'];


        $upit1 = "INSERT INTO naslov VALUES(NULL,:naslov,:novaCena,:staraCena,:opis,:datumObjave)";
        $upit5 = "INSERT INTO naslov_zanr VALUES(NULL,?,?)";

        $rez1 = $konekcija->prepare($upit1);
        $rez5 = $konekcija->prepare($upit5);

        $rez1->bindParam(':naslov',$naslov);
        $rez1->bindParam(':novaCena',$novaCena);
        $rez1->bindParam(':staraCena',$staraCena);
        $rez1->bindParam(':opis',$opis);
        $rez1->bindParam(':datumObjave',$datumObjave);


 
       try {
        if($imeAutora != "" && $prezimeAutora != ""){
            $upit2 = "INSERT INTO autor VALUES(NULL,:ime,:prezime)";
    
            $rez2 = $konekcija->prepare($upit2);
    
            $rez2->bindParam(':ime',$imeAutora);
            $rez2->bindParam(':prezime',$prezimeAutora);
           }else{
               $code=500;
           }
       } catch (PDOException $e) {
           $code = 500;
           echo $e->getMessage();
       }



        $upit3 = "INSERT INTO naslov_autor VALUES(NULL,:idNaslov,:idAutor)";



        $rez3 = $konekcija->prepare($upit3);

        $rez3->bindParam(':idNaslov',$idPn);
        $rez3->bindParam(':idAutor',$idPa);



        
        $alt = "knjiga" . mktime();
        

        $upit4= "INSERT INTO slikanaslov VALUES(:idNaslov,:src,:srcKorpa,:alt)";



        $rez4 = $konekcija->prepare($upit4);

        $rez4->bindParam(':idNaslov',$idPn);
        $rez4->bindParam(':src',$src);
        $rez4->bindParam(':srcKorpa',$srcCart);
        $rez4->bindParam(':alt',$alt);




        try {
         
            
            $konekcija->beginTransaction();
            $rez1->execute();
            $idPn = $konekcija->lastInsertId();
            $rez5->execute([$idPn,$zanrId]);
            $rez2->execute();
            $idPa = $konekcija->lastInsertId();

            $rez3->execute();
            $rez4->execute();
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