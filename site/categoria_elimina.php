<?php

require './funzioni.php';
$conn = db_conn();

$id = $_POST['id_edit'];
// Performing insert query execution

$sql = "UPDATE categoria SET nome = '$nome', colore = '$colore', img = '$img' WHERE id = '$id'";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$query = mysqli_query($conn, $sql);

if($query){
    
    header("Location: categorie.php?msg=modificato la categoria");
} else{
    header("Location: categorie.php?error=Qualcosa è andato storto :(");
}
?>