<?php
require './funzioni.php';
$conn= db_conn();
//se e solo se admin è loggato allora aggiungi categoria altrimeni non è loggato e rinvia a login
if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){
    $id = $_POST['id_edit'];
    $nome =  $_POST['nome_edit'];
    $colore =  $_POST['colore_edit'];
    //modifica la categoria
    $sql = "UPDATE categoria SET nome = '$nome', colore = '$colore' WHERE id = '$id'";
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query = mysqli_query($conn, $sql);
    if($query){
        header("Location: categorie.php?msg=modificato la categoria");
    } else{
        header("Location: categorie.php?error=Qualcosa è andato storto :(");
    }
}else{
    header("Location: index.php");
}
?>