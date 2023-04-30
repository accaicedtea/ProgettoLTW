<?php
function db_conn()
{
    session_start();
    mysqli_report(MYSQLI_REPORT_OFF);
    /* @ is used to suppress warnings */
    $conn = @mysqli_connect("localhost", "root", "", "4Money");
    $_SESSION["data_oggi"] = date("Y:m:d");
    if (!$conn) {
        /* Use your preferred error logging method here */
        header("Location: ./error.php?error=405");
        exit();
    }
    return $conn;
}
function log_out($conn)
{
    session_destroy();
    
}
    function check($conn)
{
    $uname = $_SESSION['username'];
    $passw = $_SESSION['password'];
    $sql = "SELECT * FROM utente WHERE username='$uname' AND password='$passw'";;
    $result = mysqli_query($conn,$sql);
    if($row = mysqli_fetch_assoc($result) != 1){
        $_SESSION['log']='off';
    }
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
    $username = $_SESSION["username"];
    $emparray = [];
    $data_oggi = $_SESSION["data_oggi"];
    $sql = "select *
    from (SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo 
    FROM spesa s join categoria c on c.id=s.categoria
    WHERE s.utente = '$username' and YEAR(s.data) = YEAR('$data_oggi') and Month(s.data) < Month('$data_oggi')
    UNION
    SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo 
    FROM spesa s join categoria c on c.id=s.categoria 
    WHERE s.utente = '$username' and Year(s.data) = YEAR('$data_oggi') and MONTH(s.data) = MONTH('$data_oggi') and DAY(s.data) <= DAY('$data_oggi')
    union
    SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo 
    FROM spesa s join categoria c on c.id=s.categoria 
    WHERE s.utente = '$username' and YEAR(s.data) < YEAR('$data_oggi')
    )as vie
    ORDER BY vie.data DESC;";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }
    $_SESSION["categoria"] = "Tutte le categorie";
    $_SESSION["tipo"] = "Tutti i tipi";
    return json_encode($emparray);
}
function getJsonScadenze($conn)
{
    $username = $_SESSION["username"];
    $emparray = [];
    $data_oggi = $_SESSION["data_oggi"];
    $sql = "select *
    from (SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo 
    FROM spesa s join categoria c on c.id=s.categoria
    WHERE s.utente = '$username' and YEAR(s.data) = YEAR('$data_oggi') and Month(s.data) > Month('$data_oggi')
    UNION
    SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo 
    FROM spesa s join categoria c on c.id=s.categoria 
    WHERE s.utente = '$username' and Year(s.data) = YEAR('$data_oggi') and MONTH(s.data) = MONTH('$data_oggi') and DAY(s.data) > DAY('$data_oggi')
    union
    SELECT s.id as id, s.utente as utente, s.data as data, s.descrizione as descrizione, c.nome as categoria,s.importo as importo 
    FROM spesa s join categoria c on c.id=s.categoria 
    WHERE s.utente = '$username' and YEAR(s.data) > YEAR('$data_oggi')
    )as vie
    ORDER BY vie.data;";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }
    $_SESSION["categoria"] = "Tutte le categorie";
    $_SESSION["tipo"] = "Tutti i tipi";
    return json_encode($emparray);
}
function getJsonBuffi($conn)
{
    $username = $_SESSION["username"];
    $emparray = [];
    $sql = "SELECT s.id as id, s.utente as utente, s.descrizione as descrizione, c.nome as categoria,s.importo as importo 
    FROM spesa s join categoria c on c.id=s.categoria 
    WHERE s.utente = '$username' AND data is NULL 
    ORDER BY id;";
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
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
function bar90g($conn)
{  

    $sql="SELECT nazionalita,count(*) as quanti
            FROM utente
            GROUP by nazionalita;";
    
    $array = "";
    $i = 0;
    $arr ="";
    
    $result = $conn->query($sql);
    $len = $result->num_rows;
    while ($row = $result->fetch_assoc()) {
        
        $arr = "['".$row['nazionalita']."',".$row['quanti']."]";
        if($len>1){
             $arr.=",";
             $len-=1;
        }
        $array .= $arr;
    }
    return $array;
    
}
function get_eta_per_categorie($conn)
{
    //categoria gra_fico
    $sql ="SELECT 
    CASE WHEN (age>=14 and age <=19) THEN '15-19' 
        WHEN (age>=20 and age <=24) THEN '20-24'
        WHEN (age>=25 and age <=29) THEN '25-29' 
        WHEN (age>=30 and age <=34) THEN '30-34' 
        WHEN (age>=35 and age <=40) THEN '35-40' 
        WHEN (age>=41 and age <=45) THEN '41-45' 
        WHEN (age>=46 and age <=51) THEN '46-51' 
        ELSE '52+' 
    END AS eta_eta FROM (SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),dataN)), '%Y') + 0 AS age, sesso FROM utente) as vista
    GROUP BY eta_eta
    order by eta_eta;";
    $array = "";
    $i = 0;
    $arr ="";
     
    $result = $conn->query($sql);
    $len = $result->num_rows;
    while ($row = $result->fetch_assoc()) {
         
        $arr = "'".$row['eta_eta']."'";
        if($len>1){
            $arr.=",";
            $len-=1;
        }
        $array .= $arr;
    }
    return $array;
}
function get_eta_sesso_graph($conn,$sesso)
{
    //divisione x sesso, gruppati per eta
    $sql="SELECT count(*) as quanti, 
    CASE WHEN (age>=15 and age <=19) THEN '15-19' 
    WHEN (age>=20 and age <=24) THEN '20-24' 
    WHEN (age>=25 and age <=29) THEN '25-29' 
    WHEN (age>=30 and age <=34) THEN '30-34' 
    WHEN (age>=35 and age <=40) THEN '35-40' 
    WHEN (age>=41 and age <=45) THEN '41-45' 
    WHEN (age>=46 and age <=51) THEN '46-51' 
    ELSE '52+' END AS eta_eta 
    FROM (SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),dataN)), '%Y') + 0 AS age, sesso 
        FROM utente 
        WHERE sesso=$sesso) as vista
    GROUP BY eta_eta,sesso
    order by eta_eta;";
    $result = mysqli_query($conn, $sql);
    $array = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $array = array(
            'quanti' => $row['quanti'],
            'eta' => $row['eta_eta']
        );
        $array_series[] = $array;
    }
    return json_encode($array_series);

}
function get_eta_graph($conn)
{
    //divisione x sesso, gruppati per eta
    $sql="SELECT count(*) as quanti, 
    CASE WHEN (age>=15 and age <=19) THEN '15-19' 
    WHEN (age>=20 and age <=24) THEN '20-24' 
    WHEN (age>=25 and age <=29) THEN '25-29' 
    WHEN (age>=30 and age <=34) THEN '30-34' 
    WHEN (age>=35 and age <=40) THEN '35-40' 
    WHEN (age>=41 and age <=45) THEN '41-45' 
    WHEN (age>=46 and age <=51) THEN '46-51' 
    ELSE '52+' END AS eta_eta 
    FROM (SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),dataN)), '%Y') + 0 AS age, sesso 
        FROM utente) as vista
    GROUP BY eta_eta
    order by eta_eta;
    ";
    $result = mysqli_query($conn, $sql);
    $array = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $array = array(
            'quanti' => $row['quanti'],
            'eta' => $row['eta_eta']
        );
        $array_series[] = $array;
    }
    return json_encode($array_series);

}
function get_array_sesso($json_totali,$json_sesso_s,$sesso)
{
    $json = json_decode($json_totali, true);
    $json_s = json_decode($json_sesso_s,true);
    $array = "";
    $len = sizeof($json);
    for($i=0;$i<sizeof($json);$i++){
        $find_this = $json[$i]['eta'];
        $index=-1;
        //echo "eta sesso: ".$find_this;
        for($j=0; $j<sizeof($json_s);$j++){
            $t_d = $json_s[$j]['eta'];
            //echo "eta totali: ".$t_d;
            if($find_this==$t_d){
                $index=$j;
            }
        }
        if($index!=-1){
            //ok
            
            $perc = $json_s[$index]['quanti']/$json[$i]['quanti'];
            $perc *= 100;
            if($sesso==1){
                $arr = "-".$perc."";
            }else{
                $arr = "".$perc."";
            }
        }else{
            $arr = "0";
        }
        if($len>1){
            $arr .= ",";
            $len -= 1;
        }
        $array .= $arr;
    }
    return $array;
}

