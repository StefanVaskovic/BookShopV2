<?php
    require "connection.php";

    $upit = "SELECT * FROM zanr";

    $rez = $konekcija->query($upit);

    $data = $rez->fetchAll();

    echo json_encode($data);

?>