<?php
// controlli su dati

    require "./funzioni.php";
    $conn = db_conn();
<<<<<<< HEAD

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
=======
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
>>>>>>> modifichebycri

    $sql = "INSERT INTO utente  VALUES ('$username', '$nome',
        '$cognome','$sesso','$nazionalita','$dataN', '$email' ,'$encrypted_pwd', './assets/img/avatars/icons8-anime-sama.svg')";

<<<<<<< HEAD
    if(mysqli_query($conn, $sql)){   
        header("Location: login.php?msg=Grazie per la registazione");
    } else{
        header("Location: register.php?error=Ups Qualcosa è andato storto");
=======


    
    if(mysqli_query($conn, $sql)){
        
        header("Location: login.php?msg=Grazie per la registazione");
    } else{
        header("Location: register.php?error=Credenziali errate");
>>>>>>> modifichebycri
    }
    $conn.close();
 
?>