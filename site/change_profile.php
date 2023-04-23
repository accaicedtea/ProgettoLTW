<?php 
require './test_buffi_json.php';
$conn = db_conn();
if(isset($_SESSION['log']) && $_SESSION['log']=='on'){
    $username= validate($_POST['username']);
    $nome = validate($_POST['nome']);
    $cognome = validate($_POST['cognome']);
    $dataN = validate($_POST['dataN']);
    $email = validate($_POST['email']);
    $nazi = validate($_POST['nazi']);
    $sesso = validate($_POST['sesso']);
    $pasw= validate($_POST['password']);
    $paswC= validate($_POST['passwordC']);

    if($_SESSION['username']== $username && isset($_SESSION['password'])){
        $sus = $_SESSION['username'];
        $spw = $_SESSION['password'];
        if(!empty($nome) && $nome!=$_SESSION['nome']){
            $sql = "UPDATE utente SET nome='$nome' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['nome']= $nome;
            }else{
                goto Error;
            }
        }
        if(!empty($cognome) && $cognome!=$_SESSION['cognome']){
            $sql = "UPDATE utente SET cognome='$cognome' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['cognome']=$cognome;
            }else{
                goto Error;
            }
        }
        if(!empty($dataN) && $dataN!=$_SESSION['dataN']){
            $sql = "UPDATE utente SET dataNascista='$dataN' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['dataN']=$dataN;
            }else{
                goto Error;
            }
        }
        if(!empty($email) &&  $email!=$_SESSION['email']){
            $sql = "UPDATE utente SET email='$email' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['email']= $email;
            }else{
                goto Error;
            }
        }
        if(!empty($nazi) && $nazi!=$_SESSION['nazi']){
            $sql = "UPDATE utente SET nazionalita='$nazi' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['nazi']=$nazi;
            }else{
                goto Error;
            }
        }
        if(!empty( $sesso) &&  $sesso!=$_SESSION['sesso']){
            $sql = "UPDATE utente SET sesso='$sesso' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['sesso']= $sesso;
            }else{
                goto Error;
            }
        }
        if(!empty( $pasw) && !empty( $paswC) && md5( $pasw)!=$_SESSION['password'] &&  $pasw== $paswC){
            $password=md5( $pasw);
            $sql = "UPDATE utente SET password='$password' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['password']=$password;
                goto A;
            }else{
                goto Error;
            }
        }
        goto B;
    }    
}else if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){ 
    $uname = validate($_POST['username']);
    $nome = validate($_POST['nome']);
    $passw = validate($_POST['password']);
    $passwC = validate($_POST['passwordC']);

    if($_SESSION['username']== $uname && isset($_SESSION['password'])){
        $sus = $_SESSION['username'];
        $spw = $_SESSION['password'];
        if(!empty($nome) &&  $nome!=$_SESSION['nome']){
            $sql = "UPDATE admin SET nome='$nome' WHERE id='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['nome']=$_POST['nome'];      
            }else{
                goto Error;
            }
        }
   
        if(!empty($passw) && !empty($passwC) && md5($passw)!=$_SESSION['password'] && $passw==$passwC){
            $password=md5($passw);
            $sql = "UPDATE admin SET password='$password' WHERE id='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['password'] = $password;
                goto A;
                
            }else{
                goto Error;
            }
        }
        goto B;
    
    }   
    
}
A:
    header('Location: logout.php?ciaooo=Devi RIACCEDERE');
    $conn->close();
    exit();
B:
    header('Location: profile.php?msg=Profilo Aggiornato Correttamente');
    $conn->close();
    exit();

Error:
    header('Location: profile.php?error=UPSSSSSSS');
    $conn->close();
    exit();
?>