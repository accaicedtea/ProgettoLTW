<?php 
    $pagina = 'Registrazione';
   
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    navBar($pagina,"");
?>
<script src="./assets/js/register_controlli.js"></script>

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
                                    <div class="card shadow mb-3 mt-4 card-log-effect">
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
                                                    <div class="row">
                                                        <div class="form-check ps-2 mb-2 radio-inputs"> 
                                                            <label>
                                                            <label><strong>Sesso</strong></label>
                                                                <input checked=""class="radio-input pe-4" type="radio" id="radio1" name="sesso" value="1">
                                                                    <span class="radio-tile">
                                                                        <span class="radio-icon">
                                                                            <i id="sesso1" class="bi bi-gender-male"></i>
                                                                        </span>
                                                                        <span id="mio" class="radio-label">Uomo</span>
                                                                    </span>
                                                            </label>
                                                            <label>
                                                                <input  class="radio-input " id="radio2" type="radio" name="sesso" value="0" >
                                                                <span class="radio-tile mt-4">
                                                                    <span class="radio-icon">
                                                                        <i id="sesso2" class="bi bi-gender-female"></i>
                                                                    </span>
                                                                    <span id="altro" class="radio-label">Donna</span>
                                                                </span>
                                                            </label>
                                                        </div>  
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
                                                <div class="row">
                                                <div class="col">
                                                        <div class="form-floating mb-3">
                                                            <input type="password" class="form-control " id="passwordC" name="passwordC" placeholder="passwordC" onchange="validaInput('passwordC','(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$')" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" required>
                                                            <label for="passwC">Conferma password</label>
                                                        </div>
                                                        <div class="errors_confirm_password"></div>
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
            <!--goto top -->
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
        if (document.formreg.password.value != document.formreg.passwordC.value) {
            var str = "Le password non coincidono";
            const alertContainer = document.querySelector('#alert-container');

            const alert = document.createElement('div');
            alert.classList.add('alert', 'alert-danger', 'alert-dismissible', 'fade', 'show');
            alert.setAttribute('role', 'alert');

            alert.textContent = str;

            const closeButton = document.createElement('button');
            closeButton.classList.add('btn-close');
            closeButton.setAttribute('type', 'button');
            closeButton.setAttribute('data-bs-dismiss', 'alert');
            closeButton.setAttribute('aria-label', 'Chiudi');
            alert.appendChild(closeButton);

            alertContainer.appendChild(alert);
        }else{  
        form.submit();
        }
    }else{
        const alertContainer = document.querySelector('#alert-container');

        const alert = document.createElement('div');
        alert.classList.add('alert', 'alert-danger', 'alert-dismissible', 'fade', 'show');
        alert.setAttribute('role', 'alert');

        alert.textContent = str;

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