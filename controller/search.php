<?php 
require('../src/config.php');


if(isset($_GET['searchSubmit'])){

    $search = htmlspecialchars($_GET["search"]);

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
                echo 'Not found <a href="../index.php"> Go back to homepage </a>';

            };
    }else{
        header('Location:../index.php');

    };
};

?>