<?php
session_start();
//Controllo che sia loggato
if(!isset($_SESSION['idUtente'])){
    header('location: ../index.php');
    exit;    
}
//Controllo che sia un admin
if($_SESSION['idUtente']==0){
    header('location: ../game.php');
    exit;    
}

// Create connection
$conn = mysqli_connect('localhost', 'root', '', 'scacchi');
// Check connection
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

//Seleziono tutti gli utenti
$sql = 'SELECT *
        FROM utenti';
$result = $conn->query($sql);

$users = array();
$i = 0;

$row = $result->fetch_assoc();

do {
    $users[$i] = $row;
    $i++;
} while($row = $result->fetch_assoc());
$conn->close();
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
        <link rel="stylesheet" href="../css/style.css">

        <script src="https://kit.fontawesome.com/f71f4db253.js" crossorigin="anonymous"></script>
        
        <!-- Information -->
        <title>Scacchi Panicciari</title>
        <link rel="icon" href="../media/logo.ico">
    </head>
    <body>
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
        <table class="tabella table table-bordered" id="lista">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Data Nascita</th>
                    <th scope="col">Luogo Nascita</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Nome Utente</th>
                    <th scope="col">Password</th>
                    <th scope="col">Grado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <?php
                echo '  <tr>
                        <td></td>
                        <td>'.$users[0]['idUtente'].'</td>
                        <td>'.$users[0]['nome'].'</td>
                        <td>'.$users[0]['cognome'].'</td>
                        <td>'.$users[0]['datan'].'</td>
                        <td>'.$users[0]['cittan'].'</td>
                        <td>'.$users[0]['email'].'</td>
                        <td>'.$users[0]['nutente'].'</td>
                        <td>'.$users[0]['pwd'].'</td>
                        <td>'.$users[0]['grado'].'</td>
                        <td></td>
                        </tr>
                    ';


                foreach(array_slice($users,1) as $user){
                    echo '  <tr>
                            <td id="bin"><i onClick=eliminaRiga(this) class="fa-solid fa-trash-can table-option"></i></td>
                            <td>'.$user['idUtente'].'</td>
                            <td>'.$user['nome'].'</td>
                            <td>'.$user['cognome'].'</td>
                            <td>'.$user['datan'].'</td>
                            <td>'.$user['cittan'].'</td>
                            <td>'.$user['email'].'</td>
                            <td>'.$user['nutente'].'</td>
                            <td>'.$user['pwd'].'</td>
                            <td>'.$user['grado'].'</td>
                            <td id="pencil"><i onClick=modificaRiga(this) class="fa-solid fa-pencil table-option"></i></td>
                            </tr>
                        ';
                }
            ?>
        </table>
        <a href="../game.php" class="btn btn-outline-warning">Home</a>
        <buuton onClick="aggiungiRiga()" class="btn btn-warning">Aggiungi</a>
    </body>
</html>

