function validaInput(id,pattern){
    console.log("sto controllando");
    var input = document.getElementById(id);
    var regex = new RegExp(pattern);
    if (!regex.test(input.value)) {
        input.classList.add("is-invalid");
        return false;
    }
    input.classList.remove("is-invalid");
    return true;
}

