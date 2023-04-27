<?php 
$pagina = 'Statistiche';
require './test_buffi_json.php';
$conn = db_conn();
head($pagina);
navBar($pagina);
?>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"><script>
Highcharts.chart('container', {
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
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:0f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
</script></div>

</figure>