<?php
$pagine = 'con_db_to_linegraph';
$username = $_SESSION['username'];
$_SESSION['data_oggi'] = date("Y:m:d");
$data_oggi = $_SESSION['data_oggi'];
$_SESSION['giorni_mese'] = date("t");
$giorni_mese = $_SESSION['giorni_mese'];
$i = 1;
$array_dati = array();
$array_giorni = array();
$array_valori = array();
$sql = "SELECT DAY(spesa.data) as giorno, sum(spesa.importo) as uscite 
from spesa 
where importo < 0 AND MONTH(spesa.data) = MONTH('$data_oggi') and spesa.utente = '$username'
group by DAY(spesa.data)
order by DAY(spesa.data)";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($array_giorni, intval($row['giorno']));
    }
    $result2 = $conn->query($sql);
    while($row2 = $result2->fetch_assoc()) {
        array_push($array_valori, doubleval($row2['uscite']));
    }
    $j = 0;
    while($i <= $giorni_mese) {
        if (!in_array($i, $array_giorni,false)) {
                array_push($array_dati, doubleval('0'));
        }
        else {
            array_push($array_dati, doubleval($array_valori[$j]));
            $j++;
        }
        $i++;
    }
}
$arr = array(
            'name' => 'Uscite',
            'data' => $array_dati
);
$series_array_linegraph[] = $arr;
return json_encode($series_array_linegraph);
?>