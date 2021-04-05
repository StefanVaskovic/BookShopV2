<?php
    require "connection.php";

    $upit = "SELECT * FROM autor";

    $rez = $konekcija->query($upit);

    $data = $rez->fetchAll();

    echo json_encode($data);

?>