function histogram($conn)
{
    $username = $_SESSION['username'];
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
}
function linegraph($conn)
{
    $username = $_SESSION['username'];
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
                where importo < 0 AND MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') AND YEAR(spesa.data) = YEAR('$data_oggi') and spesa.utente = '$username'
                group by DAY(spesa.data)
                order by DAY(spesa.data)";
    $result_uscite = $conn->query($sql_uscite);
    if ($result_uscite->num_rows >= 0) {
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
    where importo > 0 AND MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') and YEAR(spesa.data) = YEAR('$data_oggi') AND spesa.utente = '$username'
    group by DAY(spesa.data)
    order by DAY(spesa.data)";
    $result_entrate = $conn->query($sql_entrate);
    if ($result_entrate->num_rows >= 0) {
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
    where MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') AND YEAR(spesa.data) = YEAR('$data_oggi') and spesa.utente = '$username'
    group by DAY(spesa.data)
    order by DAY(spesa.data)";
    $result_differenza = $conn->query($sql_differenza);
    if ($result_differenza->num_rows >= 0) {
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
                'color' => '#4A8DB7',
                "type" => "line"
    );
    $series_array_linegraph_uscite[] = $arr_uscite;
    $series_array_linegraph_entrate[] = $arr_entrate;
    $serie_array_linegraph_differenza[] = $arr_differenza;
    return json_encode(array_merge($series_array_linegraph_uscite, $series_array_linegraph_entrate, $serie_array_linegraph_differenza));
}
function piechart($conn)
{
    $username = $_SESSION['username'];
    $data_oggi = $_SESSION['data_oggi'];
    $sql = "SELECT categoria.nome as categoria, COALESCE(sum(importo),0) / 
                (SELECT COALESCE(sum(importo),0)
                from spesa
                where importo < 0 AND MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') AND YEAR(spesa.data) = YEAR('$data_oggi') AND spesa.utente = '$username') as somma, categoria.colore as colore
            from spesa join categoria on categoria.id = spesa.categoria
            where spesa.importo < 0 AND spesa.utente = '$username' AND MONTH(spesa.data) = MONTH('$data_oggi') AND YEAR(spesa.data) = YEAR('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') and spesa.categoria <> 6
            group by categoria.nome";
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
    $query = "SELECT COALESCE(sum(spesa.importo),0) as somma
    from spesa
    where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) = MONTH('$data_oggi') and importo > 0 and DAY(spesa.data) <= DAY('$data_oggi')";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $str = abs($row["somma"]) . "€";
        array_push($array_dati, $str);
    }
    $query = "SELECT COALESCE(sum(spesa.importo),0) as somma
    from spesa
    where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) = MONTH('$data_oggi') and importo < 0 and DAY(spesa.data) <= DAY('$data_oggi')";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $str = abs($row["somma"]) . "€";
        array_push($array_dati, $str);
    }
    $query = "SELECT COALESCE(sum(spesa.importo),0) + (select COALESCE(sum(spesa.importo),0)
    from spesa
    where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') and spesa.importo > 0) as somma
    from spesa
    where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) < MONTH('$data_oggi') and importo > 0";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $str = abs($row["somma"]) . "€";
        array_push($array_dati, $str);
    }
    $query = "SELECT COALESCE(sum(spesa.importo),0) + (select COALESCE(sum(spesa.importo),0)
    from spesa
    where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') and spesa.importo < 0) as somma
    from spesa
    where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) < MONTH('$data_oggi') and importo < 0";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $str = abs($row["somma"]) . "€";
        array_push($array_dati, $str);
    }
    return json_encode($array_dati);
}
function entrata_graph($conn) {
    $array_dati = [];
    $_SESSION['giorni_mese'] = date("t");
    $giorni_mese = $_SESSION['giorni_mese'];
    $username = $_SESSION["username"];
    $data_oggi = $_SESSION["data_oggi"];
    $array_dati_entrate = array();
    $array_giorni_entrate = array();
    $array_valori_entrate= array();
    $sql_entrate = "SELECT DAY(spesa.data) as giorno, sum(spesa.importo) as entrate 
                from spesa
                where importo > 0 AND MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') AND YEAR(spesa.data) = YEAR('$data_oggi') and spesa.utente = '$username'
                group by DAY(spesa.data)
                order by DAY(spesa.data)";
    $result_entrate = $conn->query($sql_entrate);
    if ($result_entrate->num_rows >= 0) {
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
    $arr_uscite = array(
        'name' => 'Entrate',
        'data' => $array_dati_entrate,
        'color' => '#46A094'
);
$series_array_uscite[] = $arr_uscite;
return json_encode($series_array_uscite);
}
function saldo($conn) {
    $username = $_SESSION['username'];
    $data_oggi = $_SESSION['data_oggi'];
    $_SESSION['giorni_mese'] = date("t");
    $giorni_mese = $_SESSION['giorni_mese'];
    $array_dati = array();
    $array_giorni = array();
    $array_valori = array();
    $array_saldo = array();
    //Saldo iniziale
    $sql_saldo = "SELECT COALESCE(sum(spesa.importo),0) + utente.saldo_ini + (SELECT COALESCE(sum(spesa.importo),0)
                                                                             from spesa
                                                                             where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) < MONTH('$data_oggi')) as saldo
                  from spesa join utente on utente.username = spesa.utente
                  where spesa.utente = '$username' and YEAR(spesa.data) < YEAR('$data_oggi')";
    $result = mysqli_query($conn, $sql_saldo);
    $saldo = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $saldo = $row['saldo'];
    }
    //Variazioni di questo mese
    $sql = "SELECT DAY(spesa.data) as giorno, sum(spesa.importo) as variazione
    from spesa join utente on utente.username = spesa.utente
    where MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') and YEAR(spesa.data) = YEAR('$data_oggi') AND spesa.utente = '$username'
    group by DAY(spesa.data)
    order by DAY(spesa.data)";
    $result = $conn->query($sql);
    if ($result->num_rows >= 0) {
        $i = 1;
        $j = 0;
        while($row = $result->fetch_assoc()) {
            array_push($array_giorni, intval($row['giorno']));
        }
        mysqli_data_seek($result, 0);
        while($row = $result->fetch_assoc()) {
            array_push($array_valori, doubleval($row['variazione']));
        }

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
        for($k = 0; $k < $giorni_mese; $k++) {
            $saldo += $array_dati[$k];
            array_push($array_saldo, doubleval($saldo));
        }
    }
    return json_encode($array_saldo);
}
function saldo_color($saldo) {
    if ($saldo < 0) return "#E65C4F";
    else return "#46A094";
}
function risparmio($conn) {
    $username = $_SESSION['username'];
    $data_oggi = $_SESSION['data_oggi'];
    $_SESSION['giorni_mese'] = date("t");
    $giorni_mese = $_SESSION['giorni_mese'];
    $array_dati = array();
    $array_giorni = array();
    $array_valori = array();
    $array_risparmio = array();
    //Risparmio iniziale
    $sql_risparmio = "SELECT COALESCE(sum(spesa.importo),0) + (SELECT COALESCE(sum(spesa.importo),0)
                                                                from spesa
                                                                where spesa.utente = '$username' and YEAR(spesa.data) = YEAR('$data_oggi') and MONTH(spesa.data) < MONTH('$data_oggi') and spesa.categoria = 6) as risparmio
                  from spesa
                  where spesa.utente = '$username' and YEAR(spesa.data) < YEAR('$data_oggi') and spesa.categoria = 6";
    $result = mysqli_query($conn, $sql_risparmio);
    $risparmio = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $risparmio = $row['risparmio'];
    }
    //Variazioni di questo mese
    $sql = "SELECT DAY(spesa.data) as giorno, sum(spesa.importo) as variazione
    from spesa join utente on utente.username = spesa.utente
    where MONTH(spesa.data) = MONTH('$data_oggi') and DAY(spesa.data) <= DAY('$data_oggi') and YEAR(spesa.data) = YEAR('$data_oggi') AND spesa.utente = '$username' and spesa.categoria = 6
    group by DAY(spesa.data)
    order by DAY(spesa.data)";
    $result = $conn->query($sql);
    if ($result->num_rows >= 0) {
        $i = 1;
        $j = 0;
        while($row = $result->fetch_assoc()) {
            array_push($array_giorni, intval($row['giorno']));
        }
        mysqli_data_seek($result, 0);
        while($row = $result->fetch_assoc()) {
            array_push($array_valori, doubleval($row['variazione']));
        }

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
        for($k = 0; $k < $giorni_mese; $k++) {
            $risparmio += $array_dati[$k];
            array_push($array_risparmio, doubleval($risparmio));
        }
    }
    return json_encode($array_risparmio);
}
function risparmio_color($risparmio) {
    if ($risparmio < 0) return "#E65C4F";
    else return "#99CBFF";
}

