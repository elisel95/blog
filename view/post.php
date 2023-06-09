<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
	<meta name="viewport" content="width-device-width,initial-scale=1">
    <meta charset="utf-8">
    <title>Connexion</title>
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
    <!-- -->
    <link
	  href="../src/style.css"
	  rel="stylesheet"
	/>
  </head>
  <body class="gradient-custom" style="color:white;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                
                <?php
                if(!isset($_SESSION["pseudo"])){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>  
                <?php
                }else{
                ?>
                <li class="nav-item">
                    <p class="nav-link navbar-nav"> Hello <?php echo $_SESSION['pseudo']; ?> </p>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <?php
                };
                ?>
                
            </ul>
            <form class="form-inline my-2 my-lg-0 navbar-nav position-absolute end-0" method="get" action="../controller/search.php">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="searchSubmit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
    <div class="row" style='margin-left:10%;margin-top:50px;'>
    <?php
            require('../src/config.php');
            $req = $conn->prepare('SELECT * FROM post WHERE id = "' . $_GET['id'] . '"');
            $req->execute();
            $post = $req->fetch();
                echo "<h2>".$post['title']."</h2><br> <p><em>".$post['date']." - ".$post['author']."</em><br><img style='width:100px;' alt='".$post['title']."' src='".$post['picture']."'><br>".$post['content']."</p>";

    ?>
    </div>
    </div>

  </body>
</html>

