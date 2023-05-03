<?php
// controlli su dati

require "./funzioni.php";
 $conn = db_conn();
    $username = $_REQUEST['username'];
    $nome =  $_REQUEST['nome'];
    $cognome = $_REQUEST['cognome'];
    $sesso =  $_POST['sesso'];

    $email = $_REQUEST['email'];
    $nazionalita = $_REQUEST['nazionalita'];
    $password = $_REQUEST['password'];
    //passw criptata
    $encrypted_pwd = md5($password);
    $dataN = $_REQUEST['dataN'];

    $sql = "INSERT INTO utente  VALUES ('$username', '$nome',
        '$cognome','$sesso','$nazionalita','$dataN', '$email' ,'$encrypted_pwd', './assets/img/avatars/icons8-anime-sama.svg')";



    
    if(mysqli_query($conn, $sql)){
        
        header("Location: login.php?msg=Grazie per la registazione");
    } else{
        header("Location: register.php?error=Credenziali errate");
    }
    $conn.close();
 
?>