
<?php 
    
    $pagina = "Dashboard";
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
        
    $_SESSION['data_oggi'] = date("Y:m:d");
    if (isset($_SESSION['adminLog']) && $_SESSION['adminLog']== 'daje'){
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
  max-width: 900px;
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



</style>
<style>
.pupup {
    animation: pupup 1s cubic-bezier(0.61, 1, 0.88, 1) 0s 1 normal forwards;
}
@keyframes pupup {
	0% {
        opacity: 0;
		transform: scale(1);
	}

	50% {
        opacity: 0.5;
		transform: scale(1.1);
	}

	100% {
		transform: scale(1);
	}
}
</style>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-6 mt-5 ">
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
            </div>



            <div class="col-md-6 mt-5 ">
                <div class="card border-success mb-3 card-high shadow " >
                    <div class="card-header">Tabella</div>
                    <div class="card-body text-success">        
                    <figure class="highcharts-figure">
                <div id="grafico-sesso-eta">
                    <script>
                    // Age categories
                    
                    // Age categories
                    var categories = [
                        <?php echo get_eta_per_categorie($conn);?>
                    ];
                    
                    Highcharts.chart('grafico-sesso-eta', {
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Distribuzione utenti divisi per età',
                            align: 'left'
                        },
                        credits: {
                            enabled: false
                        },
                        accessibility: {
                            point: {
                                valueDescriptionFormat: '{index}. Età {xDescription}, {value}%.'
                            }
                        },
                        xAxis: [{
                            categories: categories,
                            reversed: false,
                            labels: {
                                step: 1
                            },
                            accessibility: {
                                description: 'Età (uomo)'
                            }
                        }, { // mirror axis on right side
                            opposite: true,
                            reversed: false,
                            categories: categories,
                            linkedTo: 0,
                            labels: {
                                step: 1
                            },
                            accessibility: {
                                description: 'Età (donna)'
                            }
                        }],
                        yAxis: {
                            title: {
                                text: null
                            },
                            labels: {
                                formatter: function () {
                                    return Math.abs(this.value) + '%';
                                }
                            },
                            accessibility: {
                                description: 'Percentuale utenti',
                                rangeDescription: 'Range: 0 to 100%'
                            }
                        },
                    
                        plotOptions: {
                            series: {
                                stacking: 'normal',
                                borderRadius: '50%'
                            }
                        },
                    
                        tooltip: {
                            formatter: function () {
                                return '<b>' + this.series.name + ', età ' + this.point.category + '</b><br/>' +
                                    'Utenti: ' + Highcharts.numberFormat(Math.abs(this.point.y), 1) + '%';
                            }
                        },
                    
                        series: [{
                            name: 'Uomo',
                            data: [
                                <?php 
                                    $sesso=1;
                                    $totali= get_eta_graph($conn);
                                    $sesso_uomo = get_eta_sesso_graph($conn,$sesso);
                                    $frazione_test=get_array_sesso($totali,$sesso_uomo,$sesso);
                                    echo $frazione_test; 
                                ?>
                            ]
                        }, {
                            name: 'Donna',
                            data: [
                            
                                <?php 
                                    $sesso=0;
                                    $totali= get_eta_graph($conn);
                                    $sesso_donna = get_eta_sesso_graph($conn,$sesso);
                                    $frazione_test=get_array_sesso($totali,$sesso_donna,$sesso);
                                    echo $frazione_test; 
                                ?>
                            ]
                        }]
                    });
            
                    </script>
                </div>
            </figure>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
           
            <div class="col-md-6">
                <div class="card border-success mb-3 card-high shadow" >
                    <div class="card-header">Tabella</div>
                    <div class="card-body text-success">        
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
                                                rotation:0,
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
    
</body> 



<?php
    }else{
        header("Location: login.php?error=ma che stavi a provà a fa limortaaaaa");
    }
?>