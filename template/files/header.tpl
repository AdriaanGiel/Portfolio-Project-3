<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="template/img/favicon.ico">
    <title>Portfolio</title>
    <!-- Bootstrap core CSS -->
    <link href="template/css/bootstrap.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="include/ckeditor/ckeditor.js"></script>
    <!-- Custom styles for this template -->
    <link href="template/css/carousel.css" rel="stylesheet">
    <link href="template/css/extra.css" rel="stylesheet">
</head>
<!-- NAVBAR
================================================== -->
<header>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <!-- START BLOCK : NAV -->
            <div class="{CLASS}">
                <!-- END BLOCK : NAV -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Portfolio</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php?pageid=">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="index.php?pageid=7">Blog</a></li>
                        <li><a href="index.php?pageid=10">Projecten</a></li>
                        <li><a href="#contact">Contact</a></li>

                        <!-- START BLOCK : ADMINMENU -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="index.php?pageid=2">Admin Users</a></li>
                                <li><a href="index.php?pageid=6">Admin Projects</a></li>
                                <li><a href="index.php?pageid=3">Admin Blog</a></li>
                            </ul>
                        </li>
                        <!-- END BLOCK : ADMINMENU -->
                    </ul>
                    <!-- START BLOCK : CHOICE -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php?pageid=8$action=register">Registreren</a></li>
                        <li><a href="index.php?pageid={NUMMER}&action=login">inloggen</a></li>
                        </ul>

                    <!-- END BLOCK : CHOICE -->

                    <!-- START BLOCK : LOGINFORMTOP -->
                    <form class="navbar-form navbar-right" action="index.php?pageid=4" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Username" class="form-control" name="gnaam">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" name="password">
                        </div>
                        <input type="hidden" name="pageid" value="{PAGE}">
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </form>
                    <!-- END BLOCK : LOGINFORMTOP -->
                    <!-- START BLOCK : INGELOGD -->
                    <p  id="username" class="navbar-text navbar-right">Signed in as <a href="index.php?pageid=12" class="navbar-link"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>{USERNAME}</a>
                        <a href="index.php?pageid=5&action="> <button type="button" class="btn btn-danger btn-xs">Uitloggen</button></a></p>
                    <!-- END BLOCK : INGELOGD -->
                </div>
            </div>
        </nav>
</header>

<!-- START BLOCK : BODY -->
<body>
<!-- START BLOCK : BODY -->

<!-- START BLOCK : BODY2 -->
<body id="bodie">
<!-- START BLOCK : BODY2 -->

<!-- START BLOCK : CONTA -->
    <div class="container">
        <!-- START BLOCK : CONTA -->