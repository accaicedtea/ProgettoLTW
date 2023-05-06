<?php 
    $pagina = 'Registrazione';
   
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    navBar($pagina);
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
<style>
.sfondo-animato {
    animation: cambia-colore 10s ease-in-out infinite;
}
.zoom {
    transition: transform .2s; /* Animation */
}
.zoom:hover {
    transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    filter: drop-shadow(5px 10px 2px rgba(0, 0, 0, 0.4));
}
@keyframes cambia-colore {
    0% {
        background-color: #2b7a78;
    }
    50% {
        background-color: #3aafa9;
    }
    100% {
        background-color: #2b7a78;
    }
}

.card-log-effect{
    animation: 0.3s skew-x-shakeng;
}

@keyframes skew-x-shakeng{
    50% { transform: scale(1.1); }
   
    100% { transform: scale(1); }
}
</style>


<body id="page-top" class="sfondo-animato">
<div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container">
                    <div class="row mb-3">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3 mt-4">
                                        <?php if(isset($_GET['error'])){ ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Cavolini! </strong><?php echo $_GET['error']; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                          <?php }?>
                                        <div class="row-md-3">
                                            <p class="h3 text-center mb-3 mt-3">Registrati</p>
                                        </div>
                                        <div class="card-header py-3">
                                            <p class="h6 text-primary m-0 fw-bold ">Crea la tua fantastica utenza</p>
                                        </div>
                                        <div class="card-body">
                                            <!-- inizio form-->
                                            <form action="./register_user.php" id="register-form" method="post" name="formreg" >
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control " id="username" name="username" placeholder="username" onchange="validaInput('username','([0-9]*[A-Za-z ]*[0-9]*)*')" pattern="([0-9]*[A-Za-z ]*[0-9]*)*" required>
                                                            <label for="username">Username</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control " id="nome" name="nome" placeholder="nome" onchange="validaInput('nome','[A-Za-z ]{1,32}')" pattern="[A-Za-z ]{1,32}" required>
                                                            <label for="nome">Nome</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control " id="cognome" name="cognome" placeholder="cognome" onchange="validaInput('cognome','[A-Za-z ]{1,32}')" pattern="[A-Za-z ]{1,32}" required>
                                                            <label for="cognome">Cognome</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
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
                                                </div>
                                                
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="errors mb-3" id="errors_dataN"></div>
                                                        <div class="mb-3"><label class="form-label" for="dataN"><strong >Data di nascita</strong></label><input class="form-control" type="date" id="dataN" name="dataN" onfocus="show_requirements_dataN()" onblur="remove_requirements_dataN()" onchange="remove_error_dataN()" required></div>
                                                        <!-- waring msg per data nascita-->
                                                        <div class="requirements" id="requirements_dataN"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="errors mb-3" id="errors_nazionalità"></div>
                                                        <div id="selectNazionalita" class="form-outline mb-3"><label class="form-label" for="dataN"><strong >Nazionalità</strong></label>
                                                        <input class="form-control" name="nazionalita" list="selectNazi" id="nazionalita" placeholder="Vedi do cazzo abiti" required>
                                                        <datalist id="selectNazi">
                                                        </datalist>
                                                        </div>
                                                        <!-- waring msg per nazionalità-->
                                                        <div class="requirements" id="requirements_dataN"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                      
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control " id="email" name="email" placeholder="email" onchange="validaInput('email','[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$')" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                                                            <label for="email">Indirizzo email</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                      
                                                        <div class="form-floating mb-3">
                                                            <input type="number" class="form-control " id="saldo" name="saldo" placeholder="saldo"   required>
                                                            <label for="email">Saldo iniziale</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-floating mb-3">
                                                            <input type="password" class="form-control " id="password" name="password" placeholder="password" onchange="validaInput('password','(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$')" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" required>
                                                            <label for="passw">Password</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                        <div class="form-floating mb-3">
                                                            <input type="password" class="form-control " id="passwordC" name="passwordC" placeholder="passwordC" onchange="validaInput('passwordC','(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$')" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" required>
                                                            <label for="passwC">Conferma password</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 text-center"><button id="submit-button" class="btn btn-primary zoom ">Registrati</button></div>
                                                    </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
</body>
<script>
    window.onload = populateSelectNazionalita();
    function populateSelectNazionalita() {
        // THE JSON ARRAY.
        let birds = <?=getJsonStati($conn);?>;
        
        let ele = document.getElementById('selectNazi');
        for (let i = 0; i < birds.length; i++) {
            // POPULATE SELECT ELEMENT WITH JSON.
            ele.innerHTML = ele.innerHTML +
                '<option value="' + birds[i]['nome_stati'] + '">' + birds[i]['nome_stati'] + '</option>';
        }
    }
</script>
<script>
    var showVal = document.getElementById("nationalita").value;
    var value2send = document.querySelector("#selectNazi option[value='"+shownVal+"']").dataset.value;
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

var form = document.getElementById("register-form");
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

        alert.textContent = 'Inserisci username e password';

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



</html>