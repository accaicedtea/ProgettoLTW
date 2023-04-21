<?php
    $pagina = "Statistiche";
    include './head.php';
    include './db_conn.php';
    if (isset($_SESSION['log']) && $_SESSION['log']== 'on'){
?>

<html>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <body>
        
    </body>
</html>

<?php }else{
    header("Location: login.php?error=ma che stavi a provà a fa limortaaaaa");
    } ?>