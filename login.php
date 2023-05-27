<?php 
    $pagina = 'Login';
   
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    navBar($pagina,"Accedi");
?>


<body id="page-top" >
    <div id="wrapper" >
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <!-- lg -3 col-->
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col">
                                    <div class="card card-log-effect shadow border-secondary mt-5 mb-3">
                                    
                                      <div row class="text-center">
                                      <div id="alert-container"></div>
                                        <img class="mt-3 text-center img-bg" src="./assets/brand/4M-cropped.svg">
                                      </div>
                                        <div class="card-body">
                                          <!-- form -->
                                          <?php if(isset($_GET['error'])){ ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Cavolini! </strong><?php echo $_GET['error']; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                          <?php }else if(isset($_GET['msg'])){?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>WOW! </strong><?php echo $_GET['msg']; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            
                                            <?php }?> 

                                            <form action="./login_user.php" id="login-form" method="post" name="form-signin" class="form-signin">
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
                                                            <input type="password" class="form-control " id="password" name="password" placeholder="password" onchange="validaInput('password','(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$')" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" required>
                                                            <label for="passw">Password</label>
                                                        </div>
                                                    </div>

                                                    

                                                </div>
                                                    <div class="text-center mb-3 "><button class="btn btn-lg btn-primary btn-block zoom btn-min" id="submit-button">Accedi</button></div>
                                                    </div>
                                                    <div class="mb-4 text-center">  <span class="h6 text-center">  Non hai un account? </span>
                                                      <a href="./register.php">Registrati</a>
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
        </div>
    </div>
</body>

</html>


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

var form = document.getElementById("login-form");
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
