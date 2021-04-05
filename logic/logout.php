
<?php
        
    session_start();

    if(isset($_SESSION['korisnik'])){
        unset($_SESSION['korisnik']);

        echo "success";
    }
?>

