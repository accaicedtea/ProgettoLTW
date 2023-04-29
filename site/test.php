<?php 
    require './test_buffi_json.php';
    $conn=db_conn();
    $sesso=1;
    $totali= get_eta_graph($conn);
    $sesso_uomo = get_eta_sesso_graph($conn,$sesso);
    $frazione_test=get_array_sesso($totali,$sesso_uomo,$sesso);
    echo $frazione_test;
?>



<figure class="highcharts-figure utenti">
    <div id="container-nazionalita"><script>
Highcharts.chart('container-nazionalita', {
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

</script></figure>