//TODO: INIZIO TOOLS
// gli passi la pagina da visualizzare
function navBar($pagina)
{
    //admin
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
                    <a class="nav-link ms-3 <?php if ($pagina == "Informazioni") {
                        echo "active";
                    } ?>" href="./informazioni.php">Informazioni
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
    <?php } 
        //utente loggato
        elseif (isset($_SESSION["log"]) && $_SESSION["log"] == "on") { ?>
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
                    <a class="nav-link <?php if (
                        $pagina == "Visualizza scadenze"
                    ) {
                        echo "active";
                    } ?>" aria-current="page" href="./scadenze.php">Scadenze</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($pagina == "Statistiche") {
                        echo "active";
                    } ?>" aria-current="page" href="./statistiche.php">Statistiche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (
                        $pagina == "Buffi e Buffetti"
                    ) {
                        echo "active";
                    } ?>" aria-current="page" href="./buffi.php">Buffi e buffetti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ms-3 <?php if ($pagina == "Informazioni") {
                        echo "active";
                    } ?>" href="./informazioni.php">Informazioni
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
    <?php } elseif 
        //random
        (
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
                    <a class="nav-link <?php if ($pagina == "Informazioni") {
                        echo "active";
                    } ?>" href="./informazioni.php">Informazioni
                    </a>
                </li>
                </ul>
                <a class="btn me-3 btn-success" href="./login.php" role="button">Accedi</a>
                <a class="btn btn-danger" href="./register.php  " role="button">Registrati</a>
            </div>
            </div>
        </nav>
    </div>
    <?php } ?>
    <!-- testo ad ogni inizio pagina -->
    <div class="container-top-text">
        <span class="text"> <?php echo $pagina;?> </span>
    </div>
<?php } ?>
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
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="stylesheet" href="./assets/css/animation.css">

        
        <script src="./site/asserts/js/scripts.js"></script>
        <script src="./assets/js/register_controlli.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>   
        
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script><!-- jquery-->
    </head>
<?php
} ?>
