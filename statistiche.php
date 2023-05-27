<?php
    $pagina = "Statistiche";
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
    navBar($pagina,"Le tue statistiche");
    if (isset($_SESSION['log']) && $_SESSION['log']== 'on'){
        $ultimo_giorno_mese = date("d");    // giorno corrente
        $json_data_linegraph = linegraph($conn);    // i dati da passare al grafico delle entrate, uscite e differenza
        $json_giorni_mese = giorni_mese();  
        $json_data_saldo = saldo($conn);    // i dati da passare al grafico del saldo 
        $json_data_risparmio = risparmio($conn);  // i dati da passare al grafico del risparmio  
        $array_saldo = json_decode($json_data_saldo);
        $saldo_finale = intval($array_saldo[$ultimo_giorno_mese - 1]);  // saldo attuale
        $colore_saldo = saldo_color($saldo_finale); // definisce il colore del grafico in base al segno del saldo attuale
        $array_risparmio = json_decode($json_data_risparmio);
        $risparmio_finale = intval($array_risparmio[$ultimo_giorno_mese - 1]);  // risparmio attuale
        $colore_risparmio = saldo_color($risparmio_finale);     // definisce il colore del grafico in base al segno del risparmio attuale

        // calcolano i dati dei tre grafici nell'anno attuale
        $json_data_linegraph_year = linegraph_year($conn);  
        $json_data_saldo_year = saldo_year($conn);         
        $json_data_risparmio_year = risparmio_year($conn);    

?>
<script>
    // filtra per periodo sulla base del valore della select
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
            
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-secondary mb-3 card-high shadow hi-top" >
                    <div class="card-header">
                        <div class="col-auto ">
                            <p class=" m-0 fw-bold">Visualizza statistiche per:</p>
                        </div>
                        <div class="col-6">
                            <select id="selectAge" class="d-inline-block form-select form-select-sm" onchange="applicaFiltroPeriodo()">
                                <option value="mese" selected>Mese corrente</option>
                                <option value="anno">Anno corrente</option>
                            </select> 
                        </div>
                    </div>
                    <div class="card-body text-success">        
                        <figure class="highcharts-figure">
                            <div id="area graph">  <!-- vuoto, viene riempito con js -->
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-md-5">
                <div class="card border-secondary mb-3 card-high shadow hi-top" >
                    <div class="card-body text-success">        
                        <figure class="highcharts-figure">
                            <div id="spline graph saldo">
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card border-secondary mb-3 card-high shadow hi-top" >
                    <div class="card-body text-success">        
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





   








<!-- Se l'utente non è admin -->
<script>
    // chiama la funzione di highcharts
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
                    rotation:0,
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
                    rotation:0,
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
                    rotation:0,
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

    // di default sono mostrate le statistiche del mese corrente
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
                    rotation:0,
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
                    rotation:0,
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
                    rotation:0,
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


<!-- SE L'UTENTE è ADMIN -->
<?php } else if(isset($_SESSION['adminLog']) && $_SESSION['adminLog']=='daje'){ ?>
<script>
    function applicaFiltroAdmin(){
        var e = document.getElementById("selectTipoAdmin");
        var ue = e.options[e.selectedIndex].text;
        if (ue=="Entrate")
            displayEntrateAdmin();
        else
            displayUsciteAdmin();
    }
</script>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card border-secondary mb-3 card-high shadow hi-top" >
                    <div class="card-header graph-title">Distribuzione utenti divisi per età e sesso</div>
                    <div class="card-body text-success">        
                        <figure class="highcharts-figure">
                            <div id="grafico-sesso-eta">
                                <script>
                                    // Age categories
                                    var categories = [
                                        <?php echo get_eta_per_categorie($conn);?>
                                    ];
                                    
                                    Highcharts.chart('grafico-sesso-eta', {
                                        chart: {
                                            type: 'bar'
                                        },
                                        accessibility: {
                                            point: {
                                                valueDescriptionFormat: '{index}. Età {xDescription}, {value}%.'
                                            }
                                        },
                                        title: {
                                            text: ''
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
                <div class="card border-secondary mb-3 card-high shadow hi-top" >
                    <div class="card-header graph-title">Utenti per Nazionalità</div>
                        <div class="card-body text-success">        
                            <figure class="highcharts-figure utenti">
                                <div id="container-nazionalita">
                                    <script>
                                        Highcharts.chart('container-nazionalita', {
                                            chart: {
                                                type: 'column'
                                            },
                                            title:{text:null},
                                            credits:{enabled:false},
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
            </div>
        <div class="row">
            <div class="col-16">                
                <div class="card border-secondary mb-3 card-high shadow hi-top" >
                <div class="card-header">
                        <div class="col-auto">
                            <p class=" m-0 fw-bold">Filtra per:</p>
                        </div>
                        <div class="col-6">
                            <select id="selectTipoAdmin" class="d-inline-block form-select form-select-sm" onchange="applicaFiltroAdmin()">
                                <option value="entrate" selected>Entrate</option>
                                <option value="uscite">Uscite</option>
                            </select> 
                        </div>
                    </div>
                        <div class="card-body text-success">        
                            <figure class="highcharts-figure">
                                <div id="column chart">
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
    // unico grafico con filtri applicabili nella sezione admin
    function displayEntrateAdmin(){
        Highcharts.chart('column chart', {
            chart: {
                type: 'column'
            },
            title:{
                text: "Media entrate"
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
                    text: 'Media entrate'                                        
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
                data: <?= column_sesso($conn,1);?>,
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

        
    }

    displayEntrateAdmin();

    function displayUsciteAdmin(){
        Highcharts.chart('column chart', {
            chart: {
                type: 'column'
            },
            title:{
                text: "Media uscite"
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
                data: <?=column_sesso_uscite($conn,1);?>,
                pointPadding: 0.3,
                pointPlacement: 0
            }, {
                name: 'Donne',
                color: '#991199',
                data: <?= column_sesso_uscite($conn,0);?>,
                pointPadding: 0.4,
                pointPlacement: 0
            }]
        });
    }
</script>
<?php }else{
    header("Location: login.php?error=Devi prima accedere");
    } ?>

