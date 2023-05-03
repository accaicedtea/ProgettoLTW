<?php 
require './funzioni.php';
$conn = db_conn();

if(isset($_SESSION['log']) && $_SESSION['log']=='on'){
    $nome = validate($_POST['nome']);
    $cognome = validate($_POST['cognome']);
    $dataN = validate($_POST['dataN']);
    $email = validate($_POST['email']);
    $nazi = validate($_POST['nazionalita']);
    $sesso = validate($_POST['sesso']);
    $pasw= validate($_POST['password']);
    $paswC= validate($_POST['passwordC']);
    $sus = $_SESSION['username'];
    $spw = $_SESSION['password'];
    $flag=0;
    echo empty($_POST['sesso']);

    if(!empty($nome) && $nome!= $_SESSION['nome']){
        $sql = "UPDATE utente SET nome='$nome' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['nome']= $nome;
                $flag+=1;
            }else goto Error;
    }
    
    if(!empty($cognome) && $cognome!=$_SESSION['cognome']){
        $sql = "UPDATE utente SET cognome='$cognome' WHERE username='$sus' AND password='$spw'";
        if((mysqli_query($conn, $sql))){
            $_SESSION['cognome'] = $cognome;
            $flag+=1;
        }else goto Error;
    }

    if(!empty($dataN) && $dataN!=$_SESSION['dataN']){
        $sql = "UPDATE utente SET dataNascista='$dataN' WHERE username='$sus' AND password='$spw'";
        if((mysqli_query($conn, $sql))){
            $_SESSION['dataN']=$dataN;
            $flag+=1;
        }else goto Error;
    }

    if(!empty($email) &&  $email!=$_SESSION['email']){
        $sql = "UPDATE utente SET email='$email' WHERE username='$sus' AND password='$spw'";
        if((mysqli_query($conn, $sql))){
            $_SESSION['email']= $email;
            $flag+=1;
        }else goto Error;
    }

    if(!empty($nazi) && $nazi!=$_SESSION['nazi']){
        $sql = "UPDATE utente SET nazionalita='$nazi' WHERE username='$sus' AND password='$spw'";
        if((mysqli_query($conn, $sql))){
            $_SESSION['nazi']=$nazi;
            $flag+=1;
        }else goto Error;
    }

    if(($sesso==0 || $sesso==1) &&  $sesso!=$_SESSION['sesso']){
        $sql = "UPDATE utente SET sesso='$sesso' WHERE username='$sus' AND password='$spw'";
        if((mysqli_query($conn, $sql))){
            $_SESSION['sesso']= $sesso;
            $flag+=1;
        }else{
            goto Error;
        }
    }
    if(!empty( $pasw) && !empty( $paswC) && md5( $pasw)!=$_SESSION['password'] &&  $pasw== $paswC){
        $password=md5( $pasw);
        $sql = "UPDATE utente SET password='$password' WHERE username='$sus' AND password='$spw'";
        if((mysqli_query($conn, $sql))){
            $_SESSION['password']=$password;
            $flag+=1;
            log_out($conn); 
            goto A;
        }else{
            goto Error;
        }
    }
if( $flag!=0) echo "<script>window.location.href=' profile.php?msg=Profilo aggiornato correttemente correttamente'</script>";
else echo "<script>window.location.href=' profile.php?msg=Nulla è stato cambiato gg'</script>";
A:
    
    echo "<script>window.location.href=' Login.php?msg=Password aggiornata correttamente DEVI RIACCEDERE'</script>"; 
Error:
    echo "<script>window.location.href=' profile.php?error=Qualcosa è andato storto'</script>";

}
?>

