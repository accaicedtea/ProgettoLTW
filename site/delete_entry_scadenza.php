<?php

require './funzioni.php';
$conn = db_conn();
$utente = $_SESSION['username'];
$id = $_POST['id_delete'];

$sql = "DELETE FROM spesa WHERE id = '$id' AND utente = '$utente'";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$query = mysqli_query($conn, $sql);

if($query){
    
    header("Location: scadenze.php?msg=Scadenza eliminata correttamente");
} else{
    header("Location: scadenze.php?error=Qualcosa è andato storto :(");
}

?>