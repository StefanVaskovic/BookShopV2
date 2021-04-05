<?php
    ob_start();
    session_start();
    require "connection.php";
    header("Content-type:application/json");
    $code=404;
    $data=null;
    if(isset($_POST['send'])){
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $errors = [];

        $reIme = "/^([A-ZČĆŽŠĐŠЧЋШЂЉЊЖ][a-zčćđšžчћшђљњж]+)(\s[A-ZČĆŽŠĐŠЧЋШЂЉЊЖ][a-zčćđšžчћшђљњж]+)?$/";
        $rePrezime = "/^([A-ZČĆŽŠĐŠЧЋШЂЉЊЖ][a-zčćđšžчћшђљњж]+)(\s[A-ZČĆŽŠĐŠЧЋШЂЉЊЖ][a-zčćđšžчћшђљњж]+)?$/";
        $reEmail = "/^[\w][\w\_\-\.\d]+\@[\w]+(\.[\w]+)?(\.[a-z]{2,3})$/";
        $rePassUser = "/^[\w\-\!\@\#\$\%\^\&\*\(\)\_\+\d]{6,}$/";

        if($ime == ""){
            $errors[] = "Name should not be empty!";
        }elseif(!preg_match($reIme,$ime)){
            $errors[] = "First uppercase letter is missing for name.";
        }
        if($prezime == ""){
            $errors[] = "Surname should not be empty!";
        }elseif(!preg_match($rePrezime,$prezime)){
            $errors[] = "First uppercase letter is missing for surname.";
        }
        if($username == ""){
            $errors[] = "Username should not be empty.";
        }elseif(!preg_match($rePassUser,$username)){
            $errors[] = "Username should have 6 or more characters without spaces.";
        }
        if($email == ""){
            $errors[] = "Email should not be empty!";
        }elseif(!preg_match($reEmail,$email)){
            $errors[] = "Email is not in good format";
        }
        if($password == ""){
            $errors[] = "Password should not be empty!";
        }elseif(!preg_match($rePassUser,$password)){
            $errors[] = "Password should have 6 or more characters";
        }
        if($cpassword == ""){
            $errors[] = "Password confirmaton should not be empty!";
        }elseif(!preg_match($rePassUser,$cpassword)){
            $errors[] = "Password should have 6 or more characters without spaces.";
        }
        if($password != $cpassword){
            $errors[] = "Passwords do not match.";
        }
        $password = md5($password);

        if(count($errors)){
            $code = 422;
            $data = $errors;

        }else{
            $upit = "INSERT INTO korisnik(ime,prezime,email,username,lozinka,idUloga) VALUES(:ime,:prezime,:email,:username,:password,2)";
            $priprema = $konekcija->prepare($upit);
            $priprema->bindParam(':ime',$ime);
            $priprema->bindParam(':prezime',$prezime);
            $priprema->bindParam(':email',$email);
            $priprema->bindParam(':username',$username);
            $priprema->bindParam(':password',$password);

            try{
                if($priprema->execute()){
                    $code = 201;
                }
                
            }catch(PDOException $e){
                $code = 409;
            }
        }
    }
    http_response_code($code);
    echo json_encode($data);
?>