<?php
    session_start();
    require_once "connection.php";
    if(isset($_POST['sendMessageButton'])){
        $subject = $_POST['subject'];
        $email = $_POST['email'];
        $message = $_POST['message'];


        $reSubject = "/^[čćđšžчћшђљњж\w\s.]{1,100}$/";
        $reEmail = "/^[\w][\w\_\-\.\d]+\@[\w]+(\.[\w]+)?(\.[a-z]{2,3})$/";

        $greske = [];

        if(!$subject){
            $greske[] = "Subject must not be blank.";
        }elseif(!preg_match($reSubject,$subject)){
            $greske[] = "Letters,underscore,and numbers allowed";
        }
        if(!$email){
            $greske[] = "Email must not be blank.";

        }elseif(!preg_match($reEmail,$email)){
            $greske[] = "Email is not in good format.";
            
        }
        if(!$message){
            $greske[] = "Message must not be blank.";

        }

        if(count($greske)!=0){
            $_SESSION['greskeKontakt'] = $greske;
        }else{
            $upit = "INSERT INTO kontakt VALUES(NULL,:subject,:email,:message)";

            $rez = $konekcija->prepare($upit);
    
            $rez->bindParam(':subject',$subject);
            $rez->bindParam(':email',$email);
            $rez->bindParam(':message',$message);

            try {
                $izvrsi = $rez->execute();
                if($izvrsi){
                    $_SESSION['uspehKontakt'] = ["You successfuly sent a message!"];
                    header("Location: ../index.php?page=Contact");
                }else{
                    $_SESSION['greskeKontakt'] = ["Error sending a message."];
                    header("Location: ../index.php?page=Contact");     
                }
            } catch (PDOException $e) {
                $_SESSION['greskeKontakt'] = [$e->getMessage()];
                header("Location: ../index.php?page=Contact");
            }
        }
    }
?>