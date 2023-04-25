<?php
session_start();

if(!isset($_SESSION["pseudo"])){
    header('Location : login.php');
}else{

    require('../src/config.php');
            $req = $conn->prepare('SELECT * FROM post WHERE id = "' . $_GET['id'] . '"');
            $req->execute();
            $post = $req->fetch();

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
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                
            </ul>
            <form class="form-inline my-2 my-lg-0 navbar-nav position-absolute end-0" method="get" action="../controller/search.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search" >
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="searchSubmit">Search</button>
            </form>
        </div>
    </nav>
    

    <div class="">

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                <form method="post" name="modifyPost" action='../controller/modifyPost.php?id=<?php echo $_GET['id']; ?>' class="mb-md-5 mt-md-4 pb-5" enctype="multipart/form-data">

                    <h2 class="fw-bold mb-2 text-uppercase">Modify post</h2>

                    <div class="form-outline form-white mb-4">
                        <input type="text"  name="title"  class="form-control form-control-lg" value="<?php echo $post['title']; ?>"/>
                       </div>

                    <div class="form-floating">
                        <input value="<?php echo $post['content']; ?>" class="form-control" name="content" placeholder="Leave a comment here" id="floatingTextarea" >
                    </div>

                    <div class="mb-3 form-outline">
                         <input class="form-control form-control-sm" name="picture" id="formFileSm" type="file">
                    </div>


                    <button class="btn btn-outline-light btn-lg px-5" name="modifyPost" type="submit">Modify</button>

                 </form>

                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    </div>

</body>

</html>

 
<?php 
}
?>
