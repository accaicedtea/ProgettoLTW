<?php

require './funzioni.php';
$conn = db_conn();
$pagina = $_POST['pagina'];
$utente = $_SESSION['username'];
$id = $_POST['id_delete'];

$sql = "DELETE FROM spesa WHERE id = '$id' AND utente = '$utente'";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$query = mysqli_query($conn, $sql);

if($query){
    //allora è una buffo o buffetto
    if($data==NULL){
        $msg="Il buffo o buffetto è stato inserito correttamente";

        echo "<script>window.location.href=' buffi.php?msg=$msg'</script>";
    }else 
    //allora è una transazione normali
    if($data<=date("Y-m-d")){
        $msg="Transazione inserita correttamente";
        echo "<script>window.location.href=' transazioni.php?msg=$msg'</script>";
    }else{
    //allora è una scadenza
        $msg="Scadenza inserita correttamente puoi visualizzarla nella sezione scadenze";
        echo "<script>window.location.href=' scadenze.php?msg=$msg'</script>";
    }
    }else{
        if($data==NULL){
            $msg="Qualcosa è andato storto";
            echo "<script>window.location.href=' buffi.php?msg=$msg'</script>";
        }else 
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

?>