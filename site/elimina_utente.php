<?php
    
    require "./test_buffi_json.php";
    $conn = db_conn();
    
    $dropThis = $_POST['dropThis'];
    
    
    $sql = "DELETE FROM spesa WHERE spesa.utente = '$dropThis'";
    if((mysqli_query($conn, $sql))){
        $sql = "DELETE FROM utente WHERE utente.username = '$dropThis'";
        if((mysqli_query($conn, $sql))){
            cheader("Location: view.php?msg=eliminato l'utente");
        }
    }else{
        header("Location: view.php?error=qualcosa è andato storto");
    }
        
?>