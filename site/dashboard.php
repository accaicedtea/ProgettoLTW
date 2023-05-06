
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
    <div class="container-fluid ">
        <div class="row justify-content-center mt-3 ">
            <div id="entrate_mensili" class="col-auto lg-3 card shadow me-5 mt-2 pupup">
                <p class="fs-5 mt-2">Entrate mensili</p>
                <span class="border-bottom"></span>
                <!--Entrate mensili da database-->
            </div>
            <div id="uscite_mensili" class="col-auto  lg-3 card shadow me-5 mt-2 pupup">
                <p class="fs-5 mt-2">Uscite mensili</p>
                <span class="border-bottom"></span>
                <!--Uscite mensili da database-->
            </div>
            <div id="entrate_annuali" class="col-auto lg-3 card shadow me-5 mt-2 pupup">
                <p class="fs-5 mt-2">Entrate annuali</p>
                <span class="border-bottom"></span>
                <!--Entrate annuali da database-->
            </div>
            <div id="uscite_annuali" class="col-auto lg-3 card shadow me-5 mt-2 pupup">
                <p class="fs-5 mt-2">Uscite annuali</p>
                <span class="border-bottom"></span>
                <!--uscote annuali da database-->
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-6 mt-5 ">
                <div class="card border-success mb-3 card-high shadow hi-top" >
                    <div class="card-header">Tabella</div>
                    <div class="card-body text-success">        
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
                </div>
            </div>



            <div class="col-md-6 mt-5 ">
                <div class="card border-success mb-3 card-high shadow " >
                    <div class="card-header">Tabella</div>
                    <div class="card-body text-success">        
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
                                            rotation: 0,
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
                                    series: <?=$json_data_linegraph;?>
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
                <div class="card shadow card-high">
                    <div class="card-header">
                        <p class="text-primary m-0" ><strong>Le prossime scadenze</strong></p>
                    </div>
                    <div class="card-body text-center">
                        <!-- TABELLA -->
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Cate.</th>
                                        <th>Descr.</th>
                                        <th>Importo</th>
                                        <th>Tipo</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                </tbody>
                            </table>                                
                        </div>
                    </div>
                </div>
            </div>
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
<script>
    // attenzione
    dataSet = <?= getJsonScadenze($conn);?>;
    for (var i in dataSet){
        var html = `<tr class="table-${( dataSet[i].importo>0)? 'success': 'danger'}">
        <td>${dataSet[i].data}</td>
        <td>${dataSet[i].categoria}</td>
        <td>${dataSet[i].descrizione}</td>
        <td>${Math.abs(dataSet[i].importo)} &euro;</td>
        <td>${(dataSet[i].importo>0)? "Entrata": "Uscita"}</td>
    </tr>`
    
    

   var table = $('#tableBody');
   table.append(html);
    } 

    
</script>
<?php
    }else{
        header("Location: login.php?error=ma che stavi a provà a fa limortaaaaa");
    }
?>