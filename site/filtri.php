<?php 
    include "./funzioni.php";
    $conn = db_conn();

    $mese = $_GET['mese'];
    $tuples = piechart_filtrato($conn,$mese);
    
    echo $tuples;
?>