<?php 
    $pagina = 'Profilo';
    require './funzioni.php';
    $conn = db_conn();
   
?>
<style>
.radio-inputs {
    display: flex;
    justify-content: left;
    align-items: left;
    max-width: 350px;
}

.radio-inputs > * {
    margin: 6px;
}

.radio-input:checked + .radio-tile {
    border-color: #2260ff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    color: #2260ff;
}

.radio-input:checked + .radio-tile:before {
    transform: scale(1);
    opacity: 1;
    background-color: #2260ff;
    border-color: #2260ff;
}

.radio-input:checked + .radio-tile .radio-icon svg {
    fill: #2260ff;
}

.radio-input:checked + .radio-tile .radio-label {
    color: #2260ff;
}

.radio-input:focus + .radio-tile {
    border-color: #2260ff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
}

.radio-input:focus + .radio-tile:before {
    transform: scale(1);
    opacity: 1;
}

.radio-tile {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 60px;
    min-height: 60px;
    border-radius: 0.9rem;
    border: 3px solid #b5bfd9;
    background-color: #fff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    transition: 0.15s ease;
    cursor: pointer;
    position: relative;
}

.radio-tile:before {
    content: "";
    position: absolute;
    display: block;
    width: 0.75rem;
    height: 0.75rem;
    border: 2px solid #b5bfd9;
    background-color: #fff;
    border-radius: 50%;
    top: 0.25rem;
    left: 0.25rem;
    opacity: 0;
    transform: scale(0);
    transition: 0.25s ease;
}

.radio-tile:hover {
    border-color: #2260ff;
}

.radio-tile:hover:before {
    transform: scale(1);
    opacity: 1;
}


.radio-label {
    color: #707070;
    transition: 0.375s ease;
    text-align: left;
    font-size: 13px;
}

.radio-input {
    clip: rect(0 0 0 0);
    -webkit-clip-path: inset(100%);
    clip-path: inset(100%);
    height: 1px;
    overflow: hidden;
    position: left;
    white-space: nowrap;
    width: 1px;
}
</style>
<?php if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
        head($pagina);
        navBar($pagina);
    ?>
