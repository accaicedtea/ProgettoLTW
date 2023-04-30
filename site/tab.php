<?php
$query = "SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.id as id_categoria, c.nome as categoria,s.importo as importo FROM spesa s join categoria c on c.id=s.categoria WHERE utente = '$user'";
if ($categoria != "Tutte le categorie") $query .= " AND c.nome = '$categoria'";
if ($tipo != "Tutti i tipi") $query .= ($tipo=="Entrate" ? " AND importo > 0" : " AND importo < 0");
$query .= " ORDER BY s.data DESC;";

$result = $conn->query($query);
$tuples = array();
if($result->num_rows> 0){
    $tuples= mysqli_fetch_all($result, MYSQLI_ASSOC);
}
$_SESSION['categoria'] = $categoria;
$_SESSION['tipo'] = $tipo;
echo json_encode($tuples);
?>