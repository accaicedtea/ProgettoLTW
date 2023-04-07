<?php

    include './db_conn.php';
    $blockThis = $_POST['blockthis'];
    $sql = "SELECT password from utente WHERE username='$blockThis'";
    $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            $passw = $row['password'];
            $passw .= 'adminBlock';
            echo 'ok';
            $sql = "UPDATE utente SET password = '$passw' WHERE username = '$blockThis'";
            if((mysqli_query($conn, $sql))){
                echo 'ok1';
                header("Location: view.php?msg= bloccato l'utente ");
            }
        }
?>