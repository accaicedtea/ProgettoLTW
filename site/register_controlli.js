function show_requirements_username() {
    document.getElementById("requirements_username").innerHTML = "L'username deve essere lungo al massimo 50 caratteri"
}

function remove_requirements_username() {
    document.getElementById("requirements_username").innerHTML = "";
}

function show_requirements_password() {
    document.getElementById("requirements_password").innerHTML = "Requisiti password:<ul><li>Lunghezza compresa tra 6 e 20 caratteri</li><li>1 carattere maiuscolo</li><li>1 carattere minuscolo</li><li>1 numero</li><li>1 carattere speciale (!@#$%^&*)</li>"
}

function remove_requirements_password() {
    document.getElementById("requirements_password").innerHTML = "";
}

function show_requirements_dataN() {
    document.getElementById("requirements_dataN").innerHTML = "Devi avere più di 14 anni";
}

function remove_requirements_dataN() {
    document.getElementById("requirements_dataN").innerHTML = "";
}

function validaForm() {
    var password_regex = RegExp("(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&])(?=.*[a-zA-Z0-9]).{6,20}")
    var password = document.formreg.password.value;
    var today = new Date();
    var dataN = new Date(document.formreg.dataN.value);
    if(document.formreg.username.value=="") {
        document.getElementById("errors_username").innerHTML = "Errore! Inserisci username";
        return false;
    }
    if(document.formreg.nome.value=="") {
        document.getElementById("errors_name").innerHTML = "Errore! Inserisci un nome";
        return false;
    }
    if(document.formreg.cognome.value=="") {
        document.getElementById("errors_cognome").innerHTML = "Errore! Inserisci un cognome";
        return false;
    }
    if (document.formreg.dataN.value== "") {
        document.getElementById("errors_dataN").innerHTML = "Errore! Inserisci una data di nascita";
        return false;
    }
    if (today.getFullYear() - dataN.getFullYear() < 14) {
        document.getElementById("errors_dataN").innerHTML = "Errore! Data non valida";
        return false;
    }
    if (today.getFullYear() - dataN.getFullYear() == 14) {
        if(today.getMonth() < dataN.getMonth()) {
            document.getElementById("errors_dataN").innerHTML = "Errore! Data non valida";
            return false;
        }
        if(today.getMonth() == dataN.getMonth()) {
            if (today.getDate() < dataN.getDate()) {
                document.getElementById("errors_dataN").innerHTML = "Errore! Data non valida";
                return false;
            }
        }
    }
    if (document.formreg.email.value == "") {
        document.getElementById("errors_email").innerHTML = "Errore! Inserisci una email";
        return false;
    }
    if (password==""){
        document.getElementById("errors_password").innerHTML = "Errore! Inserisci una password";
        return false;
    }
    if (!password.match(password_regex)) {
        document.getElementById("errors_password").innerHTML = "Errore! Formato password non valido";
        return false;
    }
    if (document.formreg.password.value != document.formreg.passwordC.value) {
        document.getElementById("errors_confirm_password").innerHTML = "Errore! Le password non coincidono";
        return false;
    }
    return true;
}
function remove_error_username() {
    document.getElementById("errors_username").innerHTML = "";
}
function remove_error_name() {
    document.getElementById("errors_name").innerHTML = "";
}
function remove_error_cognome() {
    document.getElementById("errors_cognome").innerHTML = "";
}
function remove_error_dataN() {
    document.getElementById("errors_dataN").innerHTML = "";
}
function remove_error_email() {
    document.getElementById("errors_email").innerHTML = "";
}
function remove_error_password() {
    document.getElementById("errors_password").innerHTML = "";
}
function remove_error_passwordC() {
    document.getElementById("errors_confirm_password").innerHTML = "";
}