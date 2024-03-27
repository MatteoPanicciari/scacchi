<?php
session_start();
if(!isset($_SESSION['idUtente'])){
    header('location: index.php');
    exit;    
}
?>
<!doctype html>
<html lang="it">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        
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
                <?php echo "Ciao ".$_SESSION['nutente']." di grado ".$_SESSION['grado']." e con id ".$_SESSION['idUtente']; ?>
            </div>
            <div class="card-body buttons-menu">
                <?php
                    if($_SESSION['grado']==1){
                        echo "<br><a href='admin/listautenti.php' class='btn btn-outline-warning'>Lista Utenti</a>";
                    }
                ?>
                <a href="php/logout.php" class="btn btn-outline-warning">Log-out</a>
            </div>
        </div>
    </body>
</html>