<?php
    ob_start();
    session_start();
    require "connection.php";
 
    if(isset($_POST['btnLogin'])){
        $email = $_POST['emailLogin'];
        $password = $_POST['passLogin'];

        $errors = [];

        $reEmail = "/^[\w][\w\_\-\.\d]+\@[\w]+(\.[\w]+)?(\.[a-z]{2,3})$/";
        $rePassUser = "/^[\w\-\!\@\#\$\%\^\&\*\(\)\_\+\d]{6,}$/";


        if($email == ""){
            $errors[] = "Username should not be empty.";
        }elseif(!preg_match($reEmail,$email)){
            $errors[] = "Wrong email.";
        }
        if($password == ""){
            $errors[] = "Password should not be empty!";
        }elseif(!preg_match($rePassUser,$password)){
            $errors[] = "Wrong password.";
        }

        if(count($errors)>0){
            $_SESSION['greske']=["Password or email isn't in good format."];
            header("Location:../index.php?page=Login");
        }else{
            $password = md5($password);
           
            $upit = "SELECT k.idKorisnik,k.email,k.username,k.ime,u.naziv FROM korisnik k INNER JOIN uloga u ON k.idUloga = u.idUloga
            WHERE email = :email AND lozinka = :password";
    
            $provera = $konekcija->prepare($upit);
            $provera->bindParam(':email',$email);
            $provera->bindParam(':password',$password);
    
            $provera->execute();
    
            $user = $provera->fetch();
    
            if($user){
                $_SESSION['korisnik']=$user;
                if($user->naziv == "korisnik"){
                    header("Location:../index.php");
                }else{
                    header("Location:../admin.php");
                }
                
            }else{
                $_SESSION['greske']=["Wrong email or password,or account isn't active yet."];
                header("Location:../index.php?page=Login"); 
            }
        }

        
    }
?>