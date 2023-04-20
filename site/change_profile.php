<?php 
    include 'db_conn.php';
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $dataN = $_POST['dataN'];
    $email = $_POST['email'];
    $nazi = $_POST['nazi'];
    $sesso = $_POST['sesso'];
    echo "".$nome. "cognome ". $cognome." data ".$dataN. "emal ".$email. "nazio->>>".$nazi. " sesso".$sesso. " ".$nome;
   
    if($_SESSION['username']==$_POST['username'] && isset($_SESSION['password'])){
        $sus = $_SESSION['username'];
        $spw = $_SESSION['password'];
        if(!empty($_POST['nome']) && $_POST['nome']!=$_SESSION['nome']){
            $sql = "UPDATE utente SET nome='$nome' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['nome']=$_POST['nome'];
            }
        }
        if(!empty($_POST['cognome']) && $_POST['cognome']!=$_SESSION['cognome']){
            $sql = "UPDATE utente SET cognome='$cognome' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['cognome']=$_POST['cognome'];
            }
        }
        if(!empty($_POST['dataN']) && $_POST['dataN']!=$_SESSION['dataN']){
            $sql = "UPDATE utente SET dataNascista='$dataN' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['dataN']=$_POST['dataN'];
            }
        }
        if(!empty($_POST['email']) && $_POST['email']!=$_SESSION['email']){
            $sql = "UPDATE utente SET email='$email' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['email']=$_POST['email'];
            }
        }
        if(!empty($_POST['nazi']) && $_POST['nazi']!=$_SESSION['nazi']){
            $sql = "UPDATE utente SET nazionalita='$nazi' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['nazi']=$_POST['nazi'];
            }
        }
        if(!empty($_POST['sesso']) && $_POST['sesso']!=$_SESSION['sesso']){
            $sql = "UPDATE utente SET sesso='$sesso' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['sesso']=$_POST['sesso'];
            }
        }
        if(!empty($_POST['password']) && !empty($_POST['passwordC']) && md5($_POST['password'])!=$_SESSION['password'] && $_POST['password']==$_POST['passwordC']){
            $password=md5($_POST['password']);
            $sql = "UPDATE utente SET password='$password' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['password']=$password;
            }   
        }
        header('Location: profile.php?msg=Profilo aggiornato correttamente');
        $conn->close();
    }
    
?>