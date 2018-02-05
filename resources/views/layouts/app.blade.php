<?php

if(!empty(auth()->user()->user_photo))
{
    $src=auth()->user()->user_photo;
}else
{
    $src='https://www.shareicon.net/data/128x128/2016/06/25/786529_people_512x512.png';
}

?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>2juzane - @yield('title')</title>

    <!-- Styles -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}"> --}}
    
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        UPLOADCARE_PUBLIC_KEY = '3f7f757fee6f8c69eb27';
        UPLOADCARE_TABS = 'file camera url facebook gdrive gphotos dropbox instagram';
        UPLOADCARE_PREVIEW_STEP = true;
        UPLOADCARE_CLEARABLE = true;
    </script>
    <script charset="utf-8" src="https://ucarecdn.com/libs/widget/3.2.1/uploadcare.full.min.js"></script>

    <style type="text/css" media="screen">
        body{
            background:url('../images/bg11.jpg'),no-repeat;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
        .navbar{
            opacity: 0.7;
        }
        #snackbar {
            visibility: hidden;
            /*min-width: 250px;*/
            background-color: #009936;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 15px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
            border-radius: 10px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;} 
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;} 
            to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="img-responsive" style="max-width: 70px; max-height: 70px;" src="{{ secure_asset('images/logo.png') }}">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Links for all (guest, users) -->
                        <li><a href="{{ route('posts') }}"><i class="fas fa-list-alt"></i> Articles</a></li>
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"> Sign in</i></a></li>
                            <li><a href="{{ route('register') }}" title="Register"><i class="fas fa-user-plus"> Sign up</i></a></li>
                        @else
                            <li><a href="{{ route('newpost') }}"><i class="fas fa-edit"> New Article</i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fas fa-user"></i> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('view', ['user' => Auth::user()]) }}"><img class="img-responsive" style="border-radius: 50%;" src="{{ $src }}" width="50px" height="50px"></a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                           <i class="fas fa-sign-out-alt"></i> Signout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @include('includes.messages')
        @yield('content')
    </div>

    <!-- Scripts -->
    <script type="text/javascript">
        
    </script>
    <script src="{{ secure_asset('js/app.js') }}"></script>
</body>
</html>
