<?php
require './funzioni.php';
$conn =db_conn();
$sesso=1;
$totali= get_eta_graph($conn);
$sesso_uomo = get_eta_sesso_graph($conn,$sesso);
$frazione_test=get_array_sesso($totali,$sesso_uomo,$sesso);
echo $frazione_test; 

?>