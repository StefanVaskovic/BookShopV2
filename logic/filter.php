<?php
    require "connection.php";

    if(isset($_GET['id'])){
        
        $id = $_GET['id'];

        if($id!=0){
            $upit = "SELECT * FROM autor a INNER JOIN naslov_autor na 
            ON a.idAutor = na.idAutor INNER JOIN naslov n
            ON na.idNaslov = n.idNaslov INNER JOIN slikanaslov sn
            ON n.idNaslov = sn.idNaslov INNER JOIN zanr z
            ON n.idZanr = z.idZanr WHERE n.idZanr = :id";
    
            $rez = $konekcija->prepare($upit);
    
            $rez->bindParam(':id',$id);
    
            $rez->execute();
    
            $data = $rez->fetchAll();
    
            echo json_encode($data);
        }else{
            header("Location: ../index.php");
        }
       
    }else{
        header("Location: ../index.php");
    }

?>