<script>
    function eliminaRiga(cella) { 
        var index = cella.parentNode.parentNode.rowIndex;
        var table = document.getElementById('lista');
        var id = table.rows[index].cells[1].innerHTML;
        table.deleteRow(index);
   
        //creazione dell'oggetto per gestire la richiesta AJAX
        var richiesta = new XMLHttpRequest();
        //configurazione e invio della riciesta ajax
        richiesta.open("POST","../php/ajax.php",false);
        richiesta.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var str = "fun=2&id=" + encodeURIComponent(id);
        richiesta.send(str);
    }

    function modificaRiga(cella) { 
        var index = cella.parentNode.parentNode.rowIndex;
        var table = document.getElementById('lista');
        var mod_row = table.rows[index];
        
        var clone = mod_row.cloneNode(true);    // copy children too
        table.appendChild(clone);               // add new row to end of table
        clone.id='idclone';
        mod_row.id='idrow';
        clone.style.display = 'none';           // hide the clone row

        mod_row.cells[2].innerHTML = '<input value='+clone.cells[2].innerHTML+' type="text" class="form-control modify-form">'
        mod_row.cells[3].innerHTML = '<input value="'+clone.cells[3].innerHTML+'" type="text" class="form-control modify-form">'
        mod_row.cells[4].innerHTML = '<input value="'+clone.cells[4].innerHTML+'" type="date" class="form-control modify-form">'
        mod_row.cells[5].innerHTML = '<input value="'+clone.cells[5].innerHTML+'" type="text" class="form-control modify-form">'
        mod_row.cells[6].innerHTML = '<input value="'+clone.cells[6].innerHTML+'" type="email" class="form-control modify-form">'
        mod_row.cells[7].innerHTML = '<input value="'+clone.cells[7].innerHTML+'" type="text" class="form-control modify-form">'
        mod_row.cells[8].innerHTML = '<input value="'+clone.cells[8].innerHTML+'" type="text" class="form-control modify-form">'
        mod_row.cells[9].innerHTML = '<input value="'+clone.cells[9].innerHTML+'" type="text" class="form-control modify-form">'
        mod_row.cells[0].innerHTML = ''
        mod_row.cells[10].innerHTML ='<i onClick=confermaModifica() class="fa-solid fa-circle-check table-option"></i> \
                                      <i onClick=annullaModifica() class="fa-solid fa-circle-xmark table-option"></i>'
    }

    function confermaModifica(){
        var mod_row = document.getElementById("idrow");

        var res = controlloModifica();
        if(res!=0) {
            document.getElementById('content').textContent = res;
            $("#myModal").modal("show");
        }
        else {
            var clone = document.getElementById("idclone");
            for(let i=2 ; i<10 ; i++) {
                clone.cells[i].innerHTML = document.getElementsByClassName("modify-form")[i-2].value;
            } 
            for(let i=0 ; i<=10 ; i++) {
                mod_row.cells[i].innerHTML = clone.cells[i].innerHTML;
            } 
            var richiesta = new XMLHttpRequest();
            richiesta.open("POST","../php/ajax.php",false);
            richiesta.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var str = "fun=3&id=" + encodeURIComponent(mod_row.cells[1].innerHTML) + "&nome=" + encodeURIComponent(mod_row.cells[2].innerHTML) + "&cognome=" + encodeURIComponent(mod_row.cells[3].innerHTML) + "&datan=" + encodeURIComponent(mod_row.cells[4].innerHTML) + "&cittan=" + encodeURIComponent(mod_row.cells[5].innerHTML) + "&email=" + encodeURIComponent(mod_row.cells[6].innerHTML) + "&nutente=" + encodeURIComponent(mod_row.cells[7].innerHTML) + "&pwd=" + encodeURIComponent(mod_row.cells[8].innerHTML) + "&grado=" + encodeURIComponent(mod_row.cells[9].innerHTML) ;
            richiesta.send(str);

            mod_row.removeAttribute('id');
            clone.remove();
        }
    }

    function annullaModifica(){
        var clone = document.getElementById("idclone");
        var mod_row = document.getElementById("idrow");
        for(let i=0 ; i<=10 ; i++) {
            mod_row.cells[i].innerHTML = clone.cells[i].innerHTML;
        }
        clone.remove();
        mod_row.removeAttribute('id');
    }

    function controlloModifica(){
        var nome = document.getElementsByClassName("modify-form")[0].value;
        var cognome = document.getElementsByClassName("modify-form")[1].value;
        var datan = document.getElementsByClassName("modify-form")[2].value;
        var cittan = document.getElementsByClassName("modify-form")[3].value;
        var email = document.getElementsByClassName("modify-form")[4].value;
        var nutente = document.getElementsByClassName("modify-form")[5].value;
        var pwd = document.getElementsByClassName("modify-form")[6].value;
        var grado = document.getElementsByClassName("modify-form")[7].value;

        let datan_date = new Date(datan);
        let age_dt = new Date(Date.now() - datan_date.getTime());
        let age = (age_dt.getUTCFullYear() -1970);
        let parts = email.split('@');

        if((nome=="")||(cognome=="")||(cittan=="")||(datan=="")||(email=="")||(nutente=="")||(pwd == "")) return("Inserire tutti i campi richiesti e riprovare!");
        if(age<14) return("Ci dispiace, per registrarti devi avere almeno 14 anni!");
        if((email.includes(' '))||(parts.length != 2)||(parts[0].length == 0)||(parts[1].length == 0)) return("Indirizzo email non valido");
        if(nutente.length < 5) return("Il nome utente deve essere lungo almeno 5 caratteri!");
        if(nutente.length > 32) return("Il nome utente  deve essere lungo al massimo 32 caratteri!");
        if(nutente.includes(' ')) return("Il nome utente non può contenere spazi!");
        if(pwd.length < 8) return("La password deve essere lunga almeno 8 caratteri!");
        if(pwd.length > 128) return("La password deve essere lunga al massimo 128 caratteri!");
        if(!(/\d/.test(pwd))) return("La password deve contenere almeno un numero!");
        if(!(/[a-zA-Z]/g.test(pwd))) return("La password deve contenere almeno una lettera!");
        if(pwd.includes(' ')) return("La password non può contenere spazi!");
        var controller = check_credenziali(email,nutente)
        if(controller==1) return("Indirizzo E-mail già utilizzato in un altro account!");
        if(controller==2) return("Nome Utente già utilizzato in un altro account!");

        return 0;
    }

    function check_credenziali(email, nutente){
        var table=document.getElementById('lista');

        var flag = 0;

        for(var i=1; i<table.rows.length-1 && flag==0; i++){ 
            if(table.rows[i].cells[6].innerHTML == email) flag=1;
            if(table.rows[i].cells[7].innerHTML == nutente) flag=2;
        }

        return flag;
    }

    function aggiungiRiga(){        
        var table = document.getElementById('lista');

        var new_row = table.insertRow();

        new_row.insertCell(0).innerHTML = ''
        new_row.insertCell(1).innerHTML = '<input type="text" class="form-control modify-form">'
        new_row.insertCell(2).innerHTML = '<input type="text" class="form-control modify-form">'
        new_row.insertCell(3).innerHTML = '<input type="text" class="form-control modify-form">'
        new_row.insertCell(4).innerHTML = '<input type="date" class="form-control modify-form">'
        new_row.insertCell(5).innerHTML = '<input type="text" class="form-control modify-form">'
        new_row.insertCell(6).innerHTML = '<input type="email" class="form-control modify-form">'
        new_row.insertCell(7).innerHTML = '<input type="text" class="form-control modify-form">'
        new_row.insertCell(8).innerHTML = '<input type="text" class="form-control modify-form">'
        new_row.insertCell(9).innerHTML = '<input type="text" class="form-control modify-form">'
        new_row.insertCell(10).innerHTML ='<i onClick=confermaModifica() class="fa-solid fa-circle-check table-option"></i> \
                                      <i onClick=annullaModifica() class="fa-solid fa-circle-xmark table-option"></i>'        
    }
    
</script>