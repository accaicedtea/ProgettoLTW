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
    <figure class="highcharts-figure utenti">
                <div id="container-nazionalita">
                    <script>
                        Highcharts.chart('container-nazionalita', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Utenti per Nazionalità'
                            },
                            xAxis: {
                                type: 'category',
                                labels: {
                                    rotation: -45,
                                    style: {
                                        fontSize: '13px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Numero utenti'
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            series: [{
                                name: 'numero utenti',
                                data: [
                                    <?php echo bar90g($conn);?>
                                ],
                                dataLabels: {
                                    enabled: true,
                                    color: '#FFFFFF',
                                    align: 'center',
                                    format: '{point.y:0f}', 
                                    y: 30, 
                                    style: {
                                        fontSize: '13px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            }]
                        });
                    </script>
                </div>
            </figure>

    </div>
</div>
         