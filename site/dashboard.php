<?php
$pagina = "Dashboard";
include './head.php';
include './db_conn.php';
$json_data_piechart = include ('./con_db_to_piechart.php');
$json_data_linegraph = include ('./con_db_to_linegraph.php');
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
                            <div class="col lg-3 card shadow me-2">
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
                                                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
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
                                                series: [{
                                                    name: 'Reggane',
                                                    data: [16.0, 18.2, 23.1, 27.9, 32.2, 36.4, 39.8, 38.4, 35.5, 29.2,
                                                        22.0, 17.8]
                                                    }, {
                                                    name: 'Tallinn',
                                                    data: [-2.9, -3.6, -0.6, 4.8, 10.2, 14.5, 17.6, 16.5, 12.0, 6.5,
                                                        2.0, -0.9]
                                                    }]
                                                });
                                        </script>
                                    </div>
                                </figure>
                            </div>
                            <div class="col lg-3 card shadow me-2">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php } else( header("Locacion: login.php"));
?>