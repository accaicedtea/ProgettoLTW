<?php

    include './db_conn.php';
    $dropThis = $_POST['dropThis'];
    $sql = "DELETE FROM utente WHERE username = '$dropThis'";
    if((mysqli_query($conn, $sql))){
                header("Location: view.php?msg=eliminato l'utente ");
    }
        
?>