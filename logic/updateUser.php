<?php
    require_once "connection.php";

    if(isset($_POST['btnUpdUser'])){
        $idKorisnik = $_POST['idKorisnikHidden'];
        $email = $_POST['emailUpd'];
        $username = $_POST['usernameUpd'];

        $upit = "UPDATE korisnik SET email = :email,username = :username WHERE idKorisnik = :idKorisnik";

        $rez = $konekcija->prepare($upit);

        $rez->bindParam(':email',$email);
        $rez->bindParam(':username',$username);
        $rez->bindParam(':idKorisnik',$idKorisnik);

        try {
            $izvrsi = $rez->execute();
            
            header("Location: ../admin.php");
            
        } catch (PDOException $e) {
            header("Location: ../admin.php");
        }
    }
?>