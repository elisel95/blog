<?php 
require('../src/config.php');


if(isset($_GET['searchSubmit'])){

    $search = htmlspecialchars($_GET["search"], ENT_QUOTES, "UTF-8");

    if(!empty($search)) {

        $req = $conn->prepare('SELECT * FROM post WHERE title=?');
        $req->execute([$search]);
        $post = $req->fetch();
        
        if($post){

            $conn = null;

            header('Location:../view/result.php?search='.$search);
            session_start();
            $_SESSION['pseudo'] = $pseudo;
            
        }else{
            header('Location:../index.php');

        };

    }else{
        header('Location:../index.php');

    };
};

?>