<?php include '../head.html';?> 

<body id="page-top" >
    
    <?php include './navLogin copy 2.html';?>  
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
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="./EEUy6MCU0AErfve.png" width="160" height="160">
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
                                                        <div class="mb-3"><label class="form-label" for="username"><strong>Username</strong></label><input class="form-control" type="text" id="username" placeholder="ricky_sniper_asr" name="username"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="password"><strong>Password</strong></label><input class="form-control" type="password" id="password" placeholder="********" name="password"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Email address</strong></label><input class="form-control" type="email" id="email" placeholder="user@example.com" name="email"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Name</strong></label><input class="form-control" type="text" id="first_name" placeholder="Ambrogio" name="first_name" readonly></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Surname</strong></label><input class="form-control" type="text" id="last_name" placeholder="Suddetto" name="last_name" readonly></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-5"><label class="form-label" for="birth"><strong>Birth date</strong></label><input class="form-control" type="text" id="birthdate" placeholder="16/01/2002" name="birthdate" readonly></div>
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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>