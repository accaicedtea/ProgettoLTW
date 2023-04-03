<?php 
    $pagina = 'Profilo';
    include './head.php';

?>
<body id="page-top">
    <?php 
        session_start();
        include_once './navBar.php';
        if(isset($_SESSION['log']) && $_SESSION['log']== 'on'){
    ?>  
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    
                    <div class="row mb-3">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                        <div class="row-md-3">
                                            <p class="h3 text-center mb-3 mt-3">Profilo</p>
                                        </div>
                                        <!-- qui sicuramente andrà fatto in php tutto quanto-->
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src=<?php echo $_SESSION['pfp'];?> width="160" height="160">
                                    <div class="mb-3"><button class="btn btn-primary btn-sm" type="button">Change</button></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Change user settings</p>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong>Username</strong></label><input class="form-control" type="text" id="username" value=<?php echo $_SESSION['username']?> name="username" readonly></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Clicca per cambiare la password</button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">naah non voglio più modificare </button>
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
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Email address</strong></label><input class="form-control" type="email" id="email" placeholder=<?php echo $_SESSION['email']?> name="email"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Name</strong></label><input class="form-control" type="text" id="first_name" placeholder=<?php echo $_SESSION['nome']?> name="first_name"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Surname</strong></label><input class="form-control" type="text" id="last_name" placeholder=<?php echo $_SESSION['cognome']?> name="last_name"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-5"><label class="form-label" for="birth"><strong>Birth date</strong></label><input class="form-control" type="date" id="birthdate" value=<?php echo $_SESSION['dataN']?> name="birthdate"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 cnt-b"><button class="btn btn-primary btn-sm" type="submit">Save changes</button></div>
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
    <?php }else{ header("Location: home.php");}?>


</body>

</html>