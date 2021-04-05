<?php
    ob_start();
    require_once "connection.php";
    $data = null;
    $code = 404;


    if(isset($_POST['send'])){

        $idK = $_POST['idK'];
        $idA = $_POST['idA'];

        $upit = "SELECT * FROM naslov n LEFT OUTER JOIN naslov_autor na ON n.idNaslov = na.idNaslov LEFT OUTER JOIN autor a ON a.idAutor = na.idAutor WHERE n.idNaslov = :idK AND a.idAutor = :idA";


        $rez = $konekcija->prepare($upit);

        $rez->bindParam(':idK',$idK);
        $rez->bindParam(':idA',$idA);

        try {
            $rez->execute();
            if($rez->execute()){
                $data = $rez->fetch();
                $code = 202;
            }else{
                $code = 500;
            }
        } catch (PDOException $e) {
            $code = 500;
        }
    }
    http_response_code($code);
    echo json_encode($data);
?>