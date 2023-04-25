function show_requirements_username() {
    var d = document.getElementById("requirements_username");
    d.className += " alert alert-warning";
    document.getElementById("requirements_username").innerHTML = "L'username deve essere lungo al massimo 50 caratteri";
}

function remove_requirements_username() {
    var d = document.getElementById("requirements_username");
    d.className = "mb-3 ";
    document.getElementById("requirements_username").innerHTML = "";
}

function show_requirements_password() {
    var d = document.getElementById("requirements_password");
    d.className += " alert alert-warning";
    document.getElementById("requirements_password").innerHTML = "Requisiti password:<ul><li>Lunghezza compresa tra 6 e 20 caratteri</li><li>1 carattere maiuscolo</li><li>1 carattere minuscolo</li><li>1 numero</li><li>1 carattere speciale (!@#$%^&*)</li>"
}

function remove_requirements_password() {
    var d = document.getElementById("requirements_password");
    d.className = "mb-3 ";
    document.getElementById("requirements_password").innerHTML = "";
}

function show_requirements_dataN() {
    var d = document.getElementById("requirements_dataN");
    d.className += " alert alert-warning";
    document.getElementById("requirements_dataN").innerHTML = "Devi avere più di 14 anni";
}

function remove_requirements_dataN() {
    var d = document.getElementById("requirements_dataN");
    d.className = "mb-3 ";
    document.getElementById("requirements_dataN").innerHTML = "";
}

function validaForm() {
    var password_regex = RegExp("(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&])(?=.*[a-zA-Z0-9]).{6,20}")
    var password = document.formreg.password.value;
    var today = new Date();
    var dataN = new Date(document.formreg.dataN.value);

    if(document.formreg.username.value=="") {
        var d = document.getElementById("errors_username");
        d.className += " alert alert-danger";
        document.getElementById("errors_username").innerHTML = "Errore! Inserisci username";
        return false;
    }
    if(document.formreg.nome.value=="") {
        var d = document.getElementById("errors_name");
        d.className += " alert alert-danger";
        document.getElementById("errors_name").innerHTML = "Errore! Inserisci un nome";
        return false;
    }
    if(document.formreg.cognome.value=="") {
        var d = document.getElementById("errors_cognome");
        d.className += " alert alert-danger";
        document.getElementById("errors_cognome").innerHTML = "Errore! Inserisci un cognome";
        return false;
    }
    if (document.formreg.dataN.value== "") {
        var d = document.getElementById("errors_dataN");
        d.className += " alert alert-danger";
        document.getElementById("errors_dataN").innerHTML = "Errore! Inserisci una data di nascita";
        return false;
    }
    if (today.getFullYear() - dataN.getFullYear() < 14) {
        var d = document.getElementById("errors_dataN");
        d.className += " alert alert-danger";
        document.getElementById("errors_dataN").innerHTML = "Errore! Data non valida";
        return false;
    }
    if (today.getFullYear() - dataN.getFullYear() == 14) {
        var d = document.getElementById("errors_dataN");
        d.className += " alert alert-danger";
        if(today.getMonth() < dataN.getMonth()) {
            document.getElementById("errors_dataN").innerHTML = "Errore! Data non valida";
            return false;
        }
        if(today.getMonth() == dataN.getMonth()) {
            var d = document.getElementById("errors_dataN");
            d.className += " alert alert-danger";
            if (today.getDate() < dataN.getDate()) {
                document.getElementById("errors_dataN").innerHTML = "Errore! Data non valida";
                return false;
            }
        }
    }
    if (document.formreg.email.value == "") {
        var d = document.getElementById("errors_email");
        d.className += " alert alert-danger";
        document.getElementById("errors_email").innerHTML = "Errore! Inserisci una email";
        return false;
    }
    if (password==""){
        var d = document.getElementById("errors_password");
        d.className += " alert alert-danger";
        document.getElementById("errors_password").innerHTML = "Errore! Inserisci una password";
        return false;
    }
    if (!password.match(password_regex)) {
        var d = document.getElementById("errors_password");
        d.className += " alert alert-danger";
        document.getElementById("errors_password").innerHTML = "Errore! Formato password non valido";
        return false;
    }
    if (document.formreg.password.value != document.formreg.passwordC.value) {
        var d = document.getElementById("errors_confirm_password");
        d.className += " alert alert-danger";
        document.getElementById("errors_confirm_password").innerHTML = "Errore! Le password non coincidono";
        return false;
    }
    return true;
}
function remove_error_username() {
    var d = document.getElementById("errors_username");
    d.className = "mb-3 ";
    document.getElementById("errors_username").innerHTML = "";
}
function remove_error_name() {
    var d = document.getElementById("errors_name");
    d.className = "mb-3 ";
    document.getElementById("errors_name").innerHTML = "";
}
function remove_error_cognome() {
    var d = document.getElementById("errors_cognome");
    d.className = "mb-3 ";
    document.getElementById("errors_cognome").innerHTML = "";
}
function remove_error_dataN() {
    var d = document.getElementById("errors_dataN");
    d.className = "mb-3 ";
    document.getElementById("errors_dataN").innerHTML = "";
}
function remove_error_email() {
    var d = document.getElementById("errors_email");
    d.className = "mb-3 ";
    document.getElementById("errors_email").innerHTML = "";
}
function remove_error_password() {
    var d = document.getElementById("errors_password");
    d.className = "mb-3 ";
    document.getElementById("errors_password").innerHTML = "";
}
function remove_error_passwordC() {
    var d = document.getElementById("errors_confirm_password");
    d.className = "mb-3 ";
    document.getElementById("errors_confirm_password").innerHTML = "";
}

function reset_password(){
    document.querySelectorAll('input[type=password]');

    document.getElementById("passord").value = "";
    document.getElementById("passordC").value = "";
}