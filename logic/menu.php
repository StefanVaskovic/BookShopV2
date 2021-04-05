<?php
    require_once "connection.php";

    $upit = "SELECT * FROM meni";

    $rez = $konekcija->query($upit)->fetchAll();

    
?>