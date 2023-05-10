<?php
$pagina = "Home";
require './funzioni.php';
$conn = db_conn();
head($pagina);
navBar($pagina);
?>

<div class="conteiner">
    <a href="./login.php">
        login
    </a>
    <a href="./register.php">
        registr
    </a>
</div>