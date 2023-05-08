<?php 
    
    $pagina = "Dashboard";
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
        
    $_SESSION['data_oggi'] = date("Y:m:d");
    navBar($pagina);

    //echo $json_data_piechart;
?>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
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