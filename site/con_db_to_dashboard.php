<?php
$pagina = "con_db_to_dashboard";
$username = $_SESSION['username'];
$sql = "SELECT categoria as categoria, sum(importo) / (SELECT sum(importo) from spesa where importo < 0 AND spesa.utente = '$username') as somma, colore from spesa join categoria on categoria.nome = spesa.categoria where spesa.importo < 0 AND spesa.utente = '$username' group by categoria.nome";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arr = array (
            'name' => $row['categoria'],
            'y' => doubleval($row['somma']),
            'color' => $row['colore']
        );
        $series_array[] = $arr;
    }
    return json_encode($series_array);
}
?>