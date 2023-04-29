<?php 
    
require './funzioni.php';
$conn = db_conn();
    $icon = $_POST['test'];
    if( !empty($_SESSION['username']) && !empty($_SESSION['password'])){
        $sus = $_SESSION['username'];
        $spw = $_SESSION['password'];
        if(!empty($icon) && $_SESSION['pfp'] != $icon){
            $sql = "UPDATE utente SET pfp='$icon' WHERE username='$sus' AND password='$spw'";
            if((mysqli_query($conn, $sql))){
                $_SESSION['pfp']=$_POST['test'];
            }
        }
        header('Location: profile.php?msg=Profilo aggiornato correttamente');
    }
?>