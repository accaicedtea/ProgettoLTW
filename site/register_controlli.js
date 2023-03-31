function show_requirements_username() {
    document.getElementById("requirements_username").innerHTML = "L'username deve essere lungo al massimo 50 caratteri"
}

function remove_requirements_username() {
    document.getElementById("requirements_username").innerHTML = "";
}

function show_requirements_password() {
    document.getElementById("requirements_password").innerHTML = "La password deve contenere:<br>1 carattere maiscolo;<br>1 carattere minuscolo;<br>Almeno 12 caratteri;<br>1 numero;<br>1 caratterespeciale (!@#$%^&*)"
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
    var password_regex = RegExp("(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,20}")
    var password = document.formreg.password.value;
    if(document.formreg.username.value=="") {
        document.getElementById("requirements_username").innerHTML = "Errore! Inserisci username";
        return false;
    }
    if (password==""){
        document.getElementById("requirements_password").innerHTML = "Errore! Inserisci una password";
        return false;
    }
    if (!password.match(password_regex)) {
        document.getElementById("requirements_password").innerHTML = "Formato password non valido";
        return false;
    }
    if (document.formreg.password.value != document.formreg.passwordC.value) {
        document.getElementById("confirm_password").innerHTML = "Errore! Le password non coincidono";
        return false;
    }
    return true;
}
