
Highcharts.chart('area graph', {
    chart: {
    type: 'area'
    },
    title: {
        text: 'Movimenti di questo anno'
    },
    credits:{
        enabled: false
    },
    xAxis: {
        categories: ['gennaio', 'febbraio', 'marzo', 'aprile', 'maggio', 'giugno', 'luglio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dicembre']
    },
    yAxis: {
        title: {
            text: '€'
        }
    },
    tooltip: {
        valueDecimals: 2,
        valueSuffix: "€"
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true,
                format: '{y:.2f} €'
            },
            enableMouseTracking: false
        }
    },
    series: 
        <?=$json_data_linegraph_year?>,
    });
/*            </script>
        </div>
    </figure>
</div>
<div class="row mt-3">
    <div class="col card">
    <figure class="highcharts-figure">
        <div id="spline graph saldo">
            <script>
                Highcharts.chart('spline graph saldo', {
                    chart: {
                        type: 'spline'
                    },
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: 'Saldo di questo anno'
                    },
                    xAxis: {
                        categories: ['gennaio', 'febbraio', 'marzo', 'aprile', 'maggio', 'giugno', 'luglio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dicembre'],
                        accessibility: {
                            description: 'Mese'
                        }
                    },
                    yAxis: {
                        title: {
                        text: '€'
                        },
                        labels: {
                        }
                    },
                    tooltip: {
                        crosshairs: true,
                        shared: true,
                        valueDecimals: 2,
                        valueSuffix: "€"
                    },
                    plotOptions: {
                        spline: {
                            marker: {
                                radius: 4,
                                lineColor: '<?=$colore_saldo?>',
                                lineWidth: 1
                            }
                        }
                    },
                    series: [{
                        name: 'Saldo',
                        data: <?=$json_data_saldo_year?>,
                        color: '<?=$colore_saldo?>'
                    }]
                    });
            </script>
        </div>
    </figure>
    </div>
</div>
<div class="row card mb-5 mt-3">
    <figure class="highcharts-figure">
        <div id="spline graph risparmio">
            <script>
                Highcharts.chart('spline graph risparmio', {
                    chart: {
                        type: 'spline'
                    },
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: 'Risparmi di questo anno'
                    },
                    xAxis: {
                        categories: ['gennaio', 'febbraio', 'marzo', 'aprile', 'maggio', 'giugno', 'luglio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dicembre'],
                        accessibility: {
                            description: 'Mese'
                        }
                    },
                    yAxis: {
                        title: {
                        text: '€'
                        },
                        labels: {
                        }
                    },
                    tooltip: {
                        crosshairs: true,
                        shared: true,
                        valueDecimals: 2,
                        valueSuffix: "€"
                    },
                    plotOptions: {
                        spline: {
                            marker: {
                                radius: 4,
                                lineColor: '<?=$colore_risparmio?>',
                                lineWidth: 1
                            }
                        },
                    },
                    series: [{
                        name: 'Risparmio',
                        data: <?=$json_data_risparmio_year?>,
                        color: '<?=$colore_risparmio?>'
                    }]
                    });
            </script>
        </div>
    </figure>
</div>
*/








