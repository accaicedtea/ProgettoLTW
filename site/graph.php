<?php 
    
    $pagina = "Dashboard";
    require './funzioni.php';
    $conn = db_conn();
    head($pagina);
        
    $_SESSION['data_oggi'] = date("Y:m:d");
    navBar($pagina);
    $json_data_piechart = piechart($conn);
    $json_data_linegraph = entrata_graph($conn);
    $json_data_histogram = histogram($conn);
    $json_giorni_mese = giorni_mese();
    //echo $json_data_piechart;
?>
<script>
    function applicaFiltroCat() {
        var e = document.getElementById("cars");
        $.ajax({
            url:"filtri.php",   
            type: "get",   
            dataType: 'json',
            data: {
                mese: e.options[e.selectedIndex].text
            },
            success:function(result){
                dataSet = result;    
            }
        });
    }

</script>
<label for="cars">Choose a car:</label>

<select name="cars" id="cars">
  <option value="04">aprile</option>
  <option value="05">maggio</option>
  <option value="06">giugno</option>
  <option value="07">luglio</option>
</select>
<div class="col-xl-6">
                            <figure class="highcharts-figure">
                                <div id="pie_chart">

                                </div>
                            </figure>
                        </div>
<script>

    var y = document.getElementById("pie_chart");
    y.innerHTML =                                     `<script>
                                        let dataSet = <?=$json_data_piechart;?>;
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
                                                data: dataSet
                                            }]
                                        });
                                    </script>`
</script>