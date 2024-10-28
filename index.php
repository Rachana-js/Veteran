<?php
require_once './include/config.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            <?php echo PROJECT_NAME; ?>
        </title>
        <link href="static/css/bootstrap.min.css" rel="stylesheet">
        <link href="static/css/custom.css" rel="stylesheet">
    </head>
    <body class="index">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light">
            <a class="navbar-brand text-white" href="#">
                <?php echo PROJECT_NAME; ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
       
    
  

        <div class="container">
            <div class="jumbotron jumbotron-transparent text-center my-4 text-white">
                <h1>Welcome to <?php echo PROJECT_NAME; ?>!</h1>
                <h4>Lorem Ipsum</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type
                    specimen book. It has survived not only five centuries, but also the leap into
                    electronic typesetting, remaining essentially unchanged. It was popularised
                    in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and more recently with desktop publishing software like Aldus PageMaker including
                    versions of Lorem Ipsum.
                </p>
            </div>
        </div>

        <script src="static/js/jquery.min.js"></script>
        <script src="static/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
