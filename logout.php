<?php 
    require './funzioni.php';
    $conn = db_conn();
    //distrugge la connessione
    session_destroy();
    //TODO: controllare se in una pagina viene chiamata logout.php con un parametro ciaooo
    if(isset($_GET['ciaooo'])){
        $msg = $_GET['ciaooo'];     
        header("Location: login.php?msg=".$msg);
       
       
    }else{ 
        header('Location: index.php');
        
    }
    exit;
?>