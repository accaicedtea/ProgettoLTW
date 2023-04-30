<?php
// controlli su dati

    require "./funzioni.php";
    $conn = db_conn();

    $username = validate($_POST['username']);
    $nome =  validate($_POST['nome']);
    $cognome = validate($_POST['cognome']);
    $sesso =  validate($_POST['sesso']);
    $nazionalita = validate($_POST['nazionalita']);

    $email = validate($_POST['email']);

    $password = validate($_POST['password']);
    //passw criptata
    $encrypted_pwd = md5($password);
    $dataN = $_POST['dataN'];

    $sql = "INSERT INTO utente  VALUES ('$username', '$nome',
        '$cognome','$sesso','$nazionalita','$dataN', '$email' ,'$encrypted_pwd', './assets/img/avatars/icons8-anime-sama.svg')";

    if(mysqli_query($conn, $sql)){   
        header("Location: login.php?msg=Grazie per la registazione");
    } else{
        header("Location: register.php?error=Ups Qualcosa è andato storto");
    }
    $conn.close();
 
?>