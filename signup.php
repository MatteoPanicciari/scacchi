<?php
session_start();

if(isset($_SESSION['idUtente'])){
    header('location: game.php');
    exit;    
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $cittan = $_POST['cittan'];
    $datan = $_POST['datan'];
    $nutente = $_POST['nutente'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    // Create connection
    $conn = mysqli_connect('localhost', 'root', '', 'scacchi');
    // Check connection
    if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
    
    $sql = 'INSERT INTO utenti(nome,cognome,cittan,datan,nutente,email,pwd,grado) VALUES ("'.$nome.'","'.$cognome.'","'.$cittan.'","'.$datan.'","'.$nutente.'","'.$email.'","'.$pwd.'","0")';
    if (mysqli_query($conn, $sql)) {
        $sql = 'SELECT *
        FROM utenti
        WHERE nutente="'.$nutente.'" AND pwd="'.$pwd.'"';

        $result = $conn->query($sql);
                
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION['idUtente'] = $row['idUtente'];
                $_SESSION['nutente'] = $row['nutente'];
                $_SESSION['grado'] = $row['grado'];
            }
        }
        header('location: signup.php');
        exit;
    } else {
        echo "Errore registrazione utente: " . mysqli_error($conn);
    }
    mysqli_close($conn);
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
        <link rel="stylesheet" href="css/signup_style.css">

        <script src="https://kit.fontawesome.com/f71f4db253.js" crossorigin="anonymous"></script>

        <!-- JS File -->
        <script type="text/javascript" src="js/signup_manager.js"></script>
        <script type="text/javascript" src="js/eye_pwd.js"></script>
        
        <!-- Information -->
        <title>Scacchi Panicciari</title>
        <link rel="icon" href="media/logo.ico">
    </head>
    <body onload="start(); eye_two_pwd()">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">ERRORE!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="content">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" style="background-color:#f7aa03;">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--?php include("form_signup.php");?-->
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
                <div class="col-md-12 mx-auto">
                    <form action="signup.php" class="needs-validation" method="POST" id="form_signup">
                        <div class="form-group-signup" id="generalita"></div>
                        <div class="form-group-signup" id="nascita"></div>
                        <div class="form-group-signup" id="credenziali"></div>
                        <div class="form-group-signup" id="password"></div>
                    </form>
                </div>
            </div>
            <div class="card-body buttons-menu">
                <div id="space_buttons"></div>
            </div>
        </div>
    </body>
</html>