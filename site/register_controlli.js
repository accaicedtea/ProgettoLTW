function show_requirements_username() {
    document.getElementById("requirements_username").innerHTML = "L'username deve essere lungo al massimo 50 caratteri"
}
function remove_requirements_username() {
    document.getElementById("requirements_username").innerHTML = "";
}
function error_requirements_username() {
    if(document.formreg.username.value=="") {
        document.getElementById("requirements_username").innerHTML = "Errore! Inserisci username";
        alert("username non dato");
        return false;
    }
    return true;
}
function show_requirements_password() {
    document.getElementById("requirements_password").innerHTML = "La password deve contenere:<br>1 carattere maiscolo;<br>1 carattere minuscolo;<br>Almeno 12 caratteri;<br>1 numero;<br>1 caratterespeciale"
}
function remove_requirements_password() {
    document.getElementById("requirements_password").innerHTML = "";
}
function error_requirements_password() {
    if(document.formreg.password.value=="") {
        document.getElementById("requirements_password").innerHTML = "Errore! Inserisci password";
        alert("password non data");
        return false;
    }
    return true;
}
function error_confirm_password() {
    if(document.formreg.password.value != document.formreg.passwordC.value) {
        document.getElementById("confirm_password").innerHTML = "Errore! Le password non coincidono";
        alert("Password diverse");
        return false;
    }
    return true;
}

