<?php
$pagina = "Statistiche";
require './test_buffi_json.php';
    $conn = db_conn();
    head($pagina);
    
$_SESSION['data_oggi'] = date("Y:m:d");
if (isset($_SESSION['log']) && $_SESSION['log']== 'on'){
    navBar($pagina);
?>
<html>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <body>
        <div id="wrapper">
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <div class="container">
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php }else{
    header("Location: login.php?error=ma che stavi a provà a fa limortaaaaa");
    } ?>