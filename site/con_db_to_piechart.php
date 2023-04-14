<?php
$pagina = "con_db_to_dashboard";
$username = $_SESSION['username'];
$_SESSION['data_oggi'] = date("Y:m:d");
$data_oggi = $_SESSION['data_oggi'];
$sql = "SELECT categoria as categoria, sum(importo) / (SELECT sum(importo) from spesa where importo < 0 AND MONTH(spesa.data) = MONTH('$data_oggi') AND spesa.utente = '$username') as somma, categoria.colore as colore from spesa join categoria on categoria.id = spesa.categoria where spesa.importo < 0 AND spesa.utente = '$username' AND MONTH(spesa.data) = MONTH('$data_oggi') group by categoria.nome";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr = array (
            'name' => $row['categoria'],
            'y' => doubleval($row['somma']),
            'color' => $row['colore']
        );
        $series_array_piechart[] = $arr;
    }
    return json_encode($series_array_piechart);
}
?>