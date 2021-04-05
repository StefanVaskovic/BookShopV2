<?php
    ob_start();
    session_start();
    header("Content-type:application/json");
    require "connection.php";
    $code = 404;

    $upitCount = "SELECT COUNT(*) as ukupnoKnjiga FROM naslov";
    $rez = $konekcija->query($upitCount)->fetch();
    
    $str=isset($_GET['str'])?$_GET['str']:1;
    $sve = $rez->ukupnoKnjiga;
    $poStrani = 3;
    $brStrana = ceil($sve/$poStrani);
    $_SESSION['brStrana'] = $brStrana;
    $offset = ($str-1)*$poStrani;

    $upit = "SELECT *,GROUP_CONCAT(DISTINCT z.naziv SEPARATOR '_') as zanrovi,GROUP_CONCAT(DISTINCT z.idZanr SEPARATOR '_') as idZanrovi FROM autor a LEFT JOIN naslov_autor na 
    ON a.idAutor = na.idAutor LEFT JOIN naslov n
    ON na.idNaslov = n.idNaslov LEFT JOIN slikanaslov sn
    ON n.idNaslov = sn.idNaslov LEFT JOIN naslov_zanr nz
    ON nz.idNaslov = n.idNaslov LEFT JOIN zanr z ON nz.idZanr=z.idZanr GROUP BY n.idNaslov LIMIT $poStrani OFFSET $offset";

    try {
        $rez = $konekcija->query($upit);
        if($rez){
            $code = 202;
            $data = $rez->fetchAll();
            // var_dump($data);
        }else{
            $code = 500;
        }
        

    } catch (PDOException $e) {
            $code = 500;
            echo $e->getMessage();
    }
    http_response_code($code);
    echo json_encode($data);
?>