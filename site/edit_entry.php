<?php

include './db_conn.php';
$utente = $_SESSION['username'];
$id = $_POST['id_edit'];
$descrizione =  $_POST['description_edit'];
$data =  $_POST['date_edit'];
if ($_POST['tipo_edit'] == 'entrata')
    $importo =  $_POST['amount_edit'];
else $importo = -1 * $_POST['amount_edit'];
$categoria = $_POST['cat_edit'];

// Performing insert query execution
$sql = "UPDATE spesa SET importo = '$importo', descrizione = '$descrizione', data = '$data', categoria = '$categoria' WHERE utente = '$utente' AND id = '$id'";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$query = mysqli_query($conn, $sql);

if($query){
    
    header("Location: show.php?msg=Transazione modificata correttamente");
} else{
    header("Location: show.php?error=Qualcosa è andato storto :(");
}

?>