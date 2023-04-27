<?php
$pagina = "Dashboard";
require './test_buffi_json.php';
    $conn = db_conn();
    head($pagina);
    
$_SESSION['data_oggi'] = date("Y:m:d");
if (isset($_SESSION['log']) && $_SESSION['log']== 'on'){
    navBar($pagina);
    $json_data_piechart = piechart($conn);
    $json_data_linegraph = linegraph($conn);
    $json_data_histogram = histogram($conn);
    $json_giorni_mese = giorni_mese();
?>
<html>

    <body id="page-top">
        
        <div id="wrapper">
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <div class="container">
                       
                        <div class="row justify-content-center mt-3 ">
                            <div id="entrate_mensili" class="col-auto lg-3  card shadow me-2">
                                <p class="fs-5 mt-2">Entrate mensili</p>
                                <span class="border-bottom"></span>
                                <!--Entrate mensili da database-->
                            </div>
                            <div id="uscite_mensili" class="col-auto lg-3 card shadow me-2">
                                <p class="fs-5 mt-2">Uscite mensili</p>
                                <span class="border-bottom"></span>
                                <!--Uscite mensili da database-->
                            </div>
                            <div id="entrate_annuali" class="col-auto lg-3 card shadow me-2">
                                <p class="fs-5 mt-2">Entrate annuali</p>
                                <span class="border-bottom"></span>
                                <!--Entrate annuali da database-->
                            </div>
                            <div id="uscite_annuali" class="col-auto lg-3 card shadow me-2">
                                <p class="fs-5 mt-2">Uscite annuali</p>
                                <span class="border-bottom"></span>
                                <!--uscote annuali da database-->
                            </div>
                        
                    </div>
                        <div class="row-auto justify-content-center mt-3">
                            <div class="row-auto mt-3 card shadow me-2">
                                <figure class="highcharts-figure">
                                    <div id="line graph">
                                        <script>
                                            Highcharts.chart('line graph', {
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
                                                plotOptions: {
                                                    line: {
                                                        dataLabels: {
                                                            enabled: true,
                                                        },
                                                        enableMouseTracking: false
                                                    }
                                                },
                                                series: 
                                                    <?=$json_data_linegraph?>,
                                                });
                                        </script>
                                    </div>
                                </figure>
                            </div>
                            <div class="row-auto justify-content-center mt-3">
                               
                            
                                <div class="col-auto col-xs-12 card">
                                <figure class="highcharts-figure">
                                    <div id="pie chart" class="container">
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
                                                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                                                    data: <?=$json_data_piechart?>,
                                                }]
                                                });
                                        </script>
                                    </div>
                                </figure>
                                            
                                </div>
                                
                                <div class="col-auto justify-content-center col-xs-12 card">
                                    <figure class="highcharts-figure">
                                        <div id="histogram">
                                            <script>
                                    <?php $title = "Spese durante l'anno";
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
      text: '<?php echo $title?>'
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
      data: <?=$json_data_histogram?>,
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
        </div>
    </body>
</html>
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