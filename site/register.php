<?php 
    $pagina = 'Registrazione';
    include './head.php';
    include './navBar.php';
    include './db_conn.php';
    require './test_buffi_json.php';
?>
<body id="page-top">
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
                                            <p class="h6 text-primary m-0 fw-bold ">Crea la tua fantastiche utenze</p>
                                        </div>
                                        <div class="card-body">
                                            <!-- inizio form-->
                                            <form action="./register_user.php" method="post" name="formreg" onsubmit="return validaForm();">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong >Nome utente</strong></label><input class="form-control" type="text" id="username" placeholder="username" name="username" onfocus="show_requirements_username()" onblur="remove_requirements_username()" onchange="remove_error_username()"></div>
                                                            <!-- waring msg per username-->
                                                            <div class="mb-3"  id="requirements_username"></div>
                                                        <div class="errors mb-3" id="errors_username"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="nome"><strong >Nome</strong></label><input class="form-control" type="text" id="nome" placeholder="nome utente" name="nome" onchange="remove_error_name()"></div>
                                                        <!-- waring msg per nome-->
                                                        <div class="errors mb-3" id="errors_name"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="cognome"><strong >Cognome</strong></label><input class="form-control" type="text" id="cognome" placeholder="cognome utente" name="cognome" onchange="remove_error_cognome()"></div>
                                                        <!-- waring msg per cognome-->
                                                        <div class="errors mb-3" id="errors_cognome"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div name="radioSesso" class="mb-3"><label class="form-label" for="sesso"><strong >Sesso</strong></label>
                                                            <input type="radio" class="btn-check" name="sesso" id="option2" value="0" autocomplete="off" checked>
                                                            <label class="btn btn-outline-secondary btn-sm shadow-sm" for="option2">Donna</label>
                                                            <input type="radio" class="btn-check" name="sesso" id="option3" value="1" autocomplete="off">
                                                            <label class="btn btn-outline-secondary btn-sm shadow-sm" for="option3">Uomo</label></div>
                                                        </div>
                                                </div>
                                                
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="errors mb-3" id="errors_dataN"></div>
                                                        <div class="mb-3"><label class="form-label" for="dataN"><strong >Data di nascita</strong></label><input class="form-control" type="date" id="dataN" name="dataN" onfocus="show_requirements_dataN()" onblur="remove_requirements_dataN()" onchange="remove_error_dataN()"></div>
                                                        <!-- waring msg per data nascita-->
                                                        <div class="requirements" id="requirements_dataN"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="errors mb-3" id="errors_nazionalità"></div>
                                                        <div id="selectNazionalita" class="form-outline mb-3"><label class="form-label" for="dataN"><strong >Nazionalità</strong></label>
                                                        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                                                        <datalist id="selectNazi">
                                                            
                                                            
                                                        </datalist>
                                                        </div>
                                                        <!-- waring msg per nazionalità-->
                                                        <div class="requirements" id="requirements_dataN"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong >Inidirizzo email</strong></label><input class="form-control" type="email" id="email" placeholder="esempio@email.com" name="email" onchange="remove_error_email()"></div>
                                                        <!-- waring msg per indirizzo email-->
                                                        <div class="errors mb-3" id="errors_email"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="password"><strong >Password</strong></label><input class="form-control" type="password" id="password" placeholder="*****" name="password" onfocus="show_requirements_password()" onblur="remove_requirements_password()" onchange="remove_error_password()"></div>
                                                        <!-- waring msg per password-->
                                                        <div class="mb-3" id=requirements_password></div>
                                                        <div class="errors mb-3" id="errors_password"></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="passwordC"><strong >Conferma password</strong></label><input class="form-control" type="password" id="passwordC" placeholder="*****" name="passwordC" onchange="remove_error_passwordC()"></div>
                                                        <!-- waring msg per conferma password-->
                                                        <div class="errors mb-3" id="errors_confirm_password"></div>
                                                    </div>
                                                    <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Registrati</button></div>
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
                '<option value="' + birds[i]['id'] + '">' + birds[i]['nome'] + '</option>';
        }
    }
</script>
</html>