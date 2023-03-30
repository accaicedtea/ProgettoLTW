<?php include '../head.html';?>
<style>

</style>
<body id="page-top" style="background-color:#e9e9e9;">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container">
                    <div class="row mb-3">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="row-lg-3">
                                            <p class="h3 text-center mb-3 mt-3 ombra-3" style="font-family: Audiowide, sans-serif; font-size: 30px;">Registrati</p>
                                        </div>
                                        <div class="card-header py-3">
                                            <p class="h6 text-primary m-0 fw-bold ombra">Crea la tua fantastiche utenze</p>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong class="ombra">Nome utente</strong></label><input class="form-control" type="text" id="username" placeholder="nome utente" name="username"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="nome"><strong class="ombra">Nome</strong></label><input class="form-control" type="text" id="nome" placeholder="solo nome" name="nome"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="cognome"><strong class="ombra">Cognome</strong></label><input class="form-control" type="text" id="cognome" placeholder="cognome" name="cognome"></div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="cognome"><strong class="ombra">Sesso</strong></label>
                                                            <input type="radio" class="btn-check" name="sesso" id="option2" autocomplete="off" checked>
                                                            <label class="btn btn-outline-secondary btn-sm shadow-sm" for="option2">Donna</label>
                                                            <input type="radio" class="btn-check" name="sesso" id="option3" autocomplete="off">
                                                            <label class="btn btn-outline-secondary btn-sm shadow-sm" for="option3">Uomo</label></div>
                                                        </div>
                                                </div>
                                                
                                                
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="dataN"><strong class="ombra">Data di nascita</strong></label><input class="form-control" type="date" id="dataN" name="dataB"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong class="ombra">Inidirizzo email</strong></label><input class="form-control" type="email" id="email" placeholder="example@email.com" name="email"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-5"><label class="form-label" for="password"><strong class="ombra">Password</strong></label><input class="form-control" type="password" id="passord" placeholder="*****" name="password"></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                        <div class="mb-5"><label class="form-label" for="passwordC"><strong class="ombra>Conferma password</strong></label><input class="form-control" type="password" id="password" placeholder="*****" name="passowrd"></div>
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