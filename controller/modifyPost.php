<?php 

session_start();

require('../src/config.php');


if(isset($_POST['modifyPost'])){

    $content = $_POST['content'];
    $title = $_POST['title'];
    $date = date('l jS \of F Y h:i:s A');

    if(!empty($title) || !empty($content)) {

        
        if(!empty($_FILES['picture']['name'])) {
        
            $fichier = pathinfo($_FILES['picture']['name']);
            $extension_upload = $fichier['extension'];
            move_uploaded_file($_FILES['picture']['tmp_name'], '../upload/' .$title.'.'.$extension_upload);
            $file = 'upload/'.$title.'.'.$extension_upload;
        }else{
            $req = $conn->prepare('SELECT * FROM post WHERE id = "' . $_GET['id'] . '"');
            $req->execute();
            $post = $req->fetch();
            $file = $post['picture'];
        }

        $modif = $conn->prepare('UPDATE post SET content=:content, title=:title, picture=:picture, date=:date WHERE id="'.$_GET['id'].'"');
        $modif->bindValue('content', $content, PDO::PARAM_STR);
        $modif->bindValue('title', $title, PDO::PARAM_STR);
        $modif->bindValue('picture', $file, PDO::PARAM_STR);
        $modif->bindValue('date', $date, PDO::PARAM_STR);

        try {
            $modif->execute();
        }catch (PDOException $e){
            echo 'Error : ' . $e->getMessage();
            die();
        }

        $conn = null;
        
        header('Location:../view/dashboard.php');
        
    }

};


?>