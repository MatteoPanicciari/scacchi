let page = 0
let richiesta
let search_result

function start(){
    generalita()
    nascita()
    credenziali()
    password()
    manager()
}

function manager() {
    buttons()
    switch(page){
        case 0:         //Generalita
            document.getElementById("nascita").style.display = "none"
            document.getElementById("generalita").style.display = "block"
            document.getElementById("indietro").innerHTML = 
                '<button class="btn btn-warning" onclick="change_form(0)" \
                style="background-color:#f7aa03" form="form_signup" disabled>&#8592</button>'
            set_step()
            break
        case 1:         //Nascita
            document.getElementById("generalita").style.display = "none"
            document.getElementById("credenziali").style.display = "none"
            document.getElementById("nascita").style.display = "block"
            set_step()
            break
        case 2:         //Credenziali
            document.getElementById("nascita").style.display = "none"
            document.getElementById("password").style.display = "none"
            document.getElementById("credenziali").style.display = "block"
            set_step()
            break
        case 3:         //Password
            document.getElementById("credenziali").style.display = "none"
            document.getElementById("password").style.display = "block"
            set_step()
            break
        default:
            document.getElementById("form_signup").submit()
    }
}

function buttons(){
    document.getElementById("space_buttons").innerHTML = 
        '<div class="d-flex justify-content-between"> \
            <div id="indietro"> \
                <button class="btn btn-warning" onclick="change_form(-1)" style="background-color:#f7aa03" form="form_signup">&#8592</button> \
            </div> \
            <div style="text-align:center;margin-top:10px;margin:auto;"> \
                <span class="step"></span> \
                <span class="step"></span> \
                <span class="step"></span> \
                <span class="step"></span> \
            </div> \
            <button class="btn btn-warning" id="avanti" onclick="change_form(1)" style="background-color:#f7aa03" form="form_signup">&#8594</button> \
        </div> \
        <br> \
        <div class="d-flex justify-content-center"> \
            <button class="btn btn-warning mr-2" type="reset" style="background-color:#f7aa03" form="form_signup"> &zwnj; Reset &zwnj; </button> \
            <a href="index.php" class="btn btn-outline-warning">Home</a> \
        </div>'
}

//Si attiva al click delle frecce, controlla se l'utente voglia andare avanti o indietro
function change_form(action){
    if(action == 1) {
        let result = check_form()
        if(result == 0) page++
        else{
            document.getElementById('content').textContent = result;
            $("#myModal").modal("show");
        }
    }
    else  page--
    manager()
}

//Form per ogni 'pagina'
function generalita(){ document.getElementById('generalita').innerHTML = ' \
        <label for="nome">Nome:</label> \
        <input id="nome" type="text" class="form-control" placeholder="Inserisci Nome" name="nome"> \
        <br> \
        <label for="cognome">Cognome:</label> \
        <input id="cognome" type="text" class="form-control" placeholder="Inserisci Cognome" name="cognome"> '}
function nascita(){ document.getElementById('nascita').innerHTML = ' \
        <label for="cittan">Nato/a a</label> \
        <input id="cittan" type="text" class="form-control" placeholder="Inserisci Citta di Nascita" name="cittan"> \
        <br> \
        <label for="datan">Data di Nascita</label> \
        <input id="datan" type="date" class="form-control" name="datan"> '}  //placeholder="gg/mm/aaaa"
function credenziali(){ document.getElementById('credenziali').innerHTML = ' \
        <label for="email">E-mail</label> \
        <input id="email" type="email" class="form-control" placeholder="Inserisci Indirizzo E-mail" name="email"> \
        <br> \
        <label for="nutente">Nome Utente</label> \
        <input id="nutente" type="text" class="form-control" placeholder="Inserisci Nome Utente" name="nutente"> '}
function password(){ document.getElementById('password').innerHTML = ' \
        <label for="pwd">Password:</label> \
        <input id="pwd" type="password" class="form-control" placeholder="Inserisci Password" name="pwd"> \
        <span class="fa-solid fa-eye eye" id="pwd_eye"></span> \
        <br> \
        <label for="pwd2">Conferma Password:</label> \
        <input id="pwd2" type="password" class="form-control" placeholder="Ripeti Password" name="pwd2">'}

//Cambia lo stato degli step che mostrano l'avanzare della registrazione
function set_step(){
    document.getElementsByClassName("step")[page].className = 'step active'
    let i=0
    while(i<page){
        document.getElementsByClassName("step")[i].className = 'step finish'
        i++
    }
    let j=0
    while(j>page){
        document.getElementsByClassName("step")[j].className = 'step'
        j--
    }
}

function check_form(){
    switch(page) {
        case 0:         //Generalita
            let nome = document.getElementById('nome').value
            let cognome = document.getElementById('cognome').value
            if((nome == "") || (cognome == "")) return("Inserire entrambi i campi richiesti e riprovare!");
            break
        case 1:         //Nascita            
            let cittan = document.getElementById('cittan').value
            let datan = document.getElementById('datan').value
            if((cittan == "") || (datan == "")) return("Inserire entrambi i campi richiesti e riprovare!");
            let datan_date = new Date(datan);
            let age_dt = new Date(Date.now() - datan_date.getTime());
            let age = (age_dt.getUTCFullYear() -1970)
            if(age<14) return("Ci dispiace, per registrarti devi avere almeno 14 anni!");
            break
        case 2:         //Credenziali
            let email = document.getElementById('email').value
            let nutente = document.getElementById('nutente').value
            if((email == "") || (nutente == "")) return("Inserire entrambi i campi richiesti e riprovare!")
            let parts = email.split('@')
            if((email.includes(' ')) || (parts.length != 2) || (parts[0].length == 0) || (parts[1].length == 0)) return("Indirizzo email non valido")
            if(nutente.length < 5) return("Il nome utente deve essere lungo almeno 5 caratteri!")
            if(nutente.length > 32) return("Il nome utente  deve essere lungo al massimo 32 caratteri!")
            if(nutente.includes(' ')) return("Il nome utente non può contenere spazi!")
            credenziali_ajax(email,nutente)
            if(search_result==1) return("Nome Utente o E-Mail già utilizzati in un latro account!")
            break
        case 3:         //Password
            let pwd = document.getElementById('pwd').value
            let pwd2 = document.getElementById('pwd2').value
            if((pwd == "") || (pwd2 == "")) return("Inserire entrambi i campi richiesti e riprovare!")
            if(pwd.length < 8) return("La password deve essere lunga almeno 8 caratteri!")
            if(pwd.length > 128) return("La password deve essere lunga al massimo 128 caratteri!")
            if(!(/\d/.test(pwd))) return("La password deve contenere almeno un numero!")
            if(!(/[a-zA-Z]/g.test(pwd))) return("La password deve contenere almeno una lettera!")
            if(pwd.includes(' ')) return("La password non può contenere spazi!")
            if(pwd != pwd2) return("Le password non sono uguali!")
            break
    }
    return(0)
}

function credenziali_ajax(email,nutente){
    //creazione dell'oggetto per gestire la richiesta AJAX
    richiesta = new XMLHttpRequest()
    richiesta.onreadystatechange = function(){
        //se la richiesta ha successo aggiorno la pagina
        if((richiesta.readyState == 4) && (richiesta.status == 200)){
            search_result = richiesta.responseText
        }
    }
    //configurazione e invio della riciesta ajax
    richiesta.open("POST","php/ajax.php",false)
    richiesta.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var str = "fun=1&email=" + encodeURIComponent(email) +"&nutente=" + encodeURIComponent(nutente)
    richiesta.send(str)
}