<?php
    require "connection.php";

    $upit = "SELECT * FROM naslov n INNER JOIN slikanaslov sn ON n.idNaslov = sn.idNaslov";

    $rez = $konekcija->query($upit);

    $knjige = $rez->fetchAll();

    echo json_encode($knjige);

?>