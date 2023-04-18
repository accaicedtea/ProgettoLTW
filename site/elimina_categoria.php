<?php
include './db_conn.php';
$id = $_POST['id_drop'];
        $sql = "DELETE FROM caterogia WHERE categoria.id = '$id'";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $query = mysqli_query($conn, $sql);

        if($query){
            
            header("Location: categorie.php?msg=eliminato la categoria");
        } else{
            header("Location: categorie.php?error=Qualcosa è andato storto :(");
        }

?>