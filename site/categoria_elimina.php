<?php

require './funzioni.php';
$conn = db_conn();

$id = $_POST['id_rmw'];


// Performing insert query execution
$sql = "UPDATE spesa SET categoria = '0' WHERE categoria = '$id'";


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$query = mysqli_query($conn, $sql);

if($query){
    $sql="DELETE FROM categoria WHERE categoria.id = '$id'";
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query2 = mysqli_query($conn, $sql);
    if($query2){
        header("Location: categorie.php?msg=modificato la categoria");
    }else{
        header("Location: categorie.php?error=Qualcosa è andato storto :(");
    }
} else{
    header("Location: categorie.php?error=Qualcosa è andato storto :(");
}
?>