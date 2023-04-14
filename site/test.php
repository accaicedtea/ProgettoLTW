<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<div>
<figure class="highcharts-figure">
  <div id="container 1">
    <script>
  // Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
Highcharts.chart('container 1', {
  chart: {
    type: 'line'
  },
  title: {
    text: 'Monthly Average Temperature'
  },
  subtitle: {
    text: 'Source: ' +
      '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
      'target="_blank">Wikipedia.com</a>'
  },
  xAxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
  },
  yAxis: {
    title: {
      text: 'Temperature (°C)'
    }
  },
  plotOptions: {
    line: {
      dataLabels: {
        enabled: true
      },
      enableMouseTracking: false
    }
  },
  series: [{
    name: 'Reggane',
    data: [16.0, 18.2, 23.1, 27.9, 32.2, 36.4, 39.8, 38.4, 35.5, 29.2,
      22.0, 17.8]
  }, {
    name: 'Tallinn',
    data: [-2.9, -3.6, -0.6, 4.8, 10.2, 14.5, 17.6, 16.5, 12.0, 6.5,
      2.0, -0.9]
  }]
});
</script>
  </div>
  <p class="highcharts-description">
    This chart shows how data labels can be added to the data series. This
    can increase readability and comprehension for small datasets.
  </p>
</figure>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div>
<figure class="highcharts-figure">
  <div id="container">
    <script>
        // Data retrieved from https://netmarketshare.com
Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Browser market shares in May, 2020',
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
    name: 'Brands',
    colorByPoint: true,
    data: [{
      name: 'Chrome',
      y: 70.67,
      sliced: true,
      selected: true
    }, {
      name: 'Edge',
      y: 14.77
    },  {
      name: 'Firefox',
      y: 4.86
    }, {
      name: 'Safari',
      y: 2.63
    }, {
      name: 'Internet Explorer',
      y: 1.53
    },  {
      name: 'Opera',
      y: 1.40
    }, {
      name: 'Sogou Explorer',
      y: 0.84
    }, {
      name: 'QQ',
      y: 0.51
    }, {
      name: 'Other',
      y: 2.6
    }]
  }]
});
    </script>
  </div>
  <p class="highcharts-description">
    Pie charts are very popular for showing a compact overview of a
    composition or comparison. While they can be harder to read than
    column charts, they remain a popular choice for small datasets.
  </p>
</figure>
</div>