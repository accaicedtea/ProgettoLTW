<?php

    require './funzioni.php';
    $conn = db_conn();
    
    $utente = $_SESSION['username'];
    $id = $_POST['id_edit'];
    $descrizione =  validate($_POST['description_edit']);
    $data =  $_POST['date_edit'];
    
    if ($_POST['tipo_edit'] == 'entrata')
        $importo =  validate($_POST['amount_edit']);
    else $importo = -1 * validate($_POST['amount_edit']);
    $categoria = validate($_POST['cat_edit']);

    $sql = "UPDATE spesa SET importo = '$importo', descrizione = '$descrizione', data = '$data', categoria = '$categoria' WHERE utente = '$utente' AND id = '$id'";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query = mysqli_query($conn, $sql);

    if($query){
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