<?php 
require('../src/config.php');


if(isset($_POST['signup'])){

    $pseudo = $_POST['pseudo'];
    $mail = $_POST['mail'];
    $pass = $_POST['password'];
    $passv = $_POST['password2'];
    $password = password_hash($pass,PASSWORD_DEFAULT);

    if(!empty($pseudo) && !empty($mail) && !empty($pass)) {

        $req = $conn->prepare('SELECT * FROM users WHERE pseudo=?');
        $req->execute([$pseudo]);
        $user = $req->fetch();
        
        if(!$user){

            if($pass === $passv){

                $insertion = $conn->prepare('INSERT INTO users (pseudo, email, pass) VALUES(:pseudo,:mail, :pass)');
                $insertion->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
                $insertion->bindValue('mail', $mail, PDO::PARAM_STR);
                $insertion->bindValue('pass', $password, PDO::PARAM_STR);
                try {
                        $insertion->execute();
                    }
                catch (PDOException $e)
                    {
                    echo 'Error : ' . $e->getMessage();
                    die();
                    }

                $conn = null;

                header('Location:../view/login.php');
                session_start();
                $_SESSION['pseudo'] = $pseudo;

            }

        }

    }

};


?>