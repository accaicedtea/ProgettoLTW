<?php 
    $pagina = 'Profilo';
    require './funzioni.php';
    $conn = db_conn();
   
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
   

<?php if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
        head($pagina);
        navBar($pagina,"Gestisci Profilo");
    ?>
<body id="page-top ">

    <div class="container-fluid sfondo-animato">
        <div class="row row-cols-1  row-cols-md-2 ">
            <div class="col mt-5 " id="div1">
                <div class="card text-center shadow border-secondary mb-3 leftToF">
                    <div class="card-header py-3">
                    <?php if(isset($_GET['msg'])){ ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Congratulazioni! </strong><?php echo $_GET['msg'];
                                             
                                        ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" ></button>
                                        </div>
                                        <script>
                                            setTimeout(function() {
                                            var alert = document.querySelector('.alert');
                                            var bsAlert = new bootstrap.Alert(alert);
                                            bsAlert.close();
                                            }, 1000);
                                        </script>
                                    <?php }?>
                                    <?php if(isset($_GET['error'])){ ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>UPS! </strong><?php echo $_GET['error']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <script>
                                            setTimeout(function() {
                                            var alert = document.querySelector('.alert');
                                            var bsAlert = new bootstrap.Alert(alert);
                                            bsAlert.close();
                                            }, 1000);
                                        </script>
                                    <?php }?>
                                   
                                        <p class="text-primary m-0 fw-bold text-start">Profilo <i class="bi bi-person-circle"></i></p>
                                    
                    </div>
                    <div>
                        <img id="pfp" src="" class="rounded-circle fade-in icon">
                    </div>
                    <p class="m-0 h5 fw-bold text-center text-primary" >Username dell'utente</p>
                    
                    <p class="m-0 h5 fw-bold text-center" id="username"></p>
                    <div class="card-body text-center">

                        <button type="button" class="btn btn-primary btn-sm fade-in mb mt-5" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                            Cambia icona profilo
                        </button>
                        
                        <!-- INIZIO MODAL MODIFICA ICONA PROFILO-->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="./change_icona.php" method="post" name="form-change-icon" class="form-change-icon">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-anime-sama.svg" checked >
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-anime-sama.svg" alt="Option 1" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-futurama-bender.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-futurama-bender.svg" alt="Option 2" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-genshin-impact-xiao.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-genshin-impact-xiao.svg" alt="Option 3" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-hello-kitty.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-hello-kitty.svg" alt="Option 4" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-homer-simpson.svg" >
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-homer-simpson.svg" alt="Option 5" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-impero.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-impero.svg" alt="Option 6" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-iron-man.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-iron-man.svg" alt="Option 7" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-jake.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-jake.svg" alt="Option 8" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-kaedehara-kazuha.svg" >
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-kaedehara-kazuha.svg" alt="Option 9" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-koya-bt21.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-koya-bt21.svg" alt="Option 10" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-maschera-anonimo.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-maschera-anonimo.svg" alt="Option 11" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-mummia.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-mummia.svg" alt="Option 12" width="50" height="50">
                                                        </label>                                                        
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-walter-white.svg" >
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-walter-white.svg" alt="Option 13" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-super-mario.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-super-mario.svg" alt="Option 14" width="50" height="50" >
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-rebel.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-rebel.svg" alt="Option 15" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-pokemon.svg">
                                                            <img class="fade-in" src="./assets/img/avatars/icons8-pokemon.svg" alt="Option 16" width="50" height="50">
                                                        </label>  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Chiudi</button>
                                                <button class="btn btn-primary btn-sm" type="submit">Salva cambiamenti</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <!-- FINE MODAL MODIFICA-->
                    </div>
                </div>

                <div class="card shadow mb-3 leftToF-3 border-secondary">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold text-start">Esporta <i class="bi bi-file-earmark-arrow-down"></i></p>
                    </div>
                    <div class="card-body">
                        
                            <div class="row">
                                <div class="col">
                                        <a id="exportJSON" onclick="exportJson(this);" class="btn btn-outline-dark btn-sm bottone-download"><i class="bi bi-download bi-sm"></i>Esporta tabella JSON</a>                                          
                                </div>
                                <div class="col">
                                        <a id="exportCSV" onclick="esportaCSV();" class="btn btn-outline-dark btn-sm bottone-download"><i class="bi bi-download bi-sm"></i>Esporta tabella CSV</a>
                                </div>
                                <div class="col">
                                    <a href="exportXML.php" class="btn btn-outline-dark btn-sm bottone-download"><i class="bi bi-download bi-sm"></i>Esporta tabella XML</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

