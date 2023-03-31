<?php 

$_SESSION['pagina'] = 'Login';
include './head.php';?>
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <!-- per farlo più piccolino se levi fluid -->
                <div class="container-fluid">
                    <div class="row mb-3">
                        <!-- lg -3 col-->
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mt-5 mb-3">
                                      <div row class="text-center">
                                        <img class="mt-3 text-center" src="./assets/brand/4M-cropped.svg" alt="" width="200" height="200">
                                      </div>
                                        <div class="row-md-3">
                                            <p class="h3 text-center mb-3 mt-3">Accedi</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="./login_user.php" method="post" name="form-signin" class="form-signin">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong >Inidirizzo email</strong></label><input class="form-control" type="email" id="email" placeholder="example@email.com" name="email"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-5"><label class="form-label" for="password"><strong >Password</strong></label><input class="form-control" type="password" id="passord" placeholder="************" name="password"></div>
                                                    </div>
                                                </div>
                                                    <div class="text-center mb-3"><button class="btn btn-lg btn-primary btn-block" type="submit">Accedi</button></div>
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
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
</body>

</html>