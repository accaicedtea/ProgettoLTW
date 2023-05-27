<?php 
    include "./funzioni.php";
    $conn = db_conn();

    $username = $_SESSION['username'];
    $data_oggi = $_SESSION["data_oggi"];

    $pagina = $_GET["pagina"];
    $categoria_prec = ((!isset($_SESSION["categoria"]) || $_SESSION["categoria"]=="") ? "Tutte le categorie" : $_SESSION["categoria"]);
    $tipo_prec = ((!isset($_SESSION["tipo"]) || $_SESSION["tipo"]=="") ? "Tutti i tipi" : $_SESSION["tipo"]);
    $categoria = ((!isset($_GET["categoria"]) || $_GET["categoria"]=="") ? $categoria_prec : $_GET["categoria"]);
    $tipo = ((!isset($_GET["tipo"]) || $_GET["tipo"]=="") ? $tipo_prec : $_GET["tipo"]);


    // salva nella sessione i filtri selezionati
    $_SESSION['categoria'] = $categoria;
    $_SESSION['tipo'] = $tipo;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    if ($pagina == "transazioni") // se sono in transazioni, query che prende dalla base di dati le spese passate filtrate
        $query = "select *
        from (SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria, c.id as id_categoria,s.importo as importo 
        FROM spesa s join categoria c on c.id=s.categoria
        WHERE s.utente = '$username' and YEAR(s.data) = YEAR('$data_oggi') and Month(s.data) < Month('$data_oggi')
        UNION
        SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria, c.id as id_categoria,s.importo as importo 
        FROM spesa s join categoria c on c.id=s.categoria 
        WHERE s.utente = '$username' and Year(s.data) = YEAR('$data_oggi') and MONTH(s.data) = MONTH('$data_oggi') and DAY(s.data) <= DAY('$data_oggi')
        union
        SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria, c.id as id_categoria,s.importo as importo 
        FROM spesa s join categoria c on c.id=s.categoria 
        WHERE s.utente = '$username' and YEAR(s.data) < YEAR('$data_oggi')
        )as vie";
    else    // se sono in scadenza, query che prende dalla base di dati le spese future filtrate
        $query = "select *
        from (SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria, c.id as id_categoria,s.importo as importo 
        FROM spesa s join categoria c on c.id=s.categoria
        WHERE s.utente = '$username' and YEAR(s.data) = YEAR('$data_oggi') and Month(s.data) > Month('$data_oggi')
        UNION
        SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria, c.id as id_categoria,s.importo as importo 
        FROM spesa s join categoria c on c.id=s.categoria 
        WHERE s.utente = '$username' and Year(s.data) = YEAR('$data_oggi') and MONTH(s.data) = MONTH('$data_oggi') and DAY(s.data) > DAY('$data_oggi')
        union
        SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria, c.id as id_categoria,s.importo as importo 
        FROM spesa s join categoria c on c.id=s.categoria 
        WHERE s.utente = '$username' and YEAR(s.data) > YEAR('$data_oggi')
        )as vie";
        
    $set_where = 0;
    if ($categoria != "Tutte le categorie"){
        $set_where = 1;
        $query .= " WHERE vie.categoria = '$categoria'";
    }
    if ($tipo != "Tutti i tipi") 
        if ($set_where)
            $query .= ($tipo=="Entrate" ? " AND vie.importo > 0" : " AND vie.importo < 0");
        else
            $query .= ($tipo=="Entrate" ? " WHERE vie.importo > 0" : " WHERE vie.importo < 0");
    $query .= " ORDER BY vie.data ";
    if ($pagina == "transazioni")
        $query .= "DESC";
    
    $result = $conn->query($query);
    $tuples = array();
    if($result->num_rows> 0){
        $tuples= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    $_SESSION['categoria'] = $categoria;
    $_SESSION['tipo'] = $tipo;
    echo json_encode($tuples);
?>