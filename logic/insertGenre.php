<?php
    header("Content-type:application/json");
    require_once "connection.php";
    $code = 404;
    $data = null;

    if(isset($_POST['zanr'])){
        $zanr = $_POST['zanr'];

        if($zanr != ""){
            $upit = "INSERT INTO zanr VALUES(NULL,:zanr)";

            $rez = $konekcija->prepare($upit);

            $rez->bindParam(':zanr',$zanr);

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
    }
    http_response_code($code);
    echo json_encode($data);
?>