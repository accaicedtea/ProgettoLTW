<?php
//TODO: da modificare per rendere id incrementale e aggiustare la query per aggiungere l'id categoria
require "./funzioni.php";
 $conn = db_conn();
    $utente = $_SESSION['username'];
    $descrizione =  $_POST['description_new'];
    $data =  $_POST['date_new'];
    if ($_POST['tipo'] == 'entrata')
        $importo =  $_POST['amount_new'];
    else $importo = -1 * $_POST['amount_new'];
    $id = rand(); // deve essere diverso dagli altri id
    $categoria = $_POST['cat_new'];

    // Performing insert query execution
    $sql = "INSERT INTO spesa VALUES ('$id', '$utente', '$importo', '$data', '$descrizione', '$categoria')";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query = mysqli_query($conn, $sql);

    if($query){
        
        header("Location: scadenze.php?msg=Scadenza inserita correttamente");
    } else{
        header("Location: scadenze.php?error=Qualcosa è andato storto :(");
    }

?>