<?php 
    require './funzioni.php';
    $conn = db_conn();
    session_destroy();
    if(isset($_GET['ciaooo'])){
        $msg = $_GET['ciaooo'];     
        header("Location: login.php?msg=".$msg);
       
       
    }else{ 
        header('Location: index.php');
        
    }
    exit;
?>