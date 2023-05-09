<?php 
    $pagina = "Dashboard";
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);


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



<div class="card border-success mb-3 card-high shadow hi-top" >
    <div class="card-header">Tabella</div>
    <div class="card-body text-success">        
    <figure class="highcharts-figure">
                                <div id="column chart">
                                    <script>
                                        Highcharts.chart('column chart', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Media uscite per età'
                                },
                                credits: {
                                    enabled: false
                                },
                                xAxis: {
                                    categories: [<?= get_eta_per_categorie($conn);?>]
                                },
                                yAxis: [{
                                    min: 0,
                                    title: {
                                        text: 'Media uscite'                                        
                                    }
                                }],
                                legend: {
                                    shadow: false
                                },
                                tooltip: {
                                    shared: true
                                },
                                plotOptions: {
                                    column: {
                                        grouping: false,
                                        shadow: false,
                                        borderWidth: 0
                                    }
                                },
                                series: [{
                                    name: 'Uomini',
                                    color: '#FF7514',
                                    data: <?=column_sesso($conn,1);?>,
                                    pointPadding: 0.3,
                                    pointPlacement: 0
                                }, {
                                    name: 'Donne',
                                    color: '#991199',
                                    data: <?= column_sesso($conn,0);?>,
                                    pointPadding: 0.4,
                                    pointPlacement: 0
                                }]
                            });
                                    </script>
                                </div>
                                </figure>
    </div>
</div>
         