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

var categories = [
    <?php echo get_eta_per_graph($conn);?>
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
        name: 'Male',
        data: [
            -5.72, -4.85,
            -3.71, -2.76, -2.07, -1.70, -1.47,
            -1.22, -0.99, -0.81, -0.62, -0.41,
            -0.23, -0.15
        ]
    }, {
        name: 'Female',
        data: [
           	5.68, 4.83,
            3.74, 2.80, 2.14, 1.79, 1.59,
            1.34, 1.06, 0.83, 0.63, 0.43,
            0.25, 0.19
        ]
    }]
});

</script></div>

</figure>