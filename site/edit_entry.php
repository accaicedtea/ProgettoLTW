<?php

    require './funzioni.php';
    $conn = db_conn();
    
    $utente = $_SESSION['username'];
    $id = $_POST['id_edit'];
    $descrizione =  validate($_POST['description_edit']);
    $data =  $_POST['date_edit'];
    
    if ($_POST['tipo_edit'] == 'entrata')
        $importo =  validate($_POST['amount_edit']);
    else $importo = -1 * validate($_POST['amount_edit']);
    $categoria = validate($_POST['cat_edit']);

    $sql = "UPDATE spesa SET importo = '$importo', descrizione = '$descrizione', data = '$data', categoria = '$categoria' WHERE utente = '$utente' AND id = '$id'";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query = mysqli_query($conn, $sql);

    if($query){
        header("Location: transazioni.php?msg=Transazione modificata correttamente");
    }else{
        header("Location: transazioni.php?error=Qualcosa è andato storto :(");
    }

?>