<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">PicSuh</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="/user">User</a></li>
                <li><a href="/gallery">Gallery</a></li>
                <li><a href="/user">
                        <?php
                        if(!empty($_SESSION['user']))echo $_SESSION['user']->username;
                        echo '</a></li></ul><ul class="nav navbar-nav navbar-right">';

                        if(empty($_SESSION['user'])) echo '<li><a href="/user/registration"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li><li><a href="/user/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                        else echo '<li><a href="/user/doLogout"><span class="glyphicon glyphicon-off"></span> Logout</a>';
                        ?>
            </ul>
        </div>
    </nav>