<script>
    function exportJson(el) {
        var obj = <?= getJsonSpese($conn);?>;
        //formattato
        var data = "text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(obj, null, 4));
        
        el.setAttribute("href", "data:"+data);
        el.setAttribute("download", "tabellaJSON.json");    
    }
</script>
<script>
function esportaCSV() {
  // Seleziona la tabella
  const jsonData = <?= getJsonSpese($conn);?>;
;
  
  // Crea l'intestazione CSV
    // Converti il JSON in CSV utilizzando Papa Parse
    const csv = Papa.unparse(jsonData);
  
  // Crea un oggetto Blob dal contenuto CSV
  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8' });
  
  // Salva il file CSV utilizzando FileSaver.js
  saveAs(blob, 'tabellaCSV.csv');

}
</script>
            <div class="col mt-5 ">
                <div class="card shadow mb-3 topToF border-secondary">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold text-start">Informazioni personali <i class="bi bi-person-fill"></i></i></p>
                    </div>
                    <div class="card-body ">
                        <form action="./change_profile.php" method="post" name="form-change-profile" class="form-change-profile">
                            <div class="row">
                                <div class="col">
                                    
                                    <div class="form-floating mb-3">
                                        
                                        <input type="text" class="form-control " name="nome" id="nome" placeholder="nome" onchange="validaInput('nome','[A-Za-z ]{1,32}')" pattern="[A-Za-z ]{1,32}">
                                        <label for="nome">Nome</label>
                                        
                                    </div>
                                    <div class="form-floating pb-1">
                                        <input type="text" class="form-control " name="cognome" id="cognome" placeholder="cognome" onchange="validaInput('cognome','[A-Za-z ]{1,32}')" pattern="[A-Za-z ]{1,32}">
                                        <label for="cognome">Cognome</label>
                                    </div> 
                                    <div class="form-check ps-2 mb-2 radio-inputs">
                                        
                                        <label>
                                        <label><strong>Sesso</strong> </label>
                                            <input checked=""class="radio-input " type="radio" id="radio1" name="sesso" value="1">
                                                <span class="radio-tile">
                                                    <span class="radio-icon">
                                                        <i id="sesso1" class="bi bi-gender-male"></i>
                                                    </span>
                                                    <span id="mio" class="radio-label">Uomo</span>
                                                </span>
                                        </label>
                                        <label>
                                            <input  class="radio-input" id="radio2" type="radio" name="sesso" value="0" >
                                            <span class="radio-tile mt-4">
                                                <span class="radio-icon">
                                                    <i id="sesso2" class="bi bi-gender-female"></i>
                                                </span>
                                                <span id="altro" class="radio-label">Donna</span>
                                            </span>
                                        </label>
                                    </div>

                                    <div class="mb-3">    
                                        <label><strong>Nazionalità</strong> </label>
                                        <input class="form-control " list="selectNazi" name="nazionalita"  id="nazionalita" >
                                        
                                        <datalist id="selectNazi">
                                        
                                        </datalist>

                                    </div>    

                                    <div class="mb-3">  
                                        <label for="dataN pb-2"><strong>Data di nascita</strong> </label>
                                        <input type="date" class="form-control " id="dataN" name="dataN" >
                                            
                                    </div>

                                    <div>
                                        <button class="btn btn-primary btn-sm" type="submit">Salva cambiamenti</button>
                                    </div>  

                                        
                                </div>
                            </div>
                        
                    </div>
                </div>
                

                <div class="card shadow mb-3 topToF border-secondary">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold text-start">Dati di accesso <i class="bi bi-person-bounding-box"></i></p>
                    </div>
                    <div class="card-body">
                        
                            <div class="row">
                                <div class="col">
                                    
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control " id="saldo" name="saldo" onchange="validaInput('saldo','[0-9]{1,32}')" pattern="[0-9]]{1,32}">
                                        <label for="saldo">Saldo</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        
                                        <input type="text" class="form-control " id="email" name="email" placeholder="email@example.com" onchange="validaInput('email','[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$')" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                                        <label for="email">Email</label>
                                        
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control " id="password" name="password" placeholder="password" onchange="validaInput('password','[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$')" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$">
                                        <label for="cognome">Password</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control " id="passwordC" name="passwordC" placeholder="passwordC" onchange="validaInput('passwordC','[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$')" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$">
                                        <label for="cognome">Conferma password</label>
                                    </div> 
                                    
                                    <div>
                                        <button class="btn btn-primary btn-sm" type="submit">Salva cambiamenti</button>
                                    </div>       
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            





            
        <!-- fine row-->
        </div>
    </div>
