<?php
//TODO: da modificare per rendere id incrementale e aggiustare la query per aggiungere l'id categoria
require "./funzioni.php";
 $conn = db_conn();
    $utente = $_SESSION['username'];
    $descrizione =  $_POST['description_new'];
    $data =  $_POST['date_new'];

    if ($_POST['tipo_new'] == 'entrata') $importo =  $_POST['amount_new'];
    else $importo = -1 * $_POST['amount_new'];

    //prende il massimo valore di una spesa di un certo utente
    $sql = "SELECT MAX(s.id) as id
    FROM spesa s JOIN utente u ON s.utente='$utente';";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        $id=$row['id'];
        $id+=1;
        
    }else{
        $id= rand();
    }
    
    $categoria = $_POST['cat_new']; 

    
    // Performing insert query execution
    $sql = "INSERT INTO spesa VALUES ('$id', '$utente', '$importo', '$data', '$descrizione', '$categoria')";

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
        

        //header("Location: transazioni.php?msg=$msg");
    } else{
        header("Location: transazioni.php?error=Qualcosa è andato storto :(");
    }
?>