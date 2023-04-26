<?php
$username = $_SESSION['username'];
$_SESSION['data_oggi'] = date("Y:m:d");
$data_oggi = $_SESSION['data_oggi'];
$sql = "SELECT MONTH(spesa.data) as mese, COALESCE(sum(importo),0) as importo 
        from spesa 
        where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) < MONTH('$data_oggi') and spesa.importo < 0 
        GROUP BY MONTH(spesa.data)
        union
        select MONTH(spesa.data) as mese, 0 as importo
        from spesa
        where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) > MONTH('$data_oggi')
        group by MONTH(spesa.data)
        union
        select MONTH(spesa.data) as mese, COALESCE(sum(spesa.importo),0) as importo
        from spesa
        where YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') and spesa.utente = '$username' and spesa.importo < 0
        group by MONTH(spesa.data)
        order by mese;";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        if ($row['mese'] == "01") $mese = "gennaio";if ($row['mese'] == "02") $mese= "febbraio";if ($row['mese'] == "03") $mese= "marzo";if ($row['mese'] == "04") $mese= "aprile";if ($row['mese'] == "05") $mese= "maggio";if ($row['mese'] == "06") $mese="giugno";if ($row['mese'] == "07") $mese="luglio";if ($row['mese'] == "08") $mese= "agosto";if ($row['mese'] == "09") $mese= "settembre";if ($row['mese'] == "10") $mese="ottobre";if ($row['mese'] == "11") $mese="novembre";if ($row['mese'] == "12") $mese= "dicembre";
        $arr = array(
            'name' => $mese,
            'y' => doubleval(abs($row['importo']))
        );
        $series_array_histogram[] = $arr;
        }
        return json_encode($series_array_histogram);
}
?>