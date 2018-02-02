<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>2juzane Blog</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <!-- Custom stlylesheet -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="welcome/css/style.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Header -->
    <header id="home">
        <!-- Background Image -->
        <div class="bg-img" style="background-image: url('welcome/img/background1.jpg');">
            <div class="overlay"></div>
        </div>
        <!-- /Background Image -->

        <!-- home wrapper -->
        <div class="home-wrapper">
            <div class="container">
                <div class="row">

                    <!-- home content -->
                    <div class="col-md-10 col-md-offset-1">
                        <div class="home-content">
                            {{-- <h1 class="white-text">2juzane Blog</h1> --}}
                            <img class="img-responsive" src="images/logo.png" width="400" height="400" style="margin: 0 auto;">
                            <p class="white-text">
                            Meet, interract and go blast with other bloggers!
                            </p>
                            <a href="{{url('/login')}}"><button class="btn btn-lg btn-primary">Login</button></a>
                            <a href="{{url('/register')}}"><button class="btn btn-lg btn-success">Register</button></a>
                        </div>
                    </div>
                    <!-- /home content -->

                </div>
            </div>
        </div>
        <!-- /home wrapper -->

    </header>
    <!-- /Header -->

    <!-- Back to top -->
    <div id="back-to-top"></div>
    <!-- /Back to top -->

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- /Preloader -->

    <!-- jQuery Plugins -->
    <script type="text/javascript" src="welcome/js/jquery.min.js"></script>
    <script type="text/javascript" src="welcome/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="welcome/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="welcome/js/jquery.magnific-popup.js"></script>
    <script type="text/javascript" src="welcome/js/main.js"></script>

</body>

</html>
