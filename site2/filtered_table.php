<?php 
    include "./funzioni.php";
    $conn = db_conn();

    $user = $_SESSION['username'];

    $categoria_prec = ((!isset($_SESSION["categoria"]) || $_SESSION["categoria"]=="") ? "Tutte le categorie" : $_SESSION["categoria"]);
    $tipo_prec = ((!isset($_SESSION["tipo"]) || $_SESSION["tipo"]=="") ? "Tutti i tipi" : $_SESSION["tipo"]);
    $categoria = ((!isset($_GET["categoria"]) || $_GET["categoria"]=="") ? $categoria_prec : $_GET["categoria"]);
    $tipo = ((!isset($_GET["tipo"]) || $_GET["tipo"]=="") ? $tipo_prec : $_GET["tipo"]);

    $catQuery = $conn->query("SELECT nome FROM categoria");
    if($catQuery->num_rows> 0){
        $options= mysqli_fetch_all($catQuery, MYSQLI_ASSOC);
    }

    $_SESSION['categoria'] = $categoria;
    $_SESSION['tipo'] = $tipo;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

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