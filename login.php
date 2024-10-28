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
    <body class="login">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">
                <?php echo PROJECT_NAME; ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="jumbotron jumbotron-transparent">
                        <h1 class="display-4">Hello, world!</h1>
                        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">Login</h4>
                            <hr>
                            <form id="formLogin" action="actions/login_action.php" method="post">
                                <input type="hidden" name="command" value="login">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Login ID</label>
                                    <input type="text" class="form-control" name="loginId" id="loginId"
                                           autocomplete="off"/>
                                    <small class="form-text text-muted">Email or Contact number</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                           autocomplete="off"/>
                                </div>

                                <div class="form-group text-center">
                                    <button id="btnLogin" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>

                                <div class="form-group text-center">
                                    Don't have an account? Create <a href="register.php">now</a>!
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--redirect to home after successfull login (Admin)-->
        <form action="admin/animals.php" id="formAdminLoginRedirect" method="get"></form>
        <!--redirect to home after successfull login (Veteran)-->
        <form action="doctor/pending.php" id="formVeteranLoginRedirect" method="get"></form>
        <!--redirect to home after successfull login (User)-->
        <form action="user/animals.php" id="formUserLoginRedirect" method="get"></form>

        <script src="static/js/jquery.min.js"></script>
        <script src="static/js/bootstrap.bundle.min.js"></script>
        <script src="static/js/login.js"></script>
    </body>
</html>