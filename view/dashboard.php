<?php
session_start();

if(!isset($_SESSION["pseudo"])){
    header('Location : login.php');
}else{
?>


<!DOCTYPE html>
<html lang="fr">
  <head>
	<meta name="viewport" content="width-device-width,initial-scale=1">
    <meta charset="utf-8">
    <title>Connexion</title>
    <!-- -->
    <link
	  href="../src/style.css"
	  rel="stylesheet"
	/>
    <link
	  href="../src/styleDashboard.css"
	  rel="stylesheet"
	/>
	<!-- BOOTSTRAP -->
	<!-- Font Awesome -->
	<link
	  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
	  rel="stylesheet"
	/>
	<!-- Google Fonts -->
	<link
	  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
	  rel="stylesheet"
	/>
	<!-- MDB -->
	<link
	  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
	  rel="stylesheet"
	/>

  </head>
  <body class="gradient-custom">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                          
                <li class="nav-item">
                    <p class="nav-link navbar-nav"> Hello <?php echo $_SESSION['pseudo']; ?> </p>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                
            </ul>
            <form class="form-inline my-2 my-lg-0 navbar-nav position-absolute end-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    

    <div class="">

        <div class="row navDashboard" style='color:white;'>
            <div class="col-2">
                <ul style="list-style-type:none;">
                    <li><a style="color:white;" href="../controller/logout.php">Logout</a></li>
                    <li><a style="color:white;" href="addPost.php">Add a post</a></li>    
                </ul>
            </div>
            <div class="col-10">
                <ul>
            <?php

            require('../src/config.php');
            $author = $_SESSION['pseudo'];
            $req = $conn->prepare('SELECT * FROM post WHERE author = :author  ORDER BY id DESC');
            $req->execute(['author'=>$author]);
            $post = $req->fetch();
            foreach($req as $row){
                echo "<li><b>".$row['title']."</b> <em>".$row['date']."</em></li>";
            };
            ?>
                </ul>
            </div>
        </div>

    </div>






</body>
</html>

 
 
<?php 
}
?>
