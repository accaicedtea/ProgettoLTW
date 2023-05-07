<?php
//TODO: da modificare per rendere id incrementale e aggiustare la query per aggiungere l'id categoria
require "./funzioni.php";
 $conn = db_conn();
    $utente = $_SESSION['username'];
    $descrizione =  $_POST['description_new'];
    $data =  $_POST['date_new'];
    if ($_POST['tipo_new'] == 'entrata')
        $importo =  $_POST['amount_new'];
    else $importo = -1 * $_POST['amount_new'];
    $id = rand(); // deve essere diverso dagli altri id
    



    $categoria = $_POST['cat_new'];

    // Performing insert query execution
    if ($data == "") $sql = "INSERT INTO spesa VALUES ('$id', '$utente', '$importo', NULL, '$descrizione', '$categoria')";
    else $sql = "INSERT INTO spesa VALUES ('$id', '$utente', '$importo', '$data', '$descrizione', '$categoria')";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query = mysqli_query($conn, $sql);

    if($query){
        //allora è una transazione normali
        if($data<=date("Y-m-d")){
            $msg="Transazione inserita correttamente";
            echo "<script>window.location.href=' transazioni.php?msg=$msg'</script>";
        }else{
        //allora è una scadenza
            $msg="Scadenza inserita correttamente puoi visualizzarla nella sezione scadenze";
            echo "<script>window.location.href=' scadenze.php?msg=$msg'</script>";
        }


        //header("Location: transazioni.php?msg=$msg");
    } else{
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