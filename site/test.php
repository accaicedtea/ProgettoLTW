<?php require './test_buffi_json.php';
$conn=db_conn();
$sesso=1;
$totali= get_eta_graph($conn);
//echo $totali;
$sesso_uomo = get_eta_sesso_graph($conn,$sesso);
$frazione_test=get_array_sesso($totali,$sesso_uomo);
//echo $frazione_test;
?>

<p id="demo"></p>

<script>
    var obj = <?= eta_sesso_graph($conn); ?>;
    

</script>

