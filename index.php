<?php
session_start();
// echo var_dump($_SESSION);
//$_SESSION = array();
if(isset($_SESSION['idUtente'])){
    header('location: game.php');
    exit;    
}
?>
<!doctype html>
<html lang="it">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


        <!-- CSS File -->
        <link rel="stylesheet" href="css/style.css">
        
        <!-- Information -->
        <title>Scacchi Panicciari</title>
        <link rel="icon" href="media/logo.ico">
    </head>
    <body>
        <div class="box menu">
            <div class="card-body logo">
                <a href="index.php">
                    <div id="demo" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="media/logo.png" alt="Logo del Sito">
                            </div>
                            <div class="carousel-item">
                                <img src="media/login.png" alt="Home">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card-body menu">
                <a href="login.php" class="btn btn-outline-dark btn-block">Accedi</a>
                <a href="signup.php" class="btn btn-outline-dark btn-block">Registrati</a>
                <a href="game.php" class="btn btn-outline-dark btn-block">Classifiche    </a>
                <a href="game.php" class="btn btn-outline-dark btn-block">Informazioni</a>
            </div>
        </div>
    </body>
</html>
