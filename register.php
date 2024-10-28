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
    <body class="registration">
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
                        <a class="nav-link text-white" href="index.php">Home</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="jumbotron jumbotron-transparent text-white">
                        <h1 class="display-4">Hello, world!</h1>
                        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">Registration</h4>
                            <hr>
                            <form id="formRegistration" action="actions/login_action.php" method="post">
                                <input type="hidden" name="command" value="register">

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name"
                                           autocomplete="off"/>
                                </div>

                                <div class="form-group">
                                    <label>Contact</label>
                                    <input type="text" class="form-control form-control-sm" name="contact" id="contact"
                                           minlength="10" maxlength="10" autocomplete="off"/>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control form-control-sm" name="email" id="email"
                                           autocomplete="off"/>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control form-control-sm"
                                           name="password" id="password" autocomplete="off"/>
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control form-control-sm"
                                              name="address" id="address"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Register as</label>
                                    <br>
                                    <input type="radio" id="user" name="registrationType" value="1" checked="checked">
                                    <label for="user">User</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="doctor" name="registrationType" value="2">
                                    <label for="doctor">Veteran</label>
                                </div>

                                <div class="form-group text-center">
                                    <button id="btnRegister" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="static/js/jquery.min.js"></script>
        <script src="static/js/bootstrap.bundle.min.js"></script>
        <script src="static/js/login.js"></script>
    </body>
</html>