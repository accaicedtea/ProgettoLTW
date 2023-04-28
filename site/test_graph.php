<?php require './test_buffi_json.php';
head("ciao");
$conn = db_conn();
?>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"><script>
// Age categories

// Age categories
var categories = [
    <?php echo get_eta_per_categorie($conn);?>
];

Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Population pyramid for Somalia, 2021',
        align: 'left'
    },
    subtitle: {
        text: 'Source: <a ' +
            'href="https://countryeconomy.com/demography/population-structure/somalia"' +
            'target="_blank">countryeconomy.com</a>',
        align: 'left'
    },
    accessibility: {
        point: {
            valueDescriptionFormat: '{index}. Age {xDescription}, {value}%.'
        }
    },
    xAxis: [{
        categories: categories,
        reversed: false,
        labels: {
            step: 1
        },
        accessibility: {
            description: 'Age (male)'
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
            description: 'Age (female)'
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
            description: 'Percentage population',
            rangeDescription: 'Range: 0 to 5%'
        }
    },

    plotOptions: {
        series: {
            stacking: 'normal',
            borderRadius: '50%'
        }
    },

    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + ', age ' + this.point.category + '</b><br/>' +
                'Population: ' + Highcharts.numberFormat(Math.abs(this.point.y), 1) + '%';
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
                $sesso_uomo = get_eta_sesso_graph($conn,$sesso);
                $frazione_test=get_array_sesso($totali,$sesso_uomo,$sesso);
                echo $frazione_test; 
            ?>
        ]
    }]
});

</script></div>

</figure>