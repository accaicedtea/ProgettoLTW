<?php
$pagina = "Dashboard";
include './head.php';
include './db_conn.php';
$json_data = include ('./con_db_to_dashboard.php');
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
                            <div class="col lg-3 cardshadow">

                            </div>
                            <div class="col lg-3 card shadow">
                            <figure class="highcharts-figure">
                                <div id="container">
                                <script>
                                    Highcharts.chart('container', {
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            type: 'pie'
                                        },
                                        title: {
                                            text: 'Percentuali uscite di <?php setlocale(LC_TIME, 'it_IT'); echo date('F'); ?>',
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
                                            data: <?=$json_data?>,
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