<?php
require "./funzioni.php";
$conn = db_conn();

// se l'utente è loggato
if (isset($_SESSION['log']) && $_SESSION['log'] == 'on') {
    $utente = $_SESSION['username'];
    $descrizione =  $_POST['description_new'];
    $data =  $_POST['date_new'];

    if(isset($_POST['amount_new']) ){

    if ($_POST['tipo_new'] == 'entrata') $importo =  $_POST['amount_new'];
    else $importo = -1 * $_POST['amount_new'];

    //prende il massimo valore di una spesa di un certo utente
    $sql = "SELECT MAX(s.id) as id
    FROM spesa s JOIN utente u ON s.utente='$utente';";

    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        $id=$row['id'];
        $id+=1; // assegna incrementalmente l'id della nuova spesa
        
    }else{
        $id= rand();
    }
    }else{
        echo "<script>window.location.href=' transazioni.php?msg=$msg'</script>";
    }
    $categoria = $_POST['cat_new']; 


    // query di inserimento della spesa
    $sql = "INSERT INTO spesa VALUES ('$id', '$utente', '$importo', '$data', '$descrizione', '$categoria')";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $query = mysqli_query($conn, $sql);


    if($query){
        //allora è una transazione normale
        if($data<=date("Y-m-d")){
            $msg="Transazione inserita correttamente";
            echo "<script>window.location.href=' transazioni.php?msg=$msg'</script>";
        }else{
        //allora è una scadenza   
            $msg="Scadenza inserita correttamente puoi visualizzarla nella sezione scadenze";
            echo "<script>window.location.href=' scadenze.php?msg=$msg'</script>";
        }
        
    } else{
        header("Location: transazioni.php?error=Qualcosa è andato storto :(");
    }
}else{
    header("Location: index.php");
}
?>