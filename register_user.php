<?php
// controlli su dati

    require "./funzioni.php";
    $conn = db_conn();
function p($data,$patt){
    if(!preg_match($patt, $data)){
        echo "<script>window.location.href=' register.php?error=Qualcosa è andato storto controlla le credenziali'</script>";
        return null;
    } 
    return $data;
}   
    $username = validate($_POST['username']);
    
    $nome =  validate($_POST['nome']);
    $nome = p($nome,"/[A-Za-z ]{1,32}/");
    $cognome = validate($_POST['cognome']);
    $cognome= p($cognome,"/[A-Za-z ]{1,32}/");
    $sesso =  validate($_POST['sesso']);
    $sesso= p($sesso,"/0?1?/");
    $nazionalita = validate($_POST['nazionalita']);

    $email = validate($_POST['email']);
    $email = p($email,"/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/");
    $password = validate($_POST['password']);
    $password = p($password,"/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/");
        
    //passw criptata
    $encrypted_pwd = md5($password);
    $dataN = $_POST['dataN'];

    $saldo =$_POST['saldo'];
    $saldo= p($saldo,"/[0-9]{1,32}/");
    if($encrypted_pwd==md5($_POST['passwordC'])){
        $sql = "INSERT INTO utente  VALUES ('$username', '$nome', '$cognome','$sesso','$nazionalita','$dataN', '$email' ,'$encrypted_pwd', './assets/img/avatars/icons8-anime-sama.svg','$saldo')";

        if(mysqli_query($conn, $sql)){   
            header("Location: login.php?msg=Grazie per la registazione");
        } else{
            header("Location: register.php?error=Ups Qualcosa è andato storto");
        }
    }else{
        echo "<script>window.location.href=' register.php?error=Qualcosa è andato storto controlla le credenziali'</script>";
        
    }
?>