<?php

require './funzioni.php';
$conn = db_conn();
//se e solo se admin è loggato allora rimuovi categoria altrimeni non è loggato e invia a index
if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){
    $id = $_POST['id_rmw'];
    //setta a categoria altro ogni spesa con id id_rmw
    $sql = "UPDATE spesa SET categoria = '0' WHERE categoria = '$id'";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query = mysqli_query($conn, $sql);
    if($query){
        //se ha avuto successo allora elimina la categoria
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
}else{
    header("Location: index.php");
}
?>