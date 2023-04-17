<?php if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){ 
?>
<div id="topheader">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand " href="./home.php">4Money</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if($pagina=='Utenti') echo 'active'?>" href="./view.php">Utenti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ms-3" href="./informazioni.php">Informazioni
                    </a>
                </li>
                </ul>
                
                <a class=" h5 text-white me-3 mt-1" href="./profile.php" style="text-decoration: none"><?php echo $_SESSION['username'];?>
                </a>
                
                <a class="btn btn-sm btn-outline-danger" href="./logout.php" role="button">Logout</a>
            </div>
            </div>
        </nav>
    </div>


<?php }else if(isset($_SESSION['log']) && $_SESSION['log']=='on'){
?>
<div id="topheader">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand " href="./home.php">4Money</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if($pagina=='Dashboard') echo 'active'?>" aria-current="page" href="./dashboard.php">Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($pagina=='Visualizza transazioni') echo 'active'?>" aria-current="page" href="./transazioni.php">Transazioni
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">Scadenze</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">Statistiche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ms-3" href="./informazioni.php">Informazioni
                    </a>
                </li>
                </ul>
                
                <a class="h5 text-white me-3 mt-1 <?php if($pagina!='Profilo') echo 'fw-normal';?>" href="./profile.php" style="text-decoration: none"><?php echo $_SESSION['username'];?>
                </a>
                
                <a class="btn btn-sm btn-outline-danger" href="./logout.php" role="button">Logout</a>
            </div>
            </div>
        </nav>
    </div>



<?php }else if(!(isset($_SESSION['adminLog']))|| !(isset($_SESSION['log']))){ ?>
    <div id="topheader">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand " href="./home.php">4Money</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./home.php">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./informazioni.php">Informazioni
                    </a>
                </li>
                </ul>
                <a class="btn me-3 btn-success" href="./login.php" role="button">Accedi</a>
                <a class="btn btn-danger" href="./register.php  " role="button">Registrati</a>
            </div>
            </div>
        </nav>
    </div>



<?php }
    ?>