<body id="page-top">
    <div class="container-fluid">
        <div class="row row-cols-1  row-cols-md-2">
            <div class="col mt-5">
                <div class="card text-center shadow mb-3">
                    <div class="card-header">
                    <?php if(isset($_GET['msg'])){ ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Congratulazioni! </strong><?php echo $_GET['msg']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php }?>
                                    <?php if(isset($_GET['error'])){ ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>UPS! </strong><?php echo $_GET['error']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php }?>
                        <p class="text-primary m-0 fw-bold " >Profilo di</p>
                        <p class="m-0 h5 fw-bold text-center" id="username"></p>
                    </div>
                    <div>
                        <img id="pfp" src="" class="rounded-circle mb-3 mt-4" width="100" height="100">
                    </div>
                    
                    <div class="card-body text-center">

                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
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
                                                            <img src="./assets/img/avatars/icons8-anime-sama.svg" alt="Option 1" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-futurama-bender.svg">
                                                            <img src="./assets/img/avatars/icons8-futurama-bender.svg" alt="Option 2" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-genshin-impact-xiao.svg">
                                                            <img src="./assets/img/avatars/icons8-genshin-impact-xiao.svg" alt="Option 3" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-hello-kitty.svg">
                                                            <img src="./assets/img/avatars/icons8-hello-kitty.svg" alt="Option 4" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-homer-simpson.svg" >
                                                            <img src="./assets/img/avatars/icons8-homer-simpson.svg" alt="Option 5" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-impero.svg">
                                                            <img src="./assets/img/avatars/icons8-impero.svg" alt="Option 6" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-iron-man.svg">
                                                            <img src="./assets/img/avatars/icons8-iron-man.svg" alt="Option 7" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-jake.svg">
                                                            <img src="./assets/img/avatars/icons8-jake.svg" alt="Option 8" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-kaedehara-kazuha.svg" >
                                                            <img src="./assets/img/avatars/icons8-kaedehara-kazuha.svg" alt="Option 9" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-koya-bt21.svg">
                                                            <img src="./assets/img/avatars/icons8-koya-bt21.svg" alt="Option 10" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-maschera-anonimo.svg">
                                                            <img src="./assets/img/avatars/icons8-maschera-anonimo.svg" alt="Option 11" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-mummia.svg">
                                                            <img src="./assets/img/avatars/icons8-mummia.svg" alt="Option 12" width="50" height="50">
                                                        </label>                                                        
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-walter-white.svg" >
                                                            <img src="./assets/img/avatars/icons8-walter-white.svg" alt="Option 13" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-super-mario.svg">
                                                            <img src="./assets/img/avatars/icons8-super-mario.svg" alt="Option 14" width="50" height="50" >
                                                        </label>
                                                        <label>
                                                            <input class="border border-5" type="radio" name="test" value="./assets/img/avatars/icons8-rebel.svg">
                                                            <img src="./assets/img/avatars/icons8-rebel.svg" alt="Option 15" width="50" height="50">
                                                        </label>
                                                        <label>
                                                            <input class="border border-primary" type="radio" name="test" value="./assets/img/avatars/icons8-pokemon.svg">
                                                            <img src="./assets/img/avatars/icons8-pokemon.svg" alt="Option 16" width="50" height="50">
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
                
            </div>


            <div class="col mt-5">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold text-start">Cambia informazioni utente <i class="bi bi-person-bounding-box"></i></p>
                    </div>
                    <div class="card-body">
                        <form action="./change_profile.php" method="post" name="form-change-profile" class="form-change-profile">
                            <div class="row">
                                <div class="col">
                                    
                                    <div class="form-floating mb-3">
                                        
                                        <input type="text" class="form-control" name="nome" id="nome" placeholder="nome">
                                        <label for="nome">Nome</label>
                                        
                                    </div>
                                    <div class="form-floating pb-1">
                                        <input type="text" class="form-control" name="cognome" id="cognome" placeholder="cognome">
                                        <label for="cognome">Cognome</label>
                                    </div> 
                                    <div class="form-check ps-2 mb-2 radio-inputs">
                                        
                                        <label>
                                        <label>Sesso</label>
                                            <input checked=""class="radio-input pe-4" type="radio" id="radio1" name="sesso" value="1">
                                                <span class="radio-tile">
                                                    <span class="radio-icon">
                                                        <i id="sesso1" class="bi bi-gender-male"></i>
                                                    </span>
                                                    <span id="mio" class="radio-label">Uomo</span>
                                                </span>
                                        </label>
                                        <label>
                                            <input  class="radio-input" id="radio2" type="radio" name="sesso" value="0" >
                                            <span class="radio-tile">
                                                <span class="radio-icon">
                                                    <i id="sesso2" class="bi bi-gender-female"></i>
                                                </span>
                                                <span id="altro" class="radio-label">Donna</span>
                                            </span>
                                        </label>
                                    </div>

                                    <div class="mb-3">    
                                        <label class="form-label">Nazionalità</label>
                                        
                                        <input class="form-control" list="selectNazi" name="nazionalita"  id="nazionalita" >
                                        
                                        <datalist id="selectNazi">
                                        
                                        </datalist>

                                    </div>    

                                    <div class="form-floating mb-3">  
                                        <input type="text" class="form-control" id="dataN" name="dataN">
                                        <label for="dataN">Data di nascita</label>    
                                    </div>

                                    

                                        
                                </div>
                            </div>
                        
                    </div>
                </div>
                

                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold text-start">Accesso utente <i class="bi bi-person-bounding-box"></i></p>
                    </div>
                    <div class="card-body">
                        
                            <div class="row">
                                <div class="col">
                                    
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="saldo" name="saldo">
                                        <label for="saldo">Saldo</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        
                                        <input type="text" class="form-control" id="email" name="email" placeholder="email@example.com">
                                        <label for="email">Email</label>
                                        
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="password" name="password" placeholder="password">
                                        <label for="cognome">Password</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="passwordC" name="passwordC" placeholder="passwordC">
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
    document.getElementById("saldo").value = data[0]["saldo"];
    if(data[0]['sesso']==0){
        
        
        document.getElementById("mio").innerHTML = "Donna";
        document.getElementById("altro").innerHTML = "Uomo";
        document.getElementById("sesso1").className = "bi bi-gender-female";
        document.getElementById("sesso2").className = "bi bi-gender-male";
    }else{
        
        document.getElementById("mio").innerHTML = "Uomo";
        document.getElementById("altro").innerHTML = "Donna";
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
            options += '<option value="' + stati[i]['nome_stati'] + '" />';
        }

        document.getElementById('selectNazi').innerHTML = options;

        
    }
</script>

<?php }else{
        header("Location: login.php?error=Credo tu debba accedere prima");
    }
?>