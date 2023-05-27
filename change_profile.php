<?php
require './funzioni.php';
$conn = db_conn();
//se il pattern non è quello allora ritorna a profile con un errore
function p($data, $patt) {
    if (!preg_match($patt, $data)) {
        echo "<script>window.location.href=' profile.php?error=Qualcosa è andato storto controlla le credenziali'</script>";
        return null;
    }
    return $data;
}
//se e solo se utete è loggato
if (isset($_SESSION['log']) && $_SESSION['log'] == 'on') {

    $sus = $_SESSION['username'];
    $spw = $_SESSION['password'];
    //controlla se il valrore del bottone è primo
    if($_POST['butn']=="primo"){
        $flag = 0; // se è 0 allora non ha cambiato niente
        
        $nome = validate($_POST['nome']);
        $cognome = validate($_POST['cognome']);
        $dataN = validate($_POST['dataN']);
        $nazi = validate($_POST['nazionalita']);
        $sesso = validate($_POST['sesso']);


        if (!empty($nome) && $nome != $_SESSION['nome']) {
            $nome = p($nome, "/[A-Za-z ]{1,32}/");
            $sql = "UPDATE utente SET nome='$nome' WHERE username='$sus' AND password='$spw'";
            if ((mysqli_query($conn, $sql))) {
                $_SESSION['nome'] = $nome;
                $flag+= 1;
            } else goto Error;
        }
        if (!empty($cognome) && $cognome != $_SESSION['cognome']) {
            $cognome = p($cognome, "/[A-Za-z ]{1,32}/");
            $sql = "UPDATE utente SET cognome='$cognome' WHERE username='$sus' AND password='$spw'";
            if ((mysqli_query($conn, $sql))) {
                $_SESSION['cognome'] = $cognome;
                $flag+= 1;
            } else goto Error;
        }
        if (!empty($dataN) && $dataN != $_SESSION['dataN']) {
            $sql = "UPDATE utente SET dataN='$dataN' WHERE username='$sus' AND password='$spw'";
            if ((mysqli_query($conn, $sql))) {
                $_SESSION['dataN'] = $dataN;
                $flag+= 1;
            } else goto Error;
        }
        if (!empty($nazi) && $nazi != $_SESSION['nazi']) {
            $sql = "UPDATE utente SET nazionalita='$nazi' WHERE username='$sus' AND password='$spw'";
            if ((mysqli_query($conn, $sql))) {
                $_SESSION['nazi'] = $nazi;
                $flag+= 1;
            } else goto Error;
        }
        if (($sesso == 0 || $sesso == 1) && $sesso != $_SESSION['sesso']) {
            $sql = "UPDATE utente SET sesso='$sesso' WHERE username='$sus' AND password='$spw'";
            if ((mysqli_query($conn, $sql))) {
                $_SESSION['sesso'] = $sesso;
                $flag+= 1;
            } else {
                goto Error;
            }
        }

    }else{

       
        $flag = 0;

        $email = validate($_POST['email']);
        $pasw = validate($_POST['password']);
        $paswC = validate($_POST['passwordC']);
        $saldo = validate($_POST['saldo']);

        if (!empty($saldo) && $saldo != $_SESSION['saldo']) {
            $saldo = p($saldo, "/[0-9]{1,32}/");
            $sql = "UPDATE utente SET saldo_ini='$saldo' WHERE username='$sus' AND password='$spw'";
            if ((mysqli_query($conn, $sql))) {
                $_SESSION['saldo'] = $saldo;
                $flag+= 1;
            } else goto Error;
        }

        if (!empty($email) && $email != $_SESSION['email']) {
            $email = p($email, "/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/");
            $sql = "UPDATE utente SET email='$email' WHERE username='$sus' AND password='$spw'";
            if ((mysqli_query($conn, $sql))) {
                $_SESSION['email'] = $email;
                $flag+= 1;
            } else goto Error;
        }
        
        
        if (!empty($pasw) && !empty($paswC)  ) {
            if(md5($pasw) != $_SESSION['password'] && $pasw == $paswC){
            $pasw = p($pasw, "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/");
            $password = md5($pasw);
            $sql = "UPDATE utente SET password='$password' WHERE username='$sus' AND password='$spw'";
            if ((mysqli_query($conn, $sql))) {
                $_SESSION['password'] = $password;
                $flag+= 1;
                log_out($conn);
                goto A;
            } else {
                goto Error;
            }
            }
        }

    }
    //allora è stato cambiato qualcosa
    if ($flag != 0) echo "<script>window.location.href=' profile.php?msg=Profilo aggiornato correttemente correttamente'</script>";
    //se non cambia nulla
    else echo "<script>window.location.href=' profile.php?msg=Nulla è stato cambiato gg'</script>";
    // se cambia la password
    A:
       echo "<script>window.location.href=' Login.php?msg=Password aggiornata correttamente. Devi accedere di nuovo'</script>";
    Error:
       echo "<script>window.location.href=' profile.php?error=Qualcosa è andato storto'</script>";
} else 
    //se e solo se admin è loggato, altrimeni non è loggato e rinvia a index
    if (isset($_SESSION['adminLog']) && $_SESSION['adminLog'] == 'daje') {
   
    $nome = validate($_POST['nome']);
    $pasw = validate($_POST['password']);
    $paswC = validate($_POST['passwordC']);
    $sus = $_SESSION['username'];
    $spw = $_SESSION['password'];
    $flag = 0;
    if (!empty($nome) && $nome != $_SESSION['nome']) {
        echo "il nome non è vuoto e != dal nome di sessione";
        $nome = p($nome, "/[A-Za-z ]{1,32}/");
        $sql = "UPDATE admin SET nome='$nome' WHERE id='$sus' AND password='$spw'";
        if ((mysqli_query($conn, $sql))) {
            $_SESSION['nome'] = $nome;
            $flag+= 1;
        } else goto Error;
    }
    if (!empty($pasw) && !empty($paswC) && $pasw == $paswC && md5($pasw)!=$spw) {
        $pasw = p($pasw, "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/");
        $password = md5($pasw);
        $sql = "UPDATE admin SET password='$password' WHERE id='$sus' AND password='$spw'";
        if ((mysqli_query($conn, $sql))) {
            $_SESSION['password'] = $password;
            $flag+= 1;
            log_out($conn); 
            goto A;
        } else {
            goto Error;
        }
    }
    if ($flag != 0) echo "<script>window.location.href=' profile.php?msg=Profilo aggiornato correttemente correttamente'</script>";
    else echo "<script>window.location.href=' profile.php?msg=Nulla è stato cambiato gg'</script>";
} else {
    header("Location: index.php");
}
?>