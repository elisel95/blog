<?php 
require('../src/config.php');


if(isset($_POST['login'])){

    $pseudo = $_POST['pseudo'];
    $pass = $_POST['password'];

    if(!empty($pseudo) && !empty($pass)) {

        $req = $conn->prepare('SELECT * FROM users WHERE pseudo=?');
        $req->execute([$pseudo]);
        $user = $req->fetch();
        
        if($user && password_verify($pass,$user['pass'])){

            $conn = null;

            header('Location:../index.php');
            session_start();
            $_SESSION['pseudo'] = $pseudo;


        }

    }

};


?>