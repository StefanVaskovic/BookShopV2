<?php
    require_once "connection.php";
    if(isset($_POST['id'])){

        $id = $_POST['id'];
        

        $upit = "DELETE FROM naslov WHERE idNaslov = :id";

        $rez = $konekcija->prepare($upit);

        $rez->bindParam(':id',$id);


        try {

            $rez->execute();
            if($rez->execute()){
                $code = 202;
            }else{
                $code = 500;
            }

        } catch (PDOException $e) {

            $code = 500;
            echo $e->getMessage();
        }
        

    }
    echo http_response_code($code);
?>