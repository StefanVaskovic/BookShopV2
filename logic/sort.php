<?php
    require "connection.php";

    if(isset($_GET['sort'])){
        
        $sort = $_GET['sort'];
        $orderBy = explode("-",$sort);

        if($sort!="0"){
            $upit = "SELECT * FROM autor a INNER JOIN naslov_autor na 
            ON a.idAutor = na.idAutor INNER JOIN naslov n
            ON na.idNaslov = n.idNaslov INNER JOIN slikanaslov sn
            ON n.idNaslov = sn.idNaslov INNER JOIN zanr z
            ON n.idZanr = z.idZanr ORDER BY ".$orderBy[0].' '.$orderBy[1];
    
            $rez = $konekcija->query($upit);
    
            $data = $rez->fetchAll();
    
            echo json_encode($data);
        
        }else{
            header("Location: ../index.php");
        }
    }else{
        header("Location: ../index.php");
    }

?>