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
<html>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <body id="page-top">
        <div id="wrapper">
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <div id="graphs_container" class="container mt-5"> 
                        <div class="row mt-3 card">
                            <div class="card-body">
                                <div class="container">
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
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 card">
                            <figure class="highcharts-figure">
                                    <div id="area graph">
                                    </div>
                            </figure>
                        </div>
                        <div class="row mt-3">
                            <div class="col card">
                            <figure class="highcharts-figure">
                                <div id="spline graph saldo">
                                </div>
                            </figure>
                            </div>
                        </div>
                        <div class="row card mb-5 mt-3">
                            <figure class="highcharts-figure">
                                <div id="spline graph risparmio">
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    function displayMese(){
        Highcharts.chart('area graph', {
            chart: {
            type: 'area'
            },
            title: {
                text: 'Movimenti di questo mese'
            },
            credits:{
                enabled: false
            },
            xAxis: {
                categories: <?=$json_giorni_mese?>
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
                        format: '{y:.2f} €'
                    },
                    enableMouseTracking: false
                }
            },
            series: 
                <?=$json_data_linegraph?>,
            });

        Highcharts.chart('spline graph saldo', {
            chart: {
                type: 'spline'
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Saldo di questo mese'
            },
            xAxis: {
                categories: <?=$json_giorni_mese?>,
                accessibility: {
                    description: 'Giorni del mese'
                }
            },
            yAxis: {
                title: {
                text: '€'
                },
                labels: {
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true,
                valueDecimals: 2,
                valueSuffix: "€"
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '<?=$colore_saldo?>',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Saldo',
                data: <?=$json_data_saldo?>,
                color: '<?=$colore_saldo?>'
            }]
            });

        Highcharts.chart('spline graph risparmio', {
            chart: {
                type: 'spline'
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Risparmi di questo mese'
            },
            xAxis: {
                categories: <?=$json_giorni_mese?>,
                accessibility: {
                    description: 'Giorni del mese'
                }
            },
            yAxis: {
                title: {
                text: '€'
                },
                labels: {
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true,
                valueDecimals: 2,
                valueSuffix: "€"
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '<?=$colore_risparmio?>',
                        lineWidth: 1
                    }
                },
            },
            series: [{
                name: 'Risparmio',
                data: <?=$json_data_risparmio?>,
                color: '<?=$colore_risparmio?>'
            }]
            });


    }

    displayMese();

    function displayAnno(){
        Highcharts.chart('area graph', {
                chart: {
                type: 'area'
                },
                title: {
                    text: 'Movimenti di questo anno'
                },
                credits:{
                    enabled: false
                },
                xAxis: {
                    categories: ['gennaio', 'febbraio', 'marzo', 'aprile', 'maggio', 'giugno', 'luglio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dicembre']
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
                            format: '{y:.2f} €'
                        },
                        enableMouseTracking: false
                    }
                },
                series: 
                    <?=$json_data_linegraph_year?>,
                });

        Highcharts.chart('spline graph saldo', {
            chart: {
                type: 'spline'
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Saldo di questo anno'
            },
            xAxis: {
                categories: ['gennaio', 'febbraio', 'marzo', 'aprile', 'maggio', 'giugno', 'luglio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dicembre'],
                accessibility: {
                    description: 'Mese'
                }
            },
            yAxis: {
                title: {
                text: '€'
                },
                labels: {
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true,
                valueDecimals: 2,
                valueSuffix: "€"
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '<?=$colore_saldo?>',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Saldo',
                data: <?=$json_data_saldo_year?>,
                color: '<?=$colore_saldo?>'
            }]
            });

        Highcharts.chart('spline graph risparmio', {
                chart: {
                    type: 'spline'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'Risparmi di questo anno'
                },
                xAxis: {
                    categories: ['gennaio', 'febbraio', 'marzo', 'aprile', 'maggio', 'giugno', 'luglio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dicembre'],
                    accessibility: {
                        description: 'Mese'
                    }
                },
                yAxis: {
                    title: {
                    text: '€'
                    },
                    labels: {
                    }
                },
                tooltip: {
                    crosshairs: true,
                    shared: true,
                    valueDecimals: 2,
                    valueSuffix: "€"
                },
                plotOptions: {
                    spline: {
                        marker: {
                            radius: 4,
                            lineColor: '<?=$colore_risparmio?>',
                            lineWidth: 1
                        }
                    },
                },
                series: [{
                    name: 'Risparmio',
                    data: <?=$json_data_risparmio_year?>,
                    color: '<?=$colore_risparmio?>'
                }]
                });


    }
</script>
<?php }else{
    header("Location: login.php?error=ma che stavi a provà a fa limortaaaaa");
    } ?>