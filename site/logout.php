<?php 
    require './test_buffi_json.php';
    $conn = db_conn();
    session_destroy();
    if(isset($_GET['ciaooo'])){
        $msg = $_GET['ciaooo'];     
        header("Location: login.php?msg=".$msg);
       
       
    }else{ 
        header('Location: home.php');
        
    }
    exit;
?>