<?php
require './funzioni.php';
$conn= db_conn();
if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){
    $id = $_POST['id_edit'];
    $nome =  $_POST['nome_edit'];
    $img =  $_POST['img_edit'];
    $colore =  $_POST['colore_edit'];
    
    $sql = "UPDATE categoria SET nome = '$nome', colore = '$colore', img = '$img' WHERE id = '$id'";

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