<?php
$pagina = "Dashboard";
include './head.php';
include './db_conn.php';
$json_data_piechart = include ('./con_db_to_piechart.php');
$json_data_linegraph = include ('./con_db_to_linegraph.php');
$json_giorni_mese = include ('./giorni_mese.php');
$_SESSION['data_oggi'] = date("Y:m:d");
if (isset($_SESSION['log']) && $_SESSION['log']== 'on'){
?>
<html>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <body id="page-top">
        <?php include_once './navBar.php';?>
        <div id="wrapper">
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <div class="container">
                        <div class="row mt-3">
                            <div class="col lg-3 card shadow me-2">
                                <p>Entrate mensili</p>
                                <!--Entrate mensili da database-->
                                <?php
                                $username= $_SESSION['username'];
                                $data_oggi = $_SESSION['data_oggi'];
                                $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo > 0 AND spesa.utente = '$username' AND MONTH(spesa.data) = MONTH('$data_oggi') AND YEAR(spesa.data) = YEAR('$data_oggi')";
                                $result = $conn->query($query);
                                if ($result->num_rows>0) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['somma'].'€';
                                }
                                ?>
                            </div>
                            <div class="col lg-3 card shadow me-2">
                                <p>Uscite mensili</p>
                                <?php
                                $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo < 0 AND spesa.utente = '$username' AND MONTH(spesa.data) = MONTH('$data_oggi') AND YEAR(spesa.data) = YEAR('$data_oggi')";
                                $result = $conn->query($query);
                                if ($result->num_rows>0) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['somma'].'€';
                                }
                                ?>
                            </div>
                            <div class="col lg-3 card shadow me-2">
                                <p>Entrate annuali</p>
                                <?php
                                $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo > 0 AND spesa.utente = '$username' AND YEAR(spesa.data) = YEAR('$data_oggi')";
                                $result = $conn->query($query);
                                if ($result->num_rows>0) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['somma'].'€';
                                }
                                ?>
                            </div>
                            <div class="col lg-3 card shadow me-2">
                                <p>Uscite annuali</p>
                                <?php
                                $username= $_SESSION['username'];
                                $query = "SELECT COALESCE(sum(importo),0) as somma from spesa where importo < 0 AND spesa.utente = '$username' AND YEAR(spesa.data) = YEAR('$data_oggi')";
                                $result = $conn->query($query);
                                if ($result->num_rows>0) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['somma'].'€';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="row mt-3 card shadow me-2">
                                <figure class="highcharts-figure">
                                    <div id="line graph">
                                        <script>
                                            Highcharts.chart('line graph', {
                                                chart: {
                                                type: 'line'
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
                                                            enabled: true
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
                            <div class="row mt-3">
                                <div class="col-6 card shadow">
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
                                <div class="col card shadow mw-2">
                                    <figure class="highcharts-figure">
                                        <div id="histogram">
                                            <script>
                                        // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
Highcharts.chart('histogram', {
    chart: {
      type: 'column'
    },
    title: {
      align: 'left',
      text: 'Browser market shares. January, 2022'
    },
    subtitle: {
      align: 'left',
      text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
    },
    accessibility: {
      announceNewData: {
        enabled: true
      }
    },
    xAxis: {
      type: 'category'
    },
    yAxis: {
      title: {
        text: 'Total percent market share'
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
          format: '{point.y:.1f}%'
        }
      }
    },
  
    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },
  
    series: [
      {
        name: 'Browsers',
        colorByPoint: true,
        data: [
          {
            name: 'Chrome',
            y: 63.06,
            drilldown: 'Chrome'
          },
          {
            name: 'Safari',
            y: 19.84,
            drilldown: 'Safari'
          },
          {
            name: 'Firefox',
            y: 4.18,
            drilldown: 'Firefox'
          },
          {
            name: 'Edge',
            y: 4.12,
            drilldown: 'Edge'
          },
          {
            name: 'Opera',
            y: 2.33,
            drilldown: 'Opera'
          },
          {
            name: 'Internet Explorer',
            y: 0.45,
            drilldown: 'Internet Explorer'
          },
          {
            name: 'Other',
            y: 1.582,
            drilldown: null
          }
        ]
      }
    ],
    drilldown: {
      breadcrumbs: {
        position: {
          align: 'right'
        }
      },
      series: [
        {
          name: 'Chrome',
          id: 'Chrome',
          data: [
            [
              'v65.0',
              0.1
            ],
            [
              'v64.0',
              1.3
            ],
            [
              'v63.0',
              53.02
            ],
            [
              'v62.0',
              1.4
            ],
            [
              'v61.0',
              0.88
            ],
            [
              'v60.0',
              0.56
            ],
            [
              'v59.0',
              0.45
            ],
            [
              'v58.0',
              0.49
            ],
            [
              'v57.0',
              0.32
            ],
            [
              'v56.0',
              0.29
            ],
            [
              'v55.0',
              0.79
            ],
            [
              'v54.0',
              0.18
            ],
            [
              'v51.0',
              0.13
            ],
            [
              'v49.0',
              2.16
            ],
            [
              'v48.0',
              0.13
            ],
            [
              'v47.0',
              0.11
            ],
            [
              'v43.0',
              0.17
            ],
            [
              'v29.0',
              0.26
            ]
          ]
        },
        {
          name: 'Firefox',
          id: 'Firefox',
          data: [
            [
              'v58.0',
              1.02
            ],
            [
              'v57.0',
              7.36
            ],
            [
              'v56.0',
              0.35
            ],
            [
              'v55.0',
              0.11
            ],
            [
              'v54.0',
              0.1
            ],
            [
              'v52.0',
              0.95
            ],
            [
              'v51.0',
              0.15
            ],
            [
              'v50.0',
              0.1
            ],
            [
              'v48.0',
              0.31
            ],
            [
              'v47.0',
              0.12
            ]
          ]
        },
        {
          name: 'Internet Explorer',
          id: 'Internet Explorer',
          data: [
            [
              'v11.0',
              6.2
            ],
            [
              'v10.0',
              0.29
            ],
            [
              'v9.0',
              0.27
            ],
            [
              'v8.0',
              0.47
            ]
          ]
        },
        {
          name: 'Safari',
          id: 'Safari',
          data: [
            [
              'v11.0',
              3.39
            ],
            [
              'v10.1',
              0.96
            ],
            [
              'v10.0',
              0.36
            ],
            [
              'v9.1',
              0.54
            ],
            [
              'v9.0',
              0.13
            ],
            [
              'v5.1',
              0.2
            ]
          ]
        },
        {
          name: 'Edge',
          id: 'Edge',
          data: [
            [
              'v16',
              2.6
            ],
            [
              'v15',
              0.92
            ],
            [
              'v14',
              0.4
            ],
            [
              'v13',
              0.1
            ]
          ]
        },
        {
          name: 'Opera',
          id: 'Opera',
          data: [
            [
              'v50.0',
              0.96
            ],
            [
              'v49.0',
              0.82
            ],
            [
              'v12.1',
              0.14
            ]
          ]
        }
      ]
    }
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

<?php } else( header("Locacion: login.php"));
?>