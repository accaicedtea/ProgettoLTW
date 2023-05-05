<?php 
    
    $pagina = "Dashboard";
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
        
    $_SESSION['data_oggi'] = date("Y:m:d");
    navBar($pagina);
    $json_data_piechart = piechart($conn);
    $json_data_linegraph = entrata_graph($conn);
    $json_data_histogram = histogram($conn);
    $json_giorni_mese = giorni_mese();
    //echo $json_data_piechart;
?>

<style>
    .highcharts-figure,
.highcharts-data-table table,.card-high {
  min-width: 260px;
  max-width: 800px;
  margin: 1em auto;
}

/* Global font */
@import url("https://fonts.googleapis.com/css?family=Dosis:400,600");
@import url("../highcharts.css");

:root {
    /* Colors for data series and points. */
    --highcharts-color-0: #7cb5ec;
    --highcharts-color-1: #f7a35c;
    --highcharts-color-2: #90ee7e;
    --highcharts-color-3: #7798bf;
    --highcharts-color-4: #aaeeee;
    --highcharts-color-5: #ff0066;
    --highcharts-color-6: #eeaaee;
    --highcharts-color-7: #55bf3b;
    --highcharts-color-8: #df5353;
    --highcharts-color-9: #7798bf;
}

.highcharts-container {
    font-family: Dosis, arial, helvetica, sans-serif;
}

.highcharts-title,
.highcharts-subtitle,
.highcharts-yaxis .highcharts-axis-title {
    text-transform: uppercase;
}

.highcharts-title {
    font-weight: bold;
    font-size: 1.3em;
}

.highcharts-axis-labels {
    font-size: 1em;
}

.highcharts-legend-item > text {
    font-size: 1.1em;
}

.highcharts-xaxis-grid .highcharts-grid-line {
    stroke-width: 1px;
}

.highcharts-tooltip-box {
    stroke-width: 0;
    fill: rgb(219, 219, 216);
}
    
</style>

<div class="card border-success mb-3 card-high shadow" >
  <div class="card-header">Header</div>
  <div class="card-body text-success">
    
        <h5 class="card-title">Success card title</h5>
        
        <figure class="highcharts-figure">
                                <div id="area graph">
                                    <script>
                                        Highcharts.chart('area graph', {
                                            chart: {
                                                type: 'area'
                                            },
                                            title: {
                                                text: 'Entrate di questo mese'
                                            },
                                            credits:{
                                                enabled: false
                                            },
                                            xAxis: {
                                                categories: <?=$json_giorni_mese;?>
                                            },
                                            yAxis: {
                                                title: {
                                                    text: '€'
                                                }
                                            },
                                            tooltip: {
                                                valueDecimals: 2,
                                                valueSuffix: "€"
                                            },
                                            plotOptions: {
                                                line: {
                                                    dataLabels: {
                                                        enabled: true,
                                                    },
                                                    enableMouseTracking: false
                                                }
                                            },
                                            series: 
                                                <?=$json_data_linegraph;?>
                                        });
                                    </script>
                                </div>
                            </figure>
    </div>
</div>