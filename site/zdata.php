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
                                                        pointFormat: '<b>{point.percentage:.1f}%</b>'
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

























                                    <figure class="highcharts-figure histogram">
                                        <div id="histogram">
                                            <script>
                                                <?php $title = "Spese durante l'anno";
                                                $title = addslashes($title);
                                                ?>  
                                            Highcharts.chart('histogram', {
                                                chart: {
                                                type: 'column'
                                                },
                                                credits: {
                                                enabled:false
                                                },
                                                title: {
                                                align: 'left',
                                                text: '<?php echo $title?>'
                                                },
                                                accessibility: {
                                                announceNewData: {
                                                    enabled: true
                                                }
                                                },
                                                xAxis: {
                                                type: 'category',
                                                labels: {
                                                            style: {
                                                                fontWeight: 'bold'
                                                            }
                                                        }
                                                },
                                                yAxis: {
                                                title: {
                                                    text: '€'
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
                                                            format: '{y:.2f}€'
                                                        }
                                                }
                                                },
                                            
                                                tooltip: {
                                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}€<br/>'
                                                },
                                            
                                                series: [{
                                                name: 'Spesa del mese',
                                                colorByPoint:true,
                                                data: <?=$json_data_histogram?>,
                                                }]
                                            });
                                            </script>
                                        </div>
                                    </figure>