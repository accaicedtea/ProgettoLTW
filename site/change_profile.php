<?php 
    include 'db_conn.php';
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $dataN = $_POST['dataN'];
    $email = $_POST['email'];
    
   
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
        if(!empty($_POST['email']) && $_POST['eamail']!=$_SESSION['email']){
            $sql = "UPDATE utente SET email='$email' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['email']=$_POST['email'];
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