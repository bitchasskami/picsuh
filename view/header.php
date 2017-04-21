<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="icon" href="picsuhlogo.jpg">
        <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="/js/script.js"></script>

    </head>
    <body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">PicSuh</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="/user">User</a></li>
                <li><a href="/picture">Gallery</a></li>
                        <?php
                        if(!empty($_SESSION['user'])) {
                            echo '<li><a href="/user">'. $_SESSION['user']->username .'</a></li>';
                        }

                        echo '</ul><ul class="nav navbar-nav navbar-right">';

                        if(empty($_SESSION['user'])) echo '<li><a href="/user/registration"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li><li><a href="/user/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                        else echo '<li><a href="/user/doLogout"><span class="glyphicon glyphicon-off"></span> Logout</a>';
                        ?>
            </ul>
        </div>
    </nav>