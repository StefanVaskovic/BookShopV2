<?php
    $serverName="localhost";
    $dbname = "knjizara";
    $username="root";
    $password = "";
    try{
        $konekcija = new PDO("mysql:host=$serverName;dbname=$dbname","$username","$password");

        $konekcija->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

    }catch(PDOException $e){
        echo "Greska sa konekcijom:".$e->getMessage();
    }
?>