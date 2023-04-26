<?php
function db_conn()
{
    session_start();
    mysqli_report(MYSQLI_REPORT_OFF);
    /* @ is used to suppress warnings */
    $conn = @mysqli_connect("localhost", "root", "", "4Money");
    if (!$conn) {
        /* Use your preferred error logging method here */
        header("Location: ./error.php?error=405");
        exit();
    }
    return $conn;
}

function getJsonCat($conn)
{
    $emparray = [];
    $sql = "select * from categoria";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }
    return json_encode($emparray);
}
function getJsonSpese($conn)
{
    $user = $_SESSION["username"];
    $emparray = [];
    $sql = "SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo FROM spesa s join categoria c on c.id=s.categoria WHERE utente = '$user' order by s.data DESC;";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }
    $_SESSION["categoria"] = "Tutte le categorie";
    $_SESSION["tipo"] = "Tutti i tipi";
    return json_encode($emparray);
}
function getJsonSpesa($conn, $id)
{
    $user = $_SESSION["username"];
    $emparray = [];
    $sql = "SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo FROM spesa s join categoria c on c.id=s.categoria WHERE utente = '$user' and s.id='$id' Limit 1;";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }
    $_SESSION["categoria"] = "Tutte le categorie";
    $_SESSION["tipo"] = "Tutti i tipi";
    return json_encode($emparray);
}
function getJsonUtente($conn)
{
    $emparray = [];
    $user = $_SESSION["username"];
    $passw = $_SESSION["password"];
    $sql = "SELECT * FROM utente join stati on utente.nazionalita=stati.id_stati WHERE username = '$user' and password='$passw';";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }
    $_SESSION["categoria"] = "Tutte le categorie";
    $_SESSION["tipo"] = "Tutti i tipi";
    return json_encode($emparray);
}
function getJsonAdmin($conn)
{
    $emparray = [];
    $user = $_SESSION["username"];
    $passw = $_SESSION["password"];
    $sql = "SELECT * FROM admin WHERE id = '$user' and password='$passw';";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }
    return json_encode($emparray);
}
function getJsonStati($conn)
{
    $sql =
        "SELECT stati.id_stati as id, stati.nome_stati as nome from stati order by stati.id_stati";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }
    return json_encode($array);
}
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//TODO: INIZIO GRAFICI
function histogram($conn)
{
    $username = $_SESSION["username"];
    $_SESSION["data_oggi"] = date("Y:m:d");
    $data_oggi = $_SESSION["data_oggi"];
    $sql = "SELECT MONTH(spesa.data) as mese, COALESCE(sum(importo),0) as importo from spesa where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) <= MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') and spesa.importo < 0 GROUP BY MONTH(spesa.data) union select MONTH(spesa.data) as mese, 0 as importo from spesa where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) > MONTH('$data_oggi') group by MONTH(spesa.data) order by mese;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["mese"] == "01") {
                $mese = "gennaio";
            }
            if ($row["mese"] == "02") {
                $mese = "febbraio";
            }
            if ($row["mese"] == "03") {
                $mese = "marzo";
            }
            if ($row["mese"] == "04") {
                $mese = "aprile";
            }
            if ($row["mese"] == "05") {
                $mese = "maggio";
            }
            if ($row["mese"] == "06") {
                $mese = "giugno";
            }
            if ($row["mese"] == "07") {
                $mese = "luglio";
            }
            if ($row["mese"] == "08") {
                $mese = "agosto";
            }
            if ($row["mese"] == "09") {
                $mese = "settembre";
            }
            if ($row["mese"] == "10") {
                $mese = "ottobre";
            }
            if ($row["mese"] == "11") {
                $mese = "novembre";
            }
            if ($row["mese"] == "12") {
                $mese = "dicembre";
            }
            $arr = [
                "name" => $mese,
                "y" => doubleval(abs($row["importo"])),
            ];
            $series_array_histogram[] = $arr;
        }
        return json_encode($series_array_histogram);
    }
}
function linegraph($conn)
{
    $username = $_SESSION["username"];
    $_SESSION["data_oggi"] = date("Y:m:d");
    $data_oggi = $_SESSION["data_oggi"];
    $_SESSION["giorni_mese"] = date("t");
    $giorni_mese = $_SESSION["giorni_mese"];
    $array_dati_uscite = [];
    $array_giorni_uscite = [];
    $array_valori_uscite = [];
    $array_dati_entrate = [];
    $array_giorni_entrate = [];
    $array_valori_entrate = [];
    $array_dati_differenza = [];
    $array_giorni_differenza = [];
    $array_valori_differenza = [];
    $sql_uscite = "SELECT DAY(spesa.data) as giorno, sum(spesa.importo) as uscite 
        from spesa 
        where importo < 0 AND MONTH(spesa.data) = MONTH('$data_oggi') and spesa.utente = '$username'
        group by DAY(spesa.data)
        order by DAY(spesa.data)";
    $result_uscite = $conn->query($sql_uscite);
    if ($result_uscite->num_rows > 0) {
        $i = 1;
        $j = 0;
        while ($row_uscite = $result_uscite->fetch_assoc()) {
            array_push($array_giorni_uscite, intval($row_uscite["giorno"]));
        }
        $result2_uscite = $conn->query($sql_uscite);
        while ($row2_uscite = $result2_uscite->fetch_assoc()) {
            array_push($array_valori_uscite, doubleval($row2_uscite["uscite"]));
        }
        while ($i <= $giorni_mese) {
            if (!in_array($i, $array_giorni_uscite, false)) {
                array_push($array_dati_uscite, doubleval("0"));
            } else {
                array_push(
                    $array_dati_uscite,
                    doubleval($array_valori_uscite[$j])
                );
                $j++;
            }
            $i++;
        }
    }
    $sql_entrate = "SELECT DAY(spesa.data) as giorno, sum(spesa.importo) as entrate
        from spesa 
        where importo > 0 AND MONTH(spesa.data) = MONTH('$data_oggi') and spesa.utente = '$username'
        group by DAY(spesa.data)
        order by DAY(spesa.data)";
    $result_entrate = $conn->query($sql_entrate);
    if ($result_entrate->num_rows > 0) {
        $i = 1;
        $j = 0;
        while ($row_entrate = $result_entrate->fetch_assoc()) {
            array_push($array_giorni_entrate, intval($row_entrate["giorno"]));
        }
        $result2_entrate = $conn->query($sql_entrate);
        while ($row2_entrate = $result2_entrate->fetch_assoc()) {
            array_push(
                $array_valori_entrate,
                doubleval($row2_entrate["entrate"])
            );
        }

        while ($i <= $giorni_mese) {
            if (!in_array($i, $array_giorni_entrate, false)) {
                array_push($array_dati_entrate, doubleval("0"));
            } else {
                array_push(
                    $array_dati_entrate,
                    doubleval($array_valori_entrate[$j])
                );
                $j++;
            }
            $i++;
        }
    }
    $sql_differenza = "SELECT DAY(spesa.data) as giorno, sum(spesa.importo) as differenza
        from spesa 
        where MONTH(spesa.data) = MONTH('$data_oggi') and spesa.utente = '$username'
        group by DAY(spesa.data)
        order by DAY(spesa.data)";
    $result_differenza = $conn->query($sql_differenza);
    if ($result_differenza->num_rows > 0) {
        $i = 1;
        $j = 0;
        while ($row_differenza = $result_differenza->fetch_assoc()) {
            array_push(
                $array_giorni_differenza,
                intval($row_differenza["giorno"])
            );
        }
        $result2_differenza = $conn->query($sql_differenza);
        while ($row2_differenza = $result2_differenza->fetch_assoc()) {
            array_push(
                $array_valori_differenza,
                doubleval($row2_differenza["differenza"])
            );
        }

        while ($i <= $giorni_mese) {
            if (!in_array($i, $array_giorni_differenza, false)) {
                array_push($array_dati_differenza, doubleval("0"));
            } else {
                array_push(
                    $array_dati_differenza,
                    doubleval($array_valori_differenza[$j])
                );
                $j++;
            }
            $i++;
        }
    }
    $arr_uscite = [
        "name" => "Uscite",
        "data" => $array_dati_uscite,
        "color" => "#E65C4F",
    ];
    $arr_entrate = [
        "name" => "Entrate",
        "data" => $array_dati_entrate,
        "color" => "#46A094",
    ];
    $arr_differenza = [
        "name" => "Differenza",
        "data" => $array_dati_differenza,
        "color" => "#4A8DB7",
    ];
    $series_array_linegraph_uscite[] = $arr_uscite;
    $series_array_linegraph_entrate[] = $arr_entrate;
    $serie_array_linegraph_differenza[] = $arr_differenza;
    return json_encode(
        array_merge(
            $series_array_linegraph_uscite,
            $series_array_linegraph_entrate,
            $serie_array_linegraph_differenza
        )
    );
}
function piechart($conn)
{
    $username = $_SESSION["username"];
    $_SESSION["data_oggi"] = date("Y:m:d");
    $data_oggi = $_SESSION["data_oggi"];
    $sql = "SELECT categoria.nome as categoria, sum(importo) / (SELECT sum(importo) from spesa where importo < 0 AND MONTH(spesa.data) = MONTH('$data_oggi') AND spesa.utente = '$username') as somma, categoria.colore as colore from spesa join categoria on categoria.id = spesa.categoria where spesa.importo < 0 AND spesa.utente = '$username' AND MONTH(spesa.data) = MONTH('$data_oggi') group by categoria.nome";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $arr = [
                "name" => $row["categoria"],
                "y" => doubleval($row["somma"]),
                "color" => $row["colore"],
            ];
            $series_array_piechart[] = $arr;
        }
        return json_encode($series_array_piechart);
    }
}
function giorni_mese()
{
    $_SESSION["giorni"] = date("t");
    $giorni = $_SESSION["giorni"];
    $i = 1;
    $array_giorni_mese = [];
    while ($i <= $giorni) {
        array_push($array_giorni_mese, $i);
        $i++;
    }
    return json_encode($array_giorni_mese);
}
function get_euma($conn)
{
    $array_dati = [];
    $username = $_SESSION["username"];
    $data_oggi = $_SESSION["data_oggi"];
    $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo > 0 AND spesa.utente = '$username' AND MONTH(spesa.data) = MONTH('$data_oggi') AND YEAR(spesa.data) = YEAR('$data_oggi')";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $str = abs($row["somma"]) . "€";
        array_push($array_dati, $str);
    }
    $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo < 0 AND spesa.utente = '$username' AND MONTH(spesa.data) = MONTH('$data_oggi') AND YEAR(spesa.data) = YEAR('$data_oggi')";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $str = abs($row["somma"]) . "€";
        array_push($array_dati, $str);
    }
    $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo > 0 AND spesa.utente = '$username' AND YEAR(spesa.data) = YEAR('$data_oggi')";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $str = abs($row["somma"]) . "€";
        array_push($array_dati, $str);
    }
    $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo < 0 AND spesa.utente = '$username' AND YEAR(spesa.data) = YEAR('$data_oggi')";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $str = abs($row["somma"]) . "€";
        array_push($array_dati, $str);
    }
    return json_encode($array_dati);
}
function navBar($pagina)
{
    if (isset($_SESSION["adminLog"]) && $_SESSION["adminLog"] == "daje") { ?>
    <div id="topheader" class="sticky-top ">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand " href="./home.php">4Money</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if ($pagina == "Utenti") {
                        echo "active";
                    } ?>" href="./view.php">Utenti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($pagina == "Categorie") {
                        echo "active";
                    } ?>" href="./categorie.php">Categorie</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link ms-3" href="./informazioni.php">Informazioni
                    </a>
                </li>
                </ul>
                
                <a class=" h5 text-white me-3 mt-1" href="./profile.php" style="text-decoration: none"><?php echo $_SESSION[
                    "nome"
                ]; ?>
                </a>
                
                <a class="btn btn-sm btn-outline-danger" href="./logout.php" role="button">Logout</a>
            </div>
            </div>
        </nav>
    </div>

    <div class="container card bg-transparent mt-2 mb-4 overflow-hidden  shadow-lg p-3 mb-5  rounded text-center">
                
                <p class="h3"><?php echo $pagina; ?></p>
            </div>
    <?php } elseif (isset($_SESSION["log"]) && $_SESSION["log"] == "on") { ?>
    <div id="topheader" class="sticky-top ">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand " href="./home.php">4Money</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if ($pagina == "Dashboard") {
                        echo "active";
                    } ?>" aria-current="page" href="./dashboard.php">Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (
                        $pagina == "Visualizza transazioni"
                    ) {
                        echo "active";
                    } ?>" aria-current="page" href="./transazioni.php">Transazioni
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">Scadenze</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./statistiche.php">Statistiche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (
                        $pagina == "Buffe e buffetti"
                    ) {
                        echo "active";
                    } ?>" href="./buffi.php">Buffi e buffetti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($pagina == "Categorie") {
                        echo "active";
                    } ?>" href="./categorie.php">Categorie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ms-3" href="./informazioni.php">Informazioni
                    </a>
                </li>
                </ul>
                
                <a class="h5 text-white me-3 mt-1 <?php if (
                    $pagina != "Profilo"
                ) {
                    echo "fw-normal";
                } ?>" href="./profile.php" style="text-decoration: none"><?php echo $_SESSION[
    "username"
]; ?>
                </a>
                
                <a class="btn btn-sm btn-outline-danger" href="./logout.php" role="button">Logout</a>
            </div>
            </div>
        </nav>
        
    </div>

    <div class="container card bg-transparent mt-2 mb-4 overflow-hidden  shadow-lg p-3 mb-5  rounded text-center">
                
                <p class="h3"><?php echo $pagina; ?></p>
            </div>

    <?php } elseif (
        !isset($_SESSION["adminLog"]) ||
        !isset($_SESSION["log"])
    ) { ?>
    <div id="topheader" class="sticky-top ">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand " href="./home.php">4Money</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./home.php">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./informazioni.php">Informazioni
                    </a>
                </li>
                </ul>
                <a class="btn me-3 btn-success" href="./login.php" role="button">Accedi</a>
                <a class="btn btn-danger" href="./register.php  " role="button">Registrati</a>
            </div>
            </div>
        </nav>
    </div>


    <div class="container card bg-transparent mt-2 mb-4 overflow-hidden  shadow-lg p-3 mb-5 rounded text-center">
                
                <p class="h3"><?php echo $pagina; ?></p>
            </div>
    <?php }
}
?>
<?php function head($pagina)
{
    ?>
    <!DOCTYPE html>
    <html lang="it">
    <?php if (!isset($pagina)) {
        $pagina = "????";
    } ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title><?php echo $pagina; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>   
        <script src="./site/asserts/js/scripts.js"></script>
        <!-- Option 1: Include in HTML -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script><!-- jquery-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="./assets/css/style.css">
        <script src="./assets/js/register_controlli.js"></script>

        
    </head>
<?php
} ?>
