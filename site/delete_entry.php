<?php

include './db_conn.php';
$utente = $_SESSION['username'];
$id = $_POST['id_delete'];

$sql = "DELETE FROM spesa WHERE id = '$id' AND utente = '$utente'";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$query = mysqli_query($conn, $sql);

if($query){
    
    header("Location: transazioni.php?msg=Transazione eliminata correttamente");
} else{
    header("Location: transazioni.php?error=Qualcosa è andato storto :(");
}

?>