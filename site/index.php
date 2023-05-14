<?php
$pagina = "Home";

require './funzioni.php';
$conn = db_conn();
head($pagina);
navBar($pagina, "PER FAR CAPIRE IN CHE PAGINA SIAMO");



?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand logo-nav" href="./home.php">4Money</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mt-2">
                    <a class="link-navbar  aria-current="page" href="./home.php">HOME
                    </a>
                </li>
                <li class="nav-item mt-2 ms-3">
                    <a class=" link-active" href="./informazioni.php">INFORMAZIONI
                    </a>
                </li>
                </ul>
                <a class="btn me-3 btn-success zoom" href="./login.php" role="button">Accedi</a>
                <a class="btn btn-danger zoom" href="./register.php  " role="button">Registrati</a>
            </div>
            </div>
        </nav>