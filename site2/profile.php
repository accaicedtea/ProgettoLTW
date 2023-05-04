<?php 
    $pagina = 'Profilo';
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    navBar($pagina);
?>

<body id="page-top">
    <?php 
        
        if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
            
            
    ?>  
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card mb-3 mt-4">
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
                                        <div class="row-md-3">
                                            <p class="h3 text-center mb-3 mt-3">Profilo</p>
                                        </div>
                                        <!-- qui sicuramente andrà fatto in php tutto quanto-->
                                <div class="card-body text-center shadow"><img id="pfp" class="rounded-circle mb-3 mt-4" width="160" height="160">
                                    <div class="mb-3">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                    Cambia icona profilo
                                            </button>
                                            <!-- Modal -->
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
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                                    <button class="btn btn-primary btn-sm" type="submit">Salva cambiamenti</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                
                                
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Cambia informazioni utente</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="./change_profile.php" method="post" name="form-change-profile" class="form-change-profile">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong>Username</strong></label><input class="form-control" type="text" id="username" value=<?php echo $_SESSION['username'];?> name="username" readonly></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="mb-3">
                                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Clicca per cambiare la password</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" onclick="reset_password()" aria-selected="false" on>naah non voglio più modificare </button>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content" id="pills-tabContent">
                                                        
                                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                                <div class="card-header py-6">
                                                                    <div class="mb-1"><label class="form-label" for="password"><strong >Password</strong></label><input class="form-control" type="password" id="passord" placeholder="*****" name="password"></div>
                                                                    <div class="mb-3"><label class="form-label" for="password"><strong >Conferma Password</strong></label><input class="form-control" type="password" id="passordC" placeholder="*****" name="passwordC"></div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Indirizzo email</strong></label><input class="form-control" type="email" id="email"  name="email"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Nome</strong></label><input class="form-control" type="text" id="nome" name="nome"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Cognome</strong></label><input class="form-control" type="text" id="cognome" name="cognome"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="nationality"><strong>Nazionalità</strong></label>
                                                        <select id="selectNaz" name="nazi"class="d-inline-block form-select form-select-sm">
                                                            <option id="naz"></option>
                                                        </select></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-auto mb-3">
                                                        <label class="form-label" for="nationality"><strong>Sesso</strong></label>
                                                        </div>
                                                        
                                                        <div class="col-auto form-check">
                                                            <input type="radio" class="btn-check" id="radio1" name="optradio" value="1" checked>
                                                            <label id="mio" class="btn btn-outline-secondary btn-sm shadow-sm" for="radio1">Uomo</label>
                                                        </div>
                                                        <div class="col-auto form-check">
                                                            <input type="radio" class="btn-check" id="radio2" name="optradio" value="0">
                                                            <label id="altro"class="btn btn-outline-secondary btn-sm shadow-sm" for="radio2">Donna</label>
                                                        </div>
                                                    
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-5"><label class="form-label" for="birth"><strong>Data di nascita</strong></label><input class="form-control" type="date" id="dataN" name="dataN"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 cnt-b"><button class="btn btn-primary btn-sm" type="submit">Salva cambiamenti</button></div>
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

    <script>
        window.onload=placeH();
        function placeH() {
            let data = <?= getJsonUtente($conn);?>
            
            document.getElementById("username").placeholder = data[0]['username'];
            document.getElementById("email").placeholder = data[0]['email'];
            document.getElementById("nome").placeholder = data[0]['nome'];
            document.getElementById("cognome").placeholder = data[0]['cognome'];
            document.getElementById("dataN").value = data[0]['dataN'];

            document.getElementById("pfp").src = data[0]['pfp'];
            document.getElementById("naz").value = data[0]['nazionalita'];
            document.getElementById("naz").text = data[0]['nome_stati'];
            if(data[0]['sesso']==0){
                
                
                document.getElementById("mio").innerHTML = "Donna";
                document.getElementById("altro").innerHTML = "Uomo";
                document.getElementById("radio1").value = 0;
                document.getElementById("radio2").value = 1;
            }else{
                
                document.getElementById("mio").innerHTML = "Uomo";
                document.getElementById("altro").innerHTML = "Donna";
                document.getElementById("radio1").value = 1;
                document.getElementById("raido2").value = 0;
            }
            
        }
    </script>
    <?php }elseif($_SESSION['adminLog']=='daje'){ //TODO: profilo admin>
        ?> 
        <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card mb-3 mt-4">
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
                                        
                               
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Cambia informazioni utente</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="./change_profile.php" method="post" name="form-change-profile" class="form-change-profile">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong>Username</strong></label><input class="form-control" type="text" id="username" name="username" readonly> </div>
                                                    </div>
                                                </div>
                                                <div class="row">  
                                                    <div class="mb-3">
                                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Clicca per cambiare la password</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="reset_password()">naah non voglio più modificare </button>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content" id="pills-tabContent">
                                                        
                                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                                <div class="card-header py-6">
                                                                    <div class="mb-1"><label class="form-label" for="password"><strong >Password</strong></label><input class="form-control" type="password" id="passord" placeholder="*****" name="password"></div>
                                                                    <div class="mb-3"><label class="form-label" for="password"><strong >Conferma Password</strong></label><input class="form-control" type="password" id="passordC" placeholder="*****" name="passwordC"></div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-5"><label class="form-label" for="first_name"><strong>Nome</strong></label><input class="form-control" type="text" id="nome" name="nome"></div>
                                                    </div>
                                                </div>                                             
                                                <div class="mb-3 cnt-b"><button class="btn btn-primary btn-sm" type="submit">Salva cambiamenti</button></div>
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

    <script>
        window.onload=placeH();
        function placeH() {
            let data = <?= getJsonAdmin($conn);?>
            
            document.getElementById("username").value = data[0]['id'];
           
            document.getElementById("nome").placeholder = data[0]['nome'];
        }
    </script>
       
<?php
    }else{
        header("Location: login.php?error=Credo tu debba accedere prima");
    }

    
    ?>


</body>

</html>