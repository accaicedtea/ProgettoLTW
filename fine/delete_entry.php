<?php

require './funzioni.php';
$conn = db_conn();
if (isset($_SESSION['log']) && $_SESSION['log'] == 'on') {
    $utente = $_SESSION['username'];
    $id = $_POST['id_delete'];

    $sql = "select data FROM spesa WHERE id = '$id' AND utente = '$utente'";
    $sql_data = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($sql_data);
    $sql = "DELETE FROM spesa WHERE id = '$id' AND utente = '$utente'";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query = mysqli_query($conn, $sql);

    if($query){
        //allora è una transazione normali
        if($data['data']<=date("Y-m-d")){
            $msg="Transazione eliminata correttamente";
            echo "<script>window.location.href=' transazioni.php?msg=$msg'</script>";
        }else{
        //allora è una scadenza
            $msg="Scadenza eliminata correttamente";
            echo "<script>window.location.href=' scadenze.php?msg=$msg'</script>";
        }
    }else{
        //allora è una transazione normali
        if($data<=date("Y-m-d")){
            $msg="Qualcosa è andato storto";
            echo "<script>window.location.href=' transazioni.php?msg=$msg'</script>";
        }else{
        //allora è una scadenza
            $msg="Qualcosa è andato storto";
            echo "<script>window.location.href=' scadenze.php?msg=$msg'</script>";
        }
    }
}else{
    header("Location: index.php");
}
?>