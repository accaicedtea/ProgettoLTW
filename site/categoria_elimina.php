<?php

require './funzioni.php';
$conn = db_conn();
if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){
    $id = $_POST['id_rmw'];

    $sql = "UPDATE spesa SET categoria = '0' WHERE categoria = '$id'";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query = mysqli_query($conn, $sql);

    if($query){
        $sql="DELETE FROM categoria WHERE categoria.id = '$id'";
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $query2 = mysqli_query($conn, $sql);
        if($query2){
            header("Location: categorie.php?msg=cancellato la categoria");
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