<?php 
$pagina = 'Registrazione';
  include './head.php';
  include './navBar.php';
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
                                    <div class="card shadow mb-3 mt-5">
                                        <div class="row-md-3">
                                            <p class="h3 text-center mb-3 mt-3">Registrati</p>
                                        </div>
                                        <div class="card-header py-3">
                                            <p class="h6 text-primary m-0 fw-bold ">Crea la tua fantastiche utenze</p>
                                        </div>
                                        <div class="card-body">
                                            <!-- inzio form che manda a register user-->
                                            <form action="./register_user.php" method="post" name="formreg">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong >Nome utente</strong></label><input class="form-control" type="text" id="username" placeholder="nome utente" name="username"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="nome"><strong >Nome</strong></label><input class="form-control" type="text" id="nome" placeholder="solo nome" name="nome"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="cognome"><strong >Cognome</strong></label><input class="form-control" type="text" id="cognome" placeholder="cognome" name="cognome"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div name="radioSesso" class="mb-3"><label class="form-label" for="sesso"><strong >Sesso</strong></label>
                                                            <input type="radio" class="btn-check" name="sesso" id="option2" value="0" autocomplete="off" checked>
                                                            <label class="btn btn-outline-secondary btn-sm shadow-sm ms-2" for="option2">Donna</label>
                                                            <input type="radio" class="btn-check" name="sesso" id="option3" value="1" autocomplete="off">
                                                            <label class="btn btn-outline-secondary btn-sm shadow-sm" for="option3">Uomo</label></div>
                                                        </div>
                                                </div>
                                                
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="dataN"><strong >Data di nascita</strong></label><input class="form-control" type="date" id="dataN" name="dataN"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong >Inidirizzo email</strong></label><input class="form-control" type="email" id="email" placeholder="example@email.com" name="email"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="password"><strong >Password</strong></label><input class="form-control" type="password" id="passord" placeholder="*****" name="password"></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="passwordC"><strong >Conferma password</strong></label><input class="form-control" type="password" id="password" placeholder="*****" name="passwordC"></div>
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

</html>