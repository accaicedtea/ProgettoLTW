<?php 
    
    $pagina = "Dashboard";
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
        
    $_SESSION['data_oggi'] = date("Y:m:d");
    if (isset($_SESSION['log']) && $_SESSION['log']== 'on'){
        navBar($pagina);
        $json_data_piechart = piechart($conn);
        $json_data_linegraph = entrata_graph($conn);
        $json_data_histogram = histogram($conn);
        $json_giorni_mese = giorni_mese();
        //echo $json_data_piechart;
?>

<style>
    .highcharts-figure,
.highcharts-data-table table {
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
<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container">  
                    <!-- inizio riga -->
                    <div class="row justify-content-center mt-3">
                        <div id="entrate_mensili" class="col-auto lg-3 card shadow me-2 mt-2">
                            <p class="fs-5 mt-2">Entrate mensili</p>
                            <span class="border-bottom"></span>
                            <!--Entrate mensili da database-->
                        </div>
                        <div id="uscite_mensili" class="col-auto  lg-3 card shadow me-2 mt-2">
                            <p class="fs-5 mt-2">Uscite mensili</p>
                            <span class="border-bottom"></span>
                            <!--Uscite mensili da database-->
                        </div>
                        <div id="entrate_annuali" class="col-auto lg-3 card shadow me-2 mt-2">
                            <p class="fs-5 mt-2">Entrate annuali</p>
                            <span class="border-bottom"></span>
                            <!--Entrate annuali da database-->
                        </div>
                        <div id="uscite_annuali" class="col-auto lg-3 card shadow me-2 mt-2">
                            <p class="fs-5 mt-2">Uscite annuali</p>
                            <span class="border-bottom"></span>
                            <!--uscote annuali da database-->
                        </div>
                    </div>
                    <!-- fine riga -->
                    <!-- nuova riga per grafico area-->
                    <div class="row">
                        <div class="col">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold text-start">Profilo <i class="bi bi-person-bounding-box"></i></p>             
                        </div>
                    <div>
                        <img id="pfp" src="" class="rounded-circle fade-in" width="100" height="100">
                    </div>
                    <p class="m-0 h5 fw-bold text-center text-primary" >Username dell'utente</p>
                    
                    <p class="m-0 h5 fw-bold text-center" id="username"></p>
                    <div class="card-body text-center">

                        <button type="button" class="btn btn-primary btn-sm fade-in mb mt-5" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                            Cambia icona profilo
                        </button>
                  
                    </div>
                        <div class="col mt-5">
                            
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
                    <!-- nuova riga per 2 grafici -->
                    <div class="row container">
                        <div class="col-xl-6">
                            <figure class="highcharts-figure">
                                <div id="pie chart">
                                    <script>
                                        Highcharts.chart('pie chart', {
                                            chart: {
                                                plotBackgroundColor: null,
                                                plotBorderWidth: null,
                                                plotShadow: false,
                                                type: 'pie'
                                            },
                                            credits: {
                                                enabled: false
                                            },
                                            title: {
                                                text: 'Percentuali uscite di <?php if (date("m") == "01") echo "gennaio";if (date("m") == "02") echo "febbraio";if (date("m") == "03") echo "marzo";if (date("m") == "04") echo "aprile";if (date("m") == "05") echo "maggio";if (date("m") == "06") echo "giugno";if (date("m") == "07") echo "luglio";if (date("m") == "08") echo "agosto";if (date("m") == "09") echo "settembre";if (date("m") == "10") echo "ottobre";if (date("m") == "11") echo "novembre";if (date("m") == "12") echo "dicembre";?>',
                                                align: 'left'
                                            },
                                            tooltip: {
                                                pointFormat: '<b>{point.percentage:.1f}%</b>'
                                            },
                                            accessibility: {
                                                point: {
                                                    valueSuffix: '%'
                                                }
                                            },
                                            plotOptions: {
                                                pie: {
                                                    allowPointSelect: true,
                                                    cursor: 'pointer',
                                                    dataLabels: {
                                                        enabled: true,
                                                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                                    }
                                                }
                                            },
                                            series: [{ 
                                                data: <?=$json_data_piechart;?>
                                            }]
                                        });
                                    </script>
                                </div>
                            </figure>
                        </div>
                        <div class="col-xl-6 ">
                            <figure class="highcharts-figure">
                                        <div id="histogram">
                                            <script>
                                                <?php 
                                                    $title = "Spese durante l'anno";
                                                    $title = addslashes($title);
                                                ?>  
                                            Highcharts.chart('histogram', {
                                                chart: {
                                                    type: 'column'
                                                },
                                                credits: {
                                                enabled:false
                                                },
                                                title: {
                                                    align: 'left',
                                                    text: '<?php echo $title;?>'
                                                },
                                                accessibility: {
                                                    announceNewData: {
                                                        enabled: true
                                                    }
                                                },
                                                xAxis: {
                                                    type: 'category',
                                                    labels: {
                                                        style: {
                                                            fontWeight: 'bold'
                                                        }
                                                    }
                                                },
                                                yAxis: {
                                                    title: {
                                                        text: '€'
                                                    }
                                                },
                                                legend: {
                                                    enabled: false
                                                },
                                                plotOptions: {
                                                    series: {
                                                        borderWidth: 0,
                                                        dataLabels: {
                                                            enabled: true,
                                                            format: '{y:.2f}€'
                                                        }
                                                    }
                                                },
                                                tooltip: {
                                                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}€<br/>'
                                                },
                                            
                                                series: [{
                                                    name: 'Spesa del mese',
                                                    colorByPoint:true,
                                                    data: <?=$json_data_histogram;?>
                                                }]
                                            });
                                            </script>
                                        </div>
                                    </figure>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    window.onload = populateVal();
    function populateVal() {
        // THE JSON ARRAY.
        let data = <?= get_euma($conn);?>;
        
        let ele = document.getElementById('entrate_mensili');

        ele.innerHTML = ele.innerHTML +
            '<p class="fs-4 fw-bolder mt-2" value="' + data[0]+ '">' + data[0]+ '</p>';
        
        ele = document.getElementById('uscite_mensili');
        ele.innerHTML = ele.innerHTML +
            '<p class="fs-4 fw-bolder mt-2" value="' + data[1]+ '">' + data[1]+ '</p>';

        ele = document.getElementById('entrate_annuali');
        ele.innerHTML = ele.innerHTML +
            '<p class="fs-4 fw-bolder mt-2" value="' + data[2]+ '">' + data[2]+ '</p>';
            
        ele = document.getElementById('uscite_annuali');
        ele.innerHTML = ele.innerHTML +
            '<p class="fs-4 fw-bolder mt-2" value="' + data[3]+ '">' + data[3]+ '</p>';
        
    }
</script>

<?php }else{
    header("Location: login.php?error=ma che stavi a provà a fa limortaaaaa");
    } ?>