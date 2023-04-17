<?php
    
    include './db_conn.php';
    $dropThis = $_POST['dropThis'];
    echo $dropThis;
    //$sql = "DELETE FROM utente WHERE utente.username = '$dropThis'";
    if((mysqli_query($conn, $sql))){
        
        header("Location: view.php?msg=eliminato l'utente");
    }else{
        //header("Location: view.php?error=qualcosa è andato storto");
    }
        
?>