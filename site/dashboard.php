
<?php 
    
    $pagina = "Dashboard";
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
        
    $_SESSION['data_oggi'] = date("Y:m:d");
    if (isset($_SESSION['log']) && $_SESSION['log']== 'on'){
        navBar($pagina,"Dashboard");
        $json_data_piechart = piechart($conn);
        $json_data_linegraph = entrata_graph($conn);
        $json_data_histogram = histogram($conn);
        $json_giorni_mese = giorni_mese();
        //echo $json_data_piechart;
?>
<body>
    <div class="container-fluid ">
        <div class="row justify-content-center mt-3 ">
            <div id="saldo_attuale" class="col-auto lg-3 card shadow me-2 mt-2 pupup">
                <p class="fs-5 mt-2"><strong>Saldo attuale </strong></p>
                <span class="border-bottom"></span>
                <!--Entrate mensili da database-->
            </div>
            <div id="entrate_mensili" class="col-auto lg-3 card shadow me-2 mt-2 pupup">
                <p class="fs-5 mt-2">Entrate mensili </p>
                <span class="border-bottom"></span>
                <!--Entrate mensili da database-->
            </div>
            <div id="uscite_mensili" class="col-auto  lg-3 card shadow me-2 mt-2 pupup">
                <p class="fs-5 mt-2">Uscite mensili</p>
                <span class="border-bottom"></span>
                <!--Uscite mensili da database-->
            </div>
            <div id="entrate_annuali" class="col-auto lg-3 card shadow me-2 mt-2 pupup">
                <p class="fs-5 mt-2">Entrate annuali</p>
                <span class="border-bottom"></span>
                <!--Entrate annuali da database-->
            </div>
            <div id="uscite_annuali" class="col-auto lg-3 card shadow me-2 mt-2 pupup">
                <p class="fs-5 mt-2">Uscite annuali</p>
                <span class="border-bottom"></span>
                <!--uscite annuali da database-->
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-6 mt-5 ">
                <div class="card border-success mb-3 card-high shadow hi-top" >
                    <div class="card-header"><p class="text-dark m-0" ><strong>Percentuali uscite di <?php if (date("m") == "01") echo "gennaio";if (date("m") == "02") echo "febbraio";if (date("m") == "03") echo "marzo";if (date("m") == "04") echo "aprile";if (date("m") == "05") echo "maggio";if (date("m") == "06") echo "giugno";if (date("m") == "07") echo "luglio";if (date("m") == "08") echo "agosto";if (date("m") == "09") echo "settembre";if (date("m") == "10") echo "ottobre";if (date("m") == "11") echo "novembre";if (date("m") == "12") echo "dicembre";?></strong></p></div>
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
                                            text: '',
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
                    <div class="card-header"><p class="text-dark m-0" ><strong>Entrate di questo mese</strong></p></div>
                    <div class="card-body text-success">        
                        <figure class="highcharts-figure">
                            <div id="area graph">
                                <script>
                                    Highcharts.chart('area graph', {
                                    chart: {
                                        type: 'area'
                                    },
                                    title: {
                                        text: ''
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



        <div class="row mb-5">
            <div class="col-md-6" >
                <div class="card border-success mb-3 card-high shadow" >
                    <div class="card-header"><p class="text-dark m-0" ><strong>Spese durante l'anno</strong></p></div>
                    <div class="card-body text-success">        
                        <figure class="highcharts-figure">
                            <div id="histogram">
                                <script>  
                                    Highcharts.chart('histogram', {
                                        chart: {
                                            type: 'column'
                                        },
                                        credits: {
                                        enabled:false
                                        },
                                        title: {
                                            align: 'left',
                                            text: ''
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
            <div class="col-md-6">
                <div class="card border-success shadow card-high">
                    <div class="card-header">
                        <p class="text-dark m-0" ><strong>Le prossime scadenze </strong></p>
                    </div>
                    <div class="card-body text-center">
                        <!-- TABELLA -->
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info" >
                            <table class="table my-0" id="dataTable" >
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Categoria</th>
                                        <th>Descrizione</th>
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
        '<p class="fs-4 fw-bolder text-success mt-2" value="' + data[0] + '"><i class="bi bi-arrow-up-short"></i>' + data[0]+ '</p>';
    
    ele = document.getElementById('uscite_mensili');
    ele.innerHTML = ele.innerHTML +
        '<p class="fs-4 fw-bolder text-danger mt-2" value="' + data[1] + '"><i class="bi bi-arrow-down-short"></i>' + data[1]+ '</p>';

    ele = document.getElementById('entrate_annuali');
    ele.innerHTML = ele.innerHTML +
        '<p class="fs-4 fw-bolder text-success mt-2" value="' + data[2] + '"><i class="bi bi-arrow-up-short"></i>' + data[2]+ '</p>';
        
    ele = document.getElementById('uscite_annuali');
    ele.innerHTML = ele.innerHTML +
        '<p class="fs-4 fw-bolder text-danger mt-2" value="' + data[3] + '"><i class="bi bi-arrow-down-short"></i>' + data[3]+ '</p>';

    ele = document.getElementById('saldo_attuale');
    if (data[4]>0)
        str = '<p class="fs-4 fw-bolder text-success mt-2" value="' + data[4] + '"><i class="bi bi-arrow-up-short"></i>' + data[4]+ '€</p>'
    else if (data[4]<0)  
        str = '<p class="fs-4 fw-bolder text-danger mt-2" value="' + data[4] + '"><i class="bi bi-arrow-down-short"></i>' + data[4]+ '€</p>';
    else
        str = '<p class="fs-4 fw-bolder text-primary mt-2" value="' + data[4] + '">= ' + data[4]+ '€</p>'
    ele.innerHTML = ele.innerHTML + str;
    
}
</script>
<script>
    // attenzione
    dataSet = <?= getJsonScadenzaLimitata($conn);?>;
    for (var i in dataSet){
        var html = `<tr>
        <td data-label="Data">${dataSet[i].data}</td>
        <td class="table-light" data-label="Categoria">${dataSet[i].categoria}</td>
        <td data-label="Descrizione">${dataSet[i].descrizione}</td>
        <td class="table-light" data-label="Importo">${Math.abs(dataSet[i].importo)} &euro;</td>
        <td data-label="Tipo">${(dataSet[i].importo>0)? "<i class='fa-lg text-success bi bi-graph-up-arrow'></i>": "<i class='fa-lg text-danger bi bi-graph-down-arrow'></i>"}</td>
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