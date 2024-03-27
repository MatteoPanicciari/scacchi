<?php
$err=0;
session_start();
//$_SESSION = array();
if(isset($_SESSION['idUtente'])){
    header('location: game.php');
    exit;
}

if(isset($_POST['nutente'])){
    $nutente = $_POST['nutente'];
    $pwd = $_POST['pwd'];
    if(($nutente == "") or ($pwd == "")) {
        $err="Inserire entrambi i campi richiesti e riprovare!";
    }
    else {
        // Create connection
        $conn = mysqli_connect('localhost', 'root', '', 'scacchi');
        // Check connection
        if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
        
        //Cerco se c'è qualche utente che corrisponde alle credenziali
        $sql = 'SELECT *
                FROM utenti
                WHERE nutente="'.$nutente.'" AND pwd="'.$pwd.'"';
        $result = $conn->query($sql);
        
        //Controllo che sia stato trovato qualche utente con le credenziali inserite
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['idUtente'] = $row['idUtente'];
            $_SESSION['nutente'] = $row['nutente'];
            $_SESSION['grado'] = $row['grado'];
            header('location: login.php');
            exit;
        } 
        //Se non è stato trovato nessuno
        else {
            $err="Nessun utente corrisponde alle credenziali inserite!";
        }
        $conn->close();
    }
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

        <script src="https://kit.fontawesome.com/f71f4db253.js" crossorigin="anonymous"></script>

        <!-- CSS File -->
        <link rel="stylesheet" href="css/style.css">

        <!-- JS File -->
        <script type="text/javascript" src="js/eye_pwd.js"></script>
        
        <!-- Information -->
        <title>Scacchi Panicciari</title>
        <link rel="icon" href="media/logo.ico">
    </head>
    <body onload="eye_pwd()">
        <?php if($err!=0){
                    include("php/errore.php");
                    msgerr($err);
                } ?>
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
                <?php login(); ?>
            </div>
            <div class="card-body buttons-menu">
                <?php login_buttons();?>
            </div>
        </div>
    </body>
</html>
<?php
function login(){
    echo <<<login
        <div class="col-md-12 mx-auto">
            <form action="login.php" class="needs-validation" method="POST" id="form_login">
                <div class="form-group">
                    <label for="nutente">Nome Utente:</label>
                    <input type="text" class="form-control" placeholder="Inserisci Nome Utente" name="nutente">
                    <br>
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" placeholder="Inserisci Password" name="pwd" id="pwd">
                    <span class="fa-solid fa-eye eye" id="pwd_eye"></span>
                </div>
            </form>
        </div>
    login;
}

function login_buttons(){
    echo <<<buttons
        <div class ="col text-center">
            <button class="btn btn-warning mr-3" type="submit" style="background-color:#f7aa03;" form="form_login">Accedi</button>
            <button class="btn btn-warning" type="reset" style="background-color:#f7aa03;" form="form_login"> &zwnj; Reset &zwnj;</button>
            <br>
            <br>
            <a href="index.php" class="btn btn-outline-warning">Home</a>
        </div>
    buttons;
}
?>