<?php
    require "connection.php";

    $upit = "SELECT * FROM naslov n INNER JOIN naslov_autor na ON n.idNaslov = na.idNaslov INNER JOIN autor a ON a.idAutor = na.idAutor";

    $rez = $konekcija->query($upit);

    $knjige = $rez->fetchAll();
?>