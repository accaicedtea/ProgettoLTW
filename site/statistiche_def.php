<?php
    $pagina = "Statistiche";
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    if (isset($_SESSION['log']) && $_SESSION['log']== 'on'){
        navBar($pagina);
        $ultimo_giorno_mese = date("d");
        $json_data_linegraph = linegraph($conn);
        $json_giorni_mese = giorni_mese();
        $json_data_saldo = saldo($conn);
        $json_data_risparmio = risparmio($conn);
        $array_saldo = json_decode($json_data_saldo);
        $saldo_finale = intval($array_saldo[$ultimo_giorno_mese - 1]);
        $colore_saldo = saldo_color($saldo_finale);
        $array_risparmio = json_decode($json_data_risparmio);
        $risparmio_finale = intval($array_risparmio[$ultimo_giorno_mese - 1]);
        $colore_risparmio = saldo_color($risparmio_finale);

        $json_data_linegraph_year = linegraph_year($conn);  
        $json_data_saldo_year = saldo_year($conn);         
        $json_data_risparmio_year = risparmio_year($conn);    

?>
<script>
    function applicaFiltroPeriodo(){
        var e = document.getElementById("selectAge");
        var age = e.options[e.selectedIndex].text;
        if (age=="Mese corrente")
            displayMese();
        else
            displayAnno();
    }
</script>

<body>
    <div class="conteiner">
        <div class="row">
            <div class="col-auto ">
                <p class=" m-0 fw-bold">Filtra per:</p>
            </div>
            <div class="col-auto ">
                <select id="selectAge" class="d-inline-block form-select form-select-sm" onchange="applicaFiltroPeriodo()">
                    <option value="mese" selected>Mese corrente</option>
                    <option value="anno">Anno corrente</option>
                </select> 
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                feofheofhoe
            </div>
            <div class="col">fiefiegf</div>
            <div class="col">eihfeigfeigf</div>
        </div>
    </div>
</body>











<?php } else{
    header("Location: login.php?error=ma che stavi a provà a fa limortaaaaa");
    } ?>

