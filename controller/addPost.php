<?php 

session_start();

require('../src/config.php');


if(isset($_POST['addPost'])){

    $content = $_POST['content'];
    $title = $_POST['title'];
    $date = date('l jS \of F Y h:i:s A');

    if(!empty($title) && !empty($content)) {

        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $uploadOk = 1;
        $nameFile = basename($_FILES["picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        
          $check = getimagesize($_FILES["picture"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
            $picture = $target_file;
            move_uploaded_file($nameFile, "$target_dir");
            
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        


        $insertion = $conn->prepare('INSERT INTO post (content, title, picture, author, date) VALUES(:content,:title, :picture, :author, :date)');
        $insertion->bindValue('content', $content, PDO::PARAM_STR);
        $insertion->bindValue('title', $title, PDO::PARAM_STR);
        $insertion->bindValue('picture', $picture, PDO::PARAM_STR);
        $insertion->bindValue('author', $_SESSION["pseudo"], PDO::PARAM_STR);
        $insertion->bindValue('date', $date, PDO::PARAM_STR);

        try {
            $insertion->execute();
        }catch (PDOException $e){
            echo 'Error : ' . $e->getMessage();
            die();
        }

        $conn = null;

    }

};


?>