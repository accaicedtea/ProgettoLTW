<?php
$username = $_SESSION['username'];
$_SESSION['data_oggi'] = date("Y:m:d");
$data_oggi = $_SESSION['data_oggi'];
$_SESSION['giorni_mese'] = date("t");
$giorni_mese = $_SESSION['giorni_mese'];
$array_dati_uscite = array();
$array_giorni_uscite = array();
$array_valori_uscite = array();
$array_dati_entrate = array();
$array_giorni_entrate = array();
$array_valori_entrate = array();
$array_dati_differenza = array();
$array_giorni_differenza = array();
$array_valori_differenza = array();
$sql_uscite = "SELECT DAY(spesa.data) as giorno, sum(spesa.importo) as uscite 
               from spesa
               where importo < 0 AND MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') and spesa.utente = '$username'
               group by DAY(spesa.data)
               order by DAY(spesa.data)";
$result_uscite = $conn->query($sql_uscite);
if ($result_uscite->num_rows > 0) {
    $i = 1;
    $j = 0;
    while($row_uscite = $result_uscite->fetch_assoc()) {
        array_push($array_giorni_uscite, intval($row_uscite['giorno']));
    }
    mysqli_data_seek($result_uscite, 0);
    while($row_uscite = $result_uscite->fetch_assoc()) {
        array_push($array_valori_uscite, doubleval($row_uscite['uscite']));
    }
    while($i <= $giorni_mese) {
        if (!in_array($i, $array_giorni_uscite,false)) {
                array_push($array_dati_uscite, doubleval('0'));
        }
        else {
            array_push($array_dati_uscite, doubleval($array_valori_uscite[$j]));
            $j++;
        }
        $i++;
    }
}
$sql_entrate = "SELECT DAY(spesa.data) as giorno, sum(spesa.importo) as entrate
from spesa 
where importo > 0 AND MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') and spesa.utente = '$username'
group by DAY(spesa.data)
order by DAY(spesa.data)";
$result_entrate = $conn->query($sql_entrate);
if ($result_entrate->num_rows > 0) {
    $i = 1;
    $j = 0;
    while($row_entrate = $result_entrate->fetch_assoc()) {
        array_push($array_giorni_entrate, intval($row_entrate['giorno']));
    }
    mysqli_data_seek($result_entrate, 0);
    while($row_entrate = $result_entrate->fetch_assoc()) {
        array_push($array_valori_entrate, doubleval($row_entrate['entrate']));
    }

    while($i <= $giorni_mese) {
        if (!in_array($i, $array_giorni_entrate,false)) {
                array_push($array_dati_entrate, doubleval('0'));
        }
        else {
            array_push($array_dati_entrate, doubleval($array_valori_entrate[$j]));
            $j++;
        }
        $i++;
    }
}
$sql_differenza = "SELECT DAY(spesa.data) as giorno, sum(spesa.importo) as differenza
from spesa 
where MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) = DAY('$data_oggi') and spesa.utente = '$username'
group by DAY(spesa.data)
order by DAY(spesa.data)";
$result_differenza = $conn->query($sql_differenza);
if ($result_differenza->num_rows > 0) {
    $i = 1;
    $j = 0;
    while($row_differenza = $result_differenza->fetch_assoc()) {
        array_push($array_giorni_differenza, intval($row_differenza['giorno']));
    }
    mysqli_data_seek($result_differenza, 0);
    while($row_differenza = $result_differenza->fetch_assoc()) {
        array_push($array_valori_differenza, doubleval($row_differenza['differenza']));
    }

    while($i <= $giorni_mese) {
        if (!in_array($i, $array_giorni_differenza,false)) {
                array_push($array_dati_differenza, doubleval('0'));
        }
        else {
            array_push($array_dati_differenza, doubleval($array_valori_differenza[$j]));
            $j++;
        }
        $i++;
    }
}
$arr_uscite = array(
            'name' => 'Uscite',
            'data' => $array_dati_uscite,
            'color' => '#E65C4F'
           
);
$arr_entrate = array(
            'name' => 'Entrate',
            'data' => $array_dati_entrate,
            'color' => '#46A094'
);
$arr_differenza = array (
            'name' => 'Differenza',
            'data' => $array_dati_differenza,
            'color' => '#4A8DB7'
);
$series_array_linegraph_uscite[] = $arr_uscite;
$series_array_linegraph_entrate[] = $arr_entrate;
$serie_array_linegraph_differenza[] = $arr_differenza;
return json_encode(array_merge($series_array_linegraph_uscite, $series_array_linegraph_entrate, $serie_array_linegraph_differenza));
?>