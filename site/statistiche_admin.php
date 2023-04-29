<?php 
$pagina = 'Statistiche';
require './test_buffi_json.php';
$conn = db_conn();
head($pagina);
navBar($pagina);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6">
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
        <div class="col-xl-6">
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
</div>