</body>


<script>
window.onload= function(){
    placeH();
    populateSelectNazionalita();
}
function placeH() {
    let data = <?= getJsonUtente($conn);?>
    
    document.getElementById("pfp").src= data[0]['pfp'];
    document.getElementById("username").innerHTML = data[0]['username'];
    document.getElementById("email").value = data[0]['email'];
    document.getElementById("nome").value = data[0]['nome'];
    document.getElementById("cognome").value = data[0]['cognome'];
    document.getElementById("dataN").value = data[0]['dataN'];

    document.getElementById("nazionalita").placeholder = data[0]['nome_stati'];
    document.getElementById("saldo").value = data[0]["saldo_ini"];
    if(data[0]['sesso']==0){
        
        
        document.getElementById("mio").innerHTML = "Donna";
        document.getElementById("altro").innerHTML = "Uomo";
        document.getElementById("radio1").value= 0;
        document.getElementById("radio2").value= 1;
        

        document.getElementById("sesso1").className = "bi bi-gender-female";
        document.getElementById("sesso2").className = "bi bi-gender-male";
    }else{
        
        document.getElementById("mio").innerHTML = "Uomo";
        document.getElementById("altro").innerHTML = "Donna";
        document.getElementById("radio1").value= 1;
        document.getElementById("radio2").value= 0;
        
        document.getElementById("sesso1").className = "bi bi-gender-male";
        document.getElementById("sesso2").className = "bi bi-gender-female";
    }  
    
}    
</script>
<script>
    
    function populateSelectNazionalita() {
        // THE JSON ARRAY.
        var options = '';
        let stati = <?=getJsonStati($conn);?>;
        //console.log(stati);
        for (var i = 0; i < stati.length; i++) {
            options += '<option value="' + stati[i] + '" />';
        }

        document.getElementById('selectNazi').innerHTML = options;

        
    }
</script>

<script>
function validaInput(id,pattern){
    var input = document.getElementById(id);
    var regex = new RegExp(pattern);
    if (!regex.test(input.value)) {
        input.classList.add("is-invalid");
        return false;
    }
    input.classList.remove("is-invalid");
    return true;
}

var form = document.getElementById("my-form");
var submitButton = document.getElementById("submit-button");

