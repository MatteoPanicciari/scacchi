<?php
    header("Expires: Mon, 28 Jul 2003 21:00:00 GMT");
    $fun=$_POST['fun'];


    // Create connection
    $conn = mysqli_connect('localhost', 'root', '', 'scacchi');
    // Check connection
    if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

    switch($fun){
        case 1:
            $email=$_POST['email'];
            $nutente=$_POST['nutente'];
            
            //Cerco se c'è qualche utente che corrisponde alle credenziali
            $sql = 'SELECT *
                    FROM utenti
                    WHERE nutente="'.$nutente.'" OR email="'.$email.'"';
            $result = $conn->query($sql);
            
            //Controllo che sia stato trovato qualche utente con le credenziali inserite
            if ($result->num_rows > 0) echo "1";
            else echo "0";  //Se non è stato trovato nessuno
        break;

        case 2:
            $id=$_POST['id'];
        
            $sql = 'DELETE FROM utenti WHERE idUtente='.$id;
            $conn->query($sql);
        break;

        case 3:
            $sql = 'UPDATE utenti SET 
            nome = "'.$_POST['nome'].'", 
            cognome = "'.$_POST['cognome'].'", 
            datan = "'.$_POST['datan'].'", 
            cittan = "'.$_POST['cittan'].'", 
            email = "'.$_POST['email'].'", 
            nutente = "'.$_POST['nutente'].'", 
            pwd = "'.$_POST['pwd'].'", 
            grado = "'.$_POST['grado'].'"
            WHERE idUtente = '.$_POST['id'];
            $conn->query($sql);
        break;
    }    
    $conn->close();
?>