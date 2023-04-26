<?php
$_SESSION['giorni'] = date("t");
$giorni = $_SESSION['giorni'];
$i = 1;
$array_giorni_mese = array();
while ($i <= $giorni) {
    array_push($array_giorni_mese, $i);
    $i++;
}
return json_encode($array_giorni_mese);
?>