submitButton.addEventListener("click", function() {
  // Controlla la validità del form
    if (form.checkValidity()) {
        form.submit();
    }else{
        const alertContainer = document.querySelector('#alert-container');

        const alert = document.createElement('div');
        alert.classList.add('alert', 'alert-danger', 'alert-dismissible', 'fade', 'show');
        alert.setAttribute('role', 'alert');

        alert.textContent = 'Le password devono essere uguali';

        const closeButton = document.createElement('button');
        closeButton.classList.add('btn-close');
        closeButton.setAttribute('type', 'button');
        closeButton.setAttribute('data-bs-dismiss', 'alert');
        closeButton.setAttribute('aria-label', 'Chiudi');
        alert.appendChild(closeButton);

        alertContainer.appendChild(alert);
    }
});
</script>
<?php }else if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){
            head($pagina);
            navBar($pagina,"PROFILO");
    ?>
<body id="page-top ">
    <div class="container-fluid sfondo-animato">
        <div class="row row-cols-1  row-cols-md-2 ">
            <div class="col mt-5 " >
                <div class="card text-center shadow mb-3 leftToF border-secondary">
                    <div class="card-header">
                    <?php if(isset($_GET['msg'])){ ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Congratulazioni! </strong><?php echo $_GET['msg']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
<script>
    setTimeout(function() {
        var alert = document.querySelector('.alert');
        var bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    }, 1000);
</script>
                                    <?php }?>
                                    <?php if(isset($_GET['error'])){ ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>UPS! </strong><?php echo $_GET['error']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
<script>
    setTimeout(function() {
        var alert = document.querySelector('.alert');
        var bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    }, 1000);
</script>
                                    <?php }?>
                        <p class="text-primary m-0 fw-bold h3" >Profilo</p>
                        <p class="m-0 h5 fw-bold text-center" id="username"></p>
                    </div>

                    <div class="card-body">
                        <img src="./assets/img/avatars/icons8-anime-sama.svg" class="rounded-circle fade-in" width="100" height="100">
                        <p class="h4 fw-bold text-center text-danger" >Profilo amministratore</p>
                    </div>
                 
                </div>
                
            </div>


            <div class="col mt-5">
                <div class="card shadow mb-3 topToF border-secondary">
                    <div class="card-header py-3">
                        <div id="alert-container"></div>
                        <p class="text-primary m-0 fw-bold text-start">Cambia informazioni utente <i class="bi bi-person-bounding-box"></i></p>
                    </div>
                    <div class="card-body ">
                        <form id="my-form" action="./change_profile.php" method="post" name="form-change-profile" class="form-change-profile">
                            <div class="row">
                                <div class="col">
                                    
                                    <div class="form-floating mb-3">
                                        
                                        <input type="text" class="form-control " name="nome" id="nome" placeholder="nome" onchange="validaInput('nome','[A-Za-z ]{1,32}')" pattern="[A-Za-z ]{1,32}">
                                        <label for="nome">Nome</label>
                                        
                                    </div>
                                   
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="password" onchange="validaInput('password','(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$')" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$">
                                        <label for="cognome">Password</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="passwordC" name="passwordC" placeholder="passwordC" >
                                        <label id="msgErrore"for="cognome">Conferma password</label>
                                    </div> 

                                    
                                    <div>
                                        <button id="submit-button" class="btn btn-primary btn-sm">Salva cambiamenti</button>
                                    </div>  
                                        
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        <!-- fine row-->
        </div>
    </div>
</body>
<script>
window.onload= function(){
    placeH();    
}
function placeH() {
    let data = <?= getJsonAdmin($conn);?>
    
    document.getElementById("nome").value = data[0]['nome'];
    
}    
function validaInput(id,pattern){
    var input = document.getElementById(id);
    var regex = new RegExp(pattern);
    if (!regex.test(input.value)) {
        input.classList.add("is-invalid");
        return false;
    }
    input.classList.remove("is-invalid");
    return true;
}

</script>
<script>
var form = document.getElementById("my-form");
var submitButton = document.getElementById("submit-button");

submitButton.addEventListener("click", function() {
  // Controlla la validità del form
    if (form.checkValidity()) {
        form.submit();
    }else{
        const alertContainer = document.querySelector('#alert-container');

        const alert = document.createElement('div');
        alert.classList.add('alert', 'alert-danger', 'alert-dismissible', 'fade', 'show');
        alert.setAttribute('role', 'alert');

        alert.textContent = 'Le password devono essere uguali';

        const closeButton = document.createElement('button');
        closeButton.classList.add('btn-close');
        closeButton.setAttribute('type', 'button');
        closeButton.setAttribute('data-bs-dismiss', 'alert');
        closeButton.setAttribute('aria-label', 'Chiudi');
        alert.appendChild(closeButton);

        alertContainer.appendChild(alert);
    }
});
</script>
  <?php
    }else{
        header("Location: login.php?error=Credo tu debba accedere prima");
    }
?>