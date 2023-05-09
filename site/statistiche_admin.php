<?php 
$pagina = 'Statistiche';
require './funzioni.php';
$conn = db_conn();
head($pagina);
navBar($pagina);
?>
<body>
    
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6">
        <div class="card border-success mb-3 card-high shadow hi-top" >
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
                        credits:{enabled:false},
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
        <div class="col-xl-6">
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
                            credits:{enabled:false},
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

    
                        <div class="col">

                        
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
        </div>

    </div>
</div>

</body>