<?php 

session_start();

require('../src/config.php');


if(isset($_POST['addPost'])){

    $content = $_POST['content'];
    $title = $_POST['title'];
    $date = date('l jS \of F Y h:i:s A');

    if(!empty($title) && !empty($content)) {

        
       //$picture = 'upload/'.basename($_FILES["picture"]["name"]);
        $fichier = pathinfo($_FILES['picture']['name']);
        $extension_upload = $fichier['extension'];
        move_uploaded_file($_FILES['picture']['tmp_name'], '../upload/' .$title.'.'.$extension_upload);
        $file = 'upload/'.$title.'.'.$extension_upload;

        $insertion = $conn->prepare('INSERT INTO post (content, title, picture, author, date) VALUES(:content,:title, :picture, :author, :date)');
        $insertion->bindValue('content', $content, PDO::PARAM_STR);
        $insertion->bindValue('title', $title, PDO::PARAM_STR);
        $insertion->bindValue('picture', $file, PDO::PARAM_STR);
        $insertion->bindValue('author', $_SESSION["pseudo"], PDO::PARAM_STR);
        $insertion->bindValue('date', $date, PDO::PARAM_STR);

        try {
            $insertion->execute();
        }catch (PDOException $e){
            echo 'Error : ' . $e->getMessage();
            die();
        }

        $conn = null;

        header('Location:../index.php');
    }

};


?>