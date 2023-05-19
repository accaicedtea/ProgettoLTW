<?php 
    $pagina = 'Registrazione';
   
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    navBar($pagina,"Registrati");
?>

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
                                        <div class="card-header py-3">
                                            <p class="h6 text-primary m-0 fw-bold ">Crea il tuo account</p>
                                        </div>
                                        <div class="card-body">
                                            <!-- inizio form-->
                                            <form action="./register_user.php" id="register-form" method="post" name="formreg" class="needs-validation">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control " id="username" name="username" placeholder="username" onchange="validaInput('username','([0-9]*[A-Za-z ]*[0-9]*)*')" pattern="([0-9]*[A-Za-z ]*[0-9]*)*" required>
                                                            <label for="username">Username</label>
                                                        </div>
                                                    </div>
                                                    <div id = "test"></div>
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
                                                        <div class="mb-3"><label class="form-label" for="dataN"><strong >Data di nascita</strong></label><input class="form-control" type="date" id="dataN" name="dataN" required></div>
                                                        <!-- waring msg per data nascita-->
                                                        <p class= "form-text requirements">Devi avere più di 14 anni per registrati</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div id="selectNazionalita" class="form-outline mb-3"><label class="form-label" for="nazionalita"><strong >Nazionalità</strong></label>
                                                        <input class="form-control " name="nazionalita" list="selectNazi" id="nazionalita" placeholder="Nazionalità" onchange="validaNazionalita()" required>
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
                                                            <input type="number" class="form-control " id="saldo" name="saldo" placeholder="saldo" onchange = "validaInput('saldo', '[0-9]+')" required>
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
                                                        <p class= "form-text requirements">La password deve essere composta da almeno una lettera minuscola, una lettera minuscola, un numero, un carattere speciale tra !@#$%^& e una lunghezza compresa tra 6 e 20 caratteri</p>
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
                '<option value="' + birds[i] + '">' + birds[i] + '</option>';
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
function validaNazionalita() {
    if (document.formreg.nazionalita.classList.contains("is-invalid")) document.formreg.nazionalita.classList.remove("is-invalid");
    return true;
}

var form = document.getElementById("register-form");
var submitButton = document.getElementById("submit-button");

submitButton.addEventListener("click", function() {
  // Controlla la validità del form
    var password_regex = RegExp("(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$")
    var password = document.formreg.password.value;
    var today = new Date();
    var dataN = new Date(document.formreg.dataN.value);
    var passed = true;
    let nazioni = <?=getJsonStati($conn);?>;
    if(document.formreg.username.value=="") {
        document.getElementById("username").classList.add("is-invalid");
        passed = false;
    }
    if(document.formreg.nome.value=="") {
        document.getElementById("nome").classList.add("is-invalid");
        passed =  false;
    }
    if(document.formreg.cognome.value=="") {
        document.getElementById("cognome").classList.add("is-invalid");
        passed =  false;
    }
    if (document.formreg.dataN.value== "") {
        document.getElementById("dataN").classList.add("is-invalid");
        passed =  false;
    }
    if (today.getFullYear() - dataN.getFullYear() < 14) {
        document.getElementById("dataN").classList.add("is-invalid");
        passed =  false;
    }
    if (today.getFullYear() - dataN.getFullYear() == 14) {
        if(today.getMonth() < dataN.getMonth()) {
            document.getElementById("dataN").classList.add("is-invalid");
            passed =  false;
        }
        if(today.getMonth() == dataN.getMonth()) {
            if (today.getDate() < dataN.getDate()) {
                document.getElementById("dataN").classList.add("is-invalid");
                passed =  false;
            }
        }
    }
    if (document.formreg.nazionalita.value == "" || nazioni.indexOf(document.formreg.nazionalita.value) == -1) {
        document.getElementById("nazionalita").classList.add("is-invalid");
        passed =  false;
    }
    if (document.formreg.email.value == "") {
        document.getElementById("email").classList.add("is-invalid");
        passed =  false;
    }
    if (document.formreg.saldo.value == "" || isNaN(document.formreg.saldo.value)) {
        document.getElementById("saldo").classList.add("is-invalid");
        passed =  false;
    }
    if (password==""){
        document.getElementById("password").classList.add("is-invalid");
        passed =  false;
    }
    if (!password.match(password_regex)) {
        document.getElementById("password").classList.add("is-invalid");
        passed =  false;
    }
    if (document.formreg.password.value != document.formreg.passwordC.value || document.formreg.passwordC.value == "") {
        document.getElementById("passwordC").classList.add("is-invalid");
        passed =  false;
    }
    if (passed) form.submit();
    else return false;
});
</script